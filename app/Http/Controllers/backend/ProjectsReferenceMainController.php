<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ProjectsReferenceImage;
use App\Models\ProjectsReferenceMain;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Image;
use Illuminate\Support\Str;

class ProjectsReferenceMainController extends Controller
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

        $titlePage = "จัดการข้อมูลผลงาน";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $ProjectsReferenceMain = ProjectsReferenceMain::where('projects_reference_main.active_status', 1);
        // start search
        if (isset($request->search)) {
            $search_q = $request->search;
            $ProjectsReferenceMain = $ProjectsReferenceMain->where(function ($q) use ($search_q) {
                $q->Where('projects_reference_main.tilte_th', 'LIKE', '%' . $search_q . '%');
                $q->orWhere('projects_reference_main.tilte_en', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->startd_at) {
            $ProjectsReferenceMain = $ProjectsReferenceMain->where('projects_reference_main.created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->ended_at) {
            $ProjectsReferenceMain = $ProjectsReferenceMain->where('projects_reference_main.created_at', '<=', $request->ended_at . ' 23:59:59');
        }
        // end search
        $request->session()->forget('success');
        $request->session()->forget('error');
        $ProjectsReferenceMain = $ProjectsReferenceMain->where('projects_reference_main.active_status', 1)->orderby('sort_number', 'desc')->get();
        Log::info("ProjectsReferenceMainController : index");
        return view('backend.projects_reference_main.index', [
            'ProjectsReferenceMain' => $ProjectsReferenceMain,
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
        $data["titlePage"] = "สร้างข้อมูลผลงาน";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = ProjectsReferenceMain::where('projects_reference_main.active_status', 1)->where('projects_reference_main.display_status', 1)->orderby('sort_number', 'desc')->first();

        if ($sort) {
            $data['sort_number'] = $sort->sort_number + 1;
        } else {
            $data['sort_number'] = 1;
        }

        Log::info("ProjectsReferenceMainController : create");
        Log::info($data);

        return view('backend.projects_reference_main.create', $data);
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

            $data = new ProjectsReferenceMain();
            $data->projects_reference_type_id = $request->projects_reference_type_id;
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->seament_th = $request->seament_th;
            $data->seament_en = $request->seament_en;
            $data->project_owner_th = $request->project_owner_th;
            $data->project_owner_en = $request->project_owner_en;
            $data->project_value = $request->project_value;
            $data->project_start = $request->project_start;
            $data->project_completion = $request->project_completion;
            $data->project_start_month = $request->project_start_month;
            $data->project_completion_month = $request->project_completion_month;
            $data->active_status = '1';
            $data->display_status = '1';
            $data->sort_number = $request->sort_number;
            $data->ip_address = $request->ip();
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }
            $images = ProjectsReferenceMain::find($data->id);
            if ($request->image_main == null) {
                $images->image_main =  'Unknown';
            } else {
                $storeFolder = 'assets/frontend/img/projects_reference_main/' . $data->id; //2
                if ($request->hasFile('image_main')) {
                    // $newFileName = $request->image_main->getClientOriginalName();
                    $newFileName = $random . '.' . $request->image_main->extension();
                    $images->image_main = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    // $request->image_main->move(public_path($storeFolder), $newFileName);
                    $RealPath = 'assets/../assets/frontend/img/projects_reference_main/' . $data->id;
                    Image::make($request->image_main->getRealPath())->save($RealPath . '/' . $newFileName);
                    // dd($images->image_main);
                    $dataImage = new ProjectsReferenceImage();
                    $dataImage->projects_reference_id = $data->id;
                    $dataImage->image = $storeFolder . '/' . $newFileName;
                    $dataImage->active_status = '1';
                    $dataImage->display_status = '1';
                    $dataImage->sort_number = '1';
                    $dataImage->ip_address = $request->ip();
                    $dataImage->created_by = Auth::user()->id;
                    $dataImage->updated_by = Auth::user()->id;
                    $dataImage->save();
                }
            }
            $images->save();

            //รูปเพิ่มเติม
            if (isset($request->image_more)) {
                for ($i = 0; $i < count($request->image_more); $i++) {
                    $storeFolder = 'assets/frontend/img/projects_reference_main/' . $data->id; //2
                    if ($request->hasFile('image_more')) {
                        $newFileName = $random2 . '.' . $request->image_more[$i]->extension();
                        if (!is_dir($storeFolder)) {
                            mkdir($storeFolder, 0777, true);
                        }
                        // $request->image_more[$i]->move(public_path($storeFolder), $newFileName);
                        $RealPath = 'assets/../assets/frontend/img/projects_reference_main/' . $data->id;
                        Image::make($request->image_more[$i]->getRealPath())->save($RealPath . '/' . $newFileName);

                        $images_more = new ProjectsReferenceImage();
                        $images_more->projects_reference_id = $data->id;
                        $images_more->image = $storeFolder . '/' . $newFileName;
                        $images_more->active_status = '1';
                        $images_more->display_status = '1';
                        $images_more->sort_number = $i + 2;
                        $images_more->ip_address = $request->ip();
                        $images_more->created_by = Auth::user()->id;
                        $images_more->updated_by = Auth::user()->id;
                        $images_more->save();
                    }
                }
            }
            Log::info("ProjectsReferenceMainController : store");
            Log::info($request);

            DB::commit();

            return redirect()->route('projectsreferencemain.index');
        } catch (\PDOException $e) {
            Log::info("ProjectsReferenceMainController : store");
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
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูลผลงาน";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["ProjectsReferenceMain"] = ProjectsReferenceMain::find($id);
        $data["Images"] = ProjectsReferenceImage::where('projects_reference_id', $id)->orderBy('sort_number', 'asc')->get();

        Log::info("ProjectsReferenceMainController : edit id = " . $id);
        Log::info($data);

        return view('backend.projects_reference_main.edit', $data);
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

            $data = ProjectsReferenceMain::find($id);;
            $data->projects_reference_type_id = $request->projects_reference_type_id;
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->seament_th = $request->seament_th;
            $data->seament_en = $request->seament_en;
            $data->project_owner_th = $request->project_owner_th;
            $data->project_owner_en = $request->project_owner_en;
            $data->project_value = $request->project_value;
            $data->project_start = $request->project_start;
            $data->project_completion = $request->project_completion;
            $data->project_start_month = $request->project_start_month;
            $data->project_completion_month = $request->project_completion_month;
            $data->ip_address = $request->ip();
            $data->active_status = $request->active_status;
            $data->display_status = $request->display_status;
            $data->sort_number = $request->sort_number;
            $data->created_by = $request->created_by;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }
            $images = ProjectsReferenceMain::find($data->id);
            if ($request->image_main == null) {
                if ($request->image_mainOld == null) {
                    $images->image_main = 'Unknown';
                } else {
                    $images->image_main =  $request->image_mainOld;
                }
            } else {

                $storeFolder = 'assets/frontend/img/projects_reference_main/' . $data->id; //2
                if ($request->hasFile('image_main')) {
                    $newFileName = $random . '.' . $request->image_main->extension();
                    $images->image_main = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    // $request->image_main->move(public_path($storeFolder), $newFileName);
                    $RealPath = 'assets/../assets/frontend/img/projects_reference_main/' . $data->id;
                    Image::make($request->image_main->getRealPath())->save($RealPath . '/' . $newFileName);

                    $table_image = ProjectsReferenceImage::where('projects_reference_id', $data->id)->where('sort_number', 1)->first();

                    if ($table_image) {
                        $table_image->image =  $images->image_main;
                        $table_image->updated_by = Auth::user()->id;
                        $table_image->save();
                    } else {
                        $dataImage = new ProjectsReferenceImage();
                        $dataImage->projects_reference_id = $data->id;
                        $dataImage->image = $storeFolder . '/' . $newFileName;
                        $dataImage->active_status = '1';
                        $dataImage->display_status = '1';
                        $dataImage->sort_number = '1';
                        $dataImage->ip_address = $request->ip();
                        $dataImage->created_by = Auth::user()->id;
                        $dataImage->updated_by = Auth::user()->id;
                        $dataImage->save();
                    }
                }
            }
            $images->save();

            //รูปเพิ่มเติม
            if ($request->image_more) {
                $table_image_old = ProjectsReferenceImage::where('projects_reference_id', $data->id)->orderBy('sort_number', 'desc')->first();
                if ($table_image_old) {
                    $sort_image = $table_image_old->sort + 1;
                } else {
                    $sort_image = 2;
                }
                for ($i = 0; $i < count($request->image_more); $i++) {
                    $storeFolder = 'assets/frontend/img/projects_reference_main/' . $data->id; //2
                    if ($request->hasFile('image_more')) {
                        $newFileName = $random2 . '.' . $request->image_more[$i]->extension();
                        if (!is_dir($storeFolder)) {
                            mkdir($storeFolder, 0777, true);
                        }
                        // $request->image_more[$i]->move(public_path($storeFolder), $newFileName);
                        $RealPath = 'assets/../assets/frontend/img/projects_reference_main/' . $data->id;
                        Image::make($request->image_more[$i]->getRealPath())->save($RealPath . '/' . $newFileName);

                        $images_more = new ProjectsReferenceImage();
                        $images_more->projects_reference_id = $data->id;
                        $images_more->image = $storeFolder . '/' . $newFileName;
                        $images_more->active_status = '1';
                        $images_more->display_status = '1';
                        $images_more->sort_number = $i + $sort_image + 2;
                        $images_more->ip_address = $request->ip();
                        $images_more->created_by = Auth::user()->id;
                        $images_more->updated_by = Auth::user()->id;
                        $images_more->save();
                    }
                }
            }
            Log::info("ProjectsReferenceMainController : update id = " . $id);
            Log::info($request);

            DB::commit();

            return redirect()->route('projectsreferencemain.index');
        } catch (\PDOException $e) {
            Log::info("ProjectsReferenceMainController : update id = " . $id);
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
    public function destoyImage($id)
    {
        try {
            $Images = ProjectsReferenceImage::find($id);
            if ($Images) {
                $name_imh_delete = $Images->image;
                Log::info("user id " . Auth::user()->id . " ได้ทำการลบรูปภาพ " . $name_imh_delete);
            }
            $Images->delete();
            return response(200);
        } catch (\PDOException $e) {
            log::error($e);
            return response(500);
        }
    }
    public function updateDelete(Request $request)
    {

        try {
            DB::beginTransaction();

            $data = ProjectsReferenceMain::find($request->id);
            $data->active_status = '0';
            $data->display_status = '2';
            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            Log::info("ProjectsReferenceMainController : updateDelete");
            Log::info($request);

            DB::commit();

            return response(200);
        } catch (\PDOException $e) {
            Log::info("ProjectsReferenceMainController : updateDelete");
            Log::error($e);

            DB::rollBack();

            Alert::error('ไม่สำเร็จ', 'คุณทำรายการที่ต้องการไม่สำเร็จกรุณาทำรายการใหม่');
            return response(300);
        }
    }
}
