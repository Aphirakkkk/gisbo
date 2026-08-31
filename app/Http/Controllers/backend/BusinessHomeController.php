<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BusinessHome;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class BusinessHomeController extends Controller
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

        $titlePage = "จัดการข้อมูล Business หน้า Home";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $BusinessHome = BusinessHome::where('business_home.active_status', 1);
        // start search
        if (isset($request->search)) {
            $search_q = $request->search;
            $BusinessHome = $BusinessHome->where(function ($q) use ($search_q) {
                $q->Where('business_home.tilte_th', 'LIKE', '%' . $search_q . '%');
                $q->orWhere('business_home.tilte_en', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->startd_at) {
            $BusinessHome = $BusinessHome->where('business_home.created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->ended_at) {
            $BusinessHome = $BusinessHome->where('business_home.created_at', '<=', $request->ended_at . ' 23:59:59');
        }
        // end search

        $BusinessHome = $BusinessHome->where('business_home.active_status', 1)->orderby('sort_number', 'desc')->paginate(10);
        Log::info("BusinessHomeController : index");
        return view('backend.business_home.index', [
            'BusinessHome' => $BusinessHome,
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
        $data["titlePage"] = "สร้างข้อมูล Business หน้า Home";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = BusinessHome::where('business_home.active_status', 1)->where('business_home.display_status', 1)->orderby('sort_number', 'desc')->first();

        if ($sort) {
            $data['sort_number'] = $sort->sort_number + 1;
        } else {
            $data['sort_number'] = 1;
        }

        Log::info("BusinessHomeController : create");
        Log::info($data);

        return view('backend.business_home.create', $data);
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

            $data = new BusinessHome();
            $data->business_type_id = $request->business_type_id;
            $data->page = '1';
            $data->link_VDO = $this->extractYoutubeId($request->link_VDO);
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->sub_tilte_th = $request->sub_tilte_th;
            $data->sub_tilte_en = $request->sub_tilte_en;
            $data->detail_th = $request->detail_th;
            $data->detail_en = $request->detail_en;
            $data->active_status = '1';
            $data->display_status = '1';
            $data->image_VDO = '';
            $data->sort_number = $request->sort_number;
            $data->ip_address = $request->ip();
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            $image_VDO = BusinessHome::find($data->id);
            if ($request->image_VDO == null) {
                $image_VDO->image_VDO =  'assets/backend/images/error/nopic.jpg';
            } else {
                $storeFolder = 'assets/frontend/img/business_home/' . $data->id; //2
                if ($request->hasFile('image_VDO')) {
                    $newFileName = $request->image_VDO->getClientOriginalName();
                    $image_VDO->image_VDO = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    // $request->image_VDO->move(public_path($storeFolder), $newFileName);
                    $RealPath = 'assets/../assets/frontend/img/business_home/' . $data->id;
                    Image::make($request->image_VDO->getRealPath())->save($RealPath . '/' . $newFileName);
                }
            }
            $image_VDO->save();

            Log::info("BusinessHomeController : store");
            Log::info($request);

            DB::commit();

            return redirect()->route('businesshome.index');
        } catch (\PDOException $e) {
            Log::info("BusinessHomeController : store");
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
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูล Business หน้า Home";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["BusinessHome"] = BusinessHome::find($id);
        Log::info("BusinessHomeController : edit id = " . $id);
        Log::info($data);

        return view('backend.business_home.edit', $data);
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

            $data = BusinessHome::find($id);
            $data->business_type_id = $request->business_type_id;
            $data->page = $request->page;
            $data->link_VDO = $this->extractYoutubeId($request->link_VDO);
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->sub_tilte_th = $request->sub_tilte_th;
            $data->sub_tilte_en = $request->sub_tilte_en;
            $data->detail_th = $request->detail_th;
            $data->detail_en = $request->detail_en;
            $data->active_status = '1';
            $data->display_status = '1';
            $data->image_VDO = '';
            $data->ip_address = $request->ip();
            $data->active_status = $request->active_status;
            $data->display_status = $request->display_status;
            $data->sort_number = $request->sort_number;
            $data->created_by = $request->created_by;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            $image_VDO = BusinessHome::find($data->id);
            if ($request->image_VDO == null) {
                if ($request->image_VDOOld == null) {
                    $image_VDO->image_VDO = 'assets/backend/images/error/nopic.jpg';
                } else {
                    $image_VDO->image_VDO =  $request->image_VDOOld;
                }
            } else {
                $storeFolder = 'assets/frontend/img/business_home/' . $data->id; //2
                if ($request->hasFile('image_VDO')) {
                    $newFileName = $request->image_VDO->getClientOriginalName();
                    $image_VDO->image_VDO = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    // $request->image_VDO->move(public_path($storeFolder), $newFileName);
                    $RealPath = 'assets/../assets/frontend/img/business_home/' . $data->id;
                    Image::make($request->image_VDO->getRealPath())->save($RealPath . '/' . $newFileName);
                }
            }
            $image_VDO->save();
            Log::info("BusinessHomeController : update id = " . $id);
            Log::info($request);

            DB::commit();

            return redirect()->route('businesshome.index');
        } catch (\PDOException $e) {
            Log::info("BusinessHomeController : update id = " . $id);
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

            $data = BusinessHome::find($request->id);
            $data->active_status = '0';
            $data->display_status = '2';
            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            Log::info("BusinessHomeController : updateDelete");
            Log::info($request);

            DB::commit();

            return response(200);
        } catch (\PDOException $e) {
            Log::info("BusinessHomeController : updateDelete");
            Log::error($e);

            DB::rollBack();

            Alert::error('ไม่สำเร็จ', 'คุณทำรายการที่ต้องการไม่สำเร็จกรุณาทำรายการใหม่');
            return response(300);
        }
    }

    private function extractYoutubeId($url)
    {
        if (empty($url)) return '';
        $url = trim($url);
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            return $match[1];
        }
        return $url;
    }
}
