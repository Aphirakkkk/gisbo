<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Image;
use Illuminate\Support\Str;

class BannerController extends Controller
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

        $titlePage = "จัดการข้อมูล Banner";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $Banner = Banner::where('banner.active_status', 1);
        // start search
        if (isset($request->search)) {
            $search_q = $request->search;
            $Banner = $Banner->where(function ($q) use ($search_q) {
                $q->Where('banner.tilte_th', 'LIKE', '%' . $search_q . '%');
                $q->orWhere('banner.tilte_en', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->startd_at) {
            $Banner = $Banner->where('banner.created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->ended_at) {
            $Banner = $Banner->where('banner.created_at', '<=', $request->ended_at . ' 23:59:59');
        }
        // end search

        $Banner = $Banner->where('banner.active_status', 1)->orderby('sort_number', 'desc')->paginate(10);
        Log::info("BannerController : index");
        return view('backend.banner.index', [
            'Banner' => $Banner,
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
        $data["titlePage"] = "สร้างข้อมูล Banner";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = Banner::where('banner.active_status', 1)->where('banner.display_status', 1)->orderby('sort_number', 'desc')->first();

        if ($sort) {
            $data['sort_number'] = $sort->sort_number + 1;
        } else {
            $data['sort_number'] = 1;
        }

        Log::info("BannerController : create");
        Log::info($data);

        return view('backend.banner.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $random = Str::random(20);
        $random2 = Str::random(20);
        try {
            DB::beginTransaction();

            $data = new Banner();
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->detail_th = $request->detail_th;
            $data->detail_en = $request->detail_en;
            $data->active_status = '1';
            $data->display_status = '1';
            $data->sort_number = $request->sort_number;
            $data->ip_address = $request->ip();
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            $image_banner_slide = Banner::find($data->id);
            if ($request->image_banner_slide == null) {
                $image_banner_slide->image_banner_slide =  'assets/backend/images/error/nopic.jpg';
            } else {
                $storeFolder = 'assets/frontend/img/banner/' . $data->id; //2
                if ($request->hasFile('image_banner_slide')) {
                    // $newFileName = $request->image_banner_slide->getClientOriginalName();
                    $newFileName = $random . '.' . $request->image_banner_slide->extension();
                    $image_banner_slide->image_banner_slide = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    $RealPath = 'assets/../assets/frontend/img/banner/' . $data->id;
                    Image::make($request->image_banner_slide->getRealPath())->save($RealPath . '/' . $newFileName);
                }
            }
            $image_banner_slide->save();

            $image_banner_text = Banner::find($data->id);
            if ($request->image_banner_text == null) {
                $image_banner_text->image_banner_text =  'assets/backend/images/error/nopic.jpg';
            } else {
                $storeFolder = 'assets/frontend/img/banner/' . $data->id . '/image_banner_text'; //2
                if ($request->hasFile('image_banner_text')) {
                    // $newFileName = $request->image_banner_text->getClientOriginalName();
                    $newFileName = $random2 . '.' . $request->image_banner_text->extension();
                    $image_banner_text->image_banner_text = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    $RealPath = 'assets/../assets/frontend/img/banner/' . $data->id . '/image_banner_text';
                    Image::make($request->image_banner_text->getRealPath())->save($RealPath . '/' . $newFileName);
                }
            }
            $image_banner_text->save();

            Log::info("BannerController : store");
            Log::info($request);

            DB::commit();

            return redirect()->route('banner.index');
        } catch (\PDOException $e) {
            Log::info("BannerController : store");
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
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูล Banner";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["Banner"] = Banner::find($id);
        Log::info("BannerController : edit id = " . $id);
        Log::info($data);

        return view('backend.banner.edit', $data);
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
        $random = Str::random(20);
        $random2 = Str::random(20);
        try {
            DB::beginTransaction();

            $data = Banner::find($id);;
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->detail_th = $request->detail_th;
            $data->detail_en = $request->detail_en;
            $data->ip_address = $request->ip();
            $data->active_status = $request->active_status;
            $data->display_status = $request->display_status;
            $data->sort_number = $request->sort_number;
            $data->created_by = $request->created_by;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            $image_banner_slide = Banner::find($data->id);
            if ($request->image_banner_slide == null) {
                if ($request->image_banner_slideOld == null) {
                    $image_banner_slide->image_banner_slide = 'assets/backend/images/error/nopic.jpg';
                } else {
                    $image_banner_slide->image_banner_slide =  $request->image_banner_slideOld;
                }
            } else {
                $storeFolder = 'assets/frontend/img/banner/' . $data->id;
                if ($request->hasFile('image_banner_slide')) {
                    $newFileName = $random . '.' . $request->image_banner_slide->extension();
                    $image_banner_slide->image_banner_slide = $storeFolder . '/' . $newFileName;
                    $targetDir = public_path($storeFolder);
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }
                    Image::make($request->image_banner_slide->getRealPath())->save($targetDir . '/' . $newFileName);
                }
            }
            $image_banner_slide->save();

            $image_banner_text = Banner::find($data->id);
            if ($request->image_banner_text == null) {
                if ($request->image_banner_textOld == null) {
                    $image_banner_text->image_banner_text = 'assets/backend/images/error/nopic.jpg';
                } else {
                    $image_banner_text->image_banner_text =  $request->image_banner_textOld;
                }
            } else {
                $storeFolder = 'assets/frontend/img/banner/' . $data->id . '/image_banner_text';
                if ($request->hasFile('image_banner_text')) {
                    $newFileName = $random2 . '.' . $request->image_banner_text->extension();
                    $image_banner_text->image_banner_text = $storeFolder . '/' . $newFileName;
                    $targetDir = public_path($storeFolder);
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }
                    Image::make($request->image_banner_text->getRealPath())->save($targetDir . '/' . $newFileName);
                }
            }
            $image_banner_text->save();

            Log::info("BannerController : update id = " . $id);
            Log::info($request);

            DB::commit();

            return redirect()->route('banner.index');
        } catch (\PDOException $e) {
            Log::info("BannerController : update id = " . $id);
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

            $data = Banner::find($request->id);
            $data->active_status = '0';
            $data->display_status = '2';
            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            Log::info("BannerController : updateDelete");
            Log::info($request);

            DB::commit();

            return response(200);
        } catch (\PDOException $e) {
            Log::info("BannerController : updateDelete");
            Log::error($e);

            DB::rollBack();

            Alert::error('ไม่สำเร็จ', 'คุณทำรายการที่ต้องการไม่สำเร็จกรุณาทำรายการใหม่');
            return response(300);
        }
    }
}
