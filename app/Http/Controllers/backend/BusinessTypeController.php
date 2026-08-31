<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BusinessType;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class BusinessTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // check date
        if ($request->startd_at && $request->ended_at) {
            if ($request->startd_at > $request->ended_at) {
                Alert::error('ข้อมูลค้นหาไม่ถูกต้อง', 'กรุณาตรวจสอบวันเริ่มต้นและวันสิ้นสุดให้ถูกต้อง');
                return redirect()->back()->withInput();
            }
        }

        $titlePage = "จัดการข้อมูลกลุ่ม Business";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $BusinessType = BusinessType::where('business_type.active_status', 1);
        // start search
        if (isset($request->search)) {
            $search_q = $request->search;
            $BusinessType = $BusinessType->where(function ($q) use ($search_q) {
                $q->Where('business_type.tilte_th', 'LIKE', '%' . $search_q . '%');
                $q->orWhere('business_type.tilte_en', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->startd_at) {
            $BusinessType = $BusinessType->where('business_type.created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->ended_at) {
            $BusinessType = $BusinessType->where('business_type.created_at', '<=', $request->ended_at . ' 23:59:59');
        }
        // end search

        $BusinessType = $BusinessType->where('business_type.active_status', 1)->orderby('sort_number', 'desc')->paginate(10);
        Log::info("BusinessTypeController : index");
        return view('backend.business_type.index', [
            'BusinessType' => $BusinessType,
            'titlePage' => $titlePage,
            'DataTimeThaiFull' => $DataTimeThaiFull,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["titlePage"] = "สร้างข้อมูลกลุ่ม Business";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = BusinessType::where('business_type.active_status', 1)->where('business_type.display_status', 1)->orderby('sort_number', 'desc')->first();

        if ($sort) {
            $data['sort_number'] = $sort->sort_number + 1;
        } else {
            $data['sort_number'] = 1;
        }

        Log::info("BusinessTypeController : create");
        Log::info($data);

        return view('backend.business_type.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            $data = new BusinessType();
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->active_status = '1';
            $data->display_status = '1';
            $data->image_icon = '';
            $data->sort_number = $request->sort_number;
            $data->ip_address = $request->ip();
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            $image_icon = BusinessType::find($data->id);
            if ($request->image_icon == null) {
                $image_icon->image_icon =  'assets/backend/images/error/nopic.jpg';
            } else {
                $storeFolder = 'assets/frontend/img/business_type/' . $data->id; //2
                if ($request->hasFile('image_icon')) {
                    $newFileName = $request->image_icon->getClientOriginalName();
                    $image_icon->image_icon = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    // $request->image_icon->move(public_path($storeFolder), $newFileName);
                    $RealPath = 'assets/../assets/frontend/img/business_type/' . $data->id;
                    Image::make($request->image_icon->getRealPath())->save($RealPath . '/' . $newFileName);
                }
            }
            $image_icon->save();

            Log::info("BusinessTypeController : store");
            Log::info($request);

            DB::commit();

            return redirect()->route('businesstype.index');
        } catch (\PDOException $e) {
            Log::info("BusinessTypeController : store");
            Log::error($e);
            Alert::error('ไม่สำเร็จ', 'คุณทำรายการที่ต้องการไม่สำเร็จกรุณาทำรายการใหม่');
            return redirect()->back()->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูลกลุ่ม Business";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["BusinessType"] = BusinessType::find($id);
        Log::info("BusinessTypeController : edit id = " . $id);
        Log::info($data);

        return view('backend.business_type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = BusinessType::find($id);;
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->ip_address = $request->ip();
            $data->active_status = $request->active_status;
            $data->display_status = $request->display_status;
            $data->sort_number = $request->sort_number;
            $data->created_by = $request->created_by;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            $image_icon = BusinessType::find($data->id);
            if ($request->image_icon == null) {
                if ($request->image_iconOld == null) {
                    $image_icon->image_icon = 'assets/backend/images/error/nopic.jpg';
                } else {
                    $image_icon->image_icon =  $request->image_iconOld;
                }
            } else {
                $storeFolder = 'assets/frontend/img/business_type/' . $data->id; //2
                if ($request->hasFile('image_icon')) {
                    $newFileName = $request->image_icon->getClientOriginalName();
                    $image_icon->image_icon = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    // $request->image_icon->move(public_path($storeFolder), $newFileName);
                    $RealPath = 'assets/../assets/frontend/img/business_type/' . $data->id;
                    Image::make($request->image_icon->getRealPath())->save($RealPath . '/' . $newFileName);
                }
            }
            $image_icon->save();
            Log::info("BusinessTypeController : update id = " . $id);
            Log::info($request);

            DB::commit();

            return redirect()->route('businesstype.index');
        } catch (\PDOException $e) {
            Log::info("BusinessTypeController : update id = " . $id);
            Log::error($e);

            DB::rollBack();

            Alert::error('ไม่สำเร็จ', 'คุณทำรายการที่ต้องการไม่สำเร็จกรุณาทำรายการใหม่');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateDelete(Request $request)
    {

        try {
            DB::beginTransaction();

            $data = BusinessType::find($request->id);
            $data->active_status = '0';
            $data->display_status = '2';
            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            Log::info("BusinessTypeController : updateDelete");
            Log::info($request);

            DB::commit();

            return response(200);
        } catch (\PDOException $e) {
            Log::info("BusinessTypeController : updateDelete");
            Log::error($e);

            DB::rollBack();

            Alert::error('ไม่สำเร็จ', 'คุณทำรายการที่ต้องการไม่สำเร็จกรุณาทำรายการใหม่');
            return response(300);
        }
    }
}
