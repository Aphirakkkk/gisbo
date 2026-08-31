<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ProjectsReferenceType;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class ProjectsReferenceTypeController extends Controller
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

        $titlePage = "จัดการข้อมูลประเภทผลงาน";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $ProjectsReferenceType = ProjectsReferenceType::where('projects_reference_type.active_status', 1);
        // start search
        if (isset($request->search)) {
            $search_q = $request->search;
            $ProjectsReferenceType = $ProjectsReferenceType->where(function ($q) use ($search_q) {
                $q->Where('projects_reference_type.tilte_th', 'LIKE', '%' . $search_q . '%');
                $q->orWhere('projects_reference_type.tilte_en', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->startd_at) {
            $ProjectsReferenceType = $ProjectsReferenceType->where('projects_reference_type.created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->ended_at) {
            $ProjectsReferenceType = $ProjectsReferenceType->where('projects_reference_type.created_at', '<=', $request->ended_at . ' 23:59:59');
        }
        // end search

        $ProjectsReferenceType = $ProjectsReferenceType->where('projects_reference_type.active_status', 1)->orderby('sort_number', 'desc')->paginate(10);
        Log::info("ProjectsReferenceTypeController : index");
        return view('backend.projects_reference_type.index', [
            'ProjectsReferenceType' => $ProjectsReferenceType,
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
        $data["titlePage"] = "สร้างข้อมูลประเภทผลงาน";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = ProjectsReferenceType::where('projects_reference_type.active_status', 1)->where('projects_reference_type.display_status', 1)->orderby('sort_number', 'desc')->first();

        if ($sort) {
            $data['sort_number'] = $sort->sort_number + 1;
        } else {
            $data['sort_number'] = 1;
        }

        Log::info("ProjectsReferenceTypeController : create");
        Log::info($data);

        return view('backend.projects_reference_type.create', $data);
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

            $data = new ProjectsReferenceType();
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->active_status = '1';
            $data->display_status = '1';
            $data->sort_number = $request->sort_number;
            $data->ip_address = $request->ip();
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            Log::info("ProjectsReferenceTypeController : store");
            Log::info($request);

            DB::commit();

            return redirect()->route('projectsreferencetype.index');
        } catch (\PDOException $e) {
            Log::info("ProjectsReferenceTypeController : store");
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
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูลประเภทผลงาน";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["ProjectsReferenceType"] = ProjectsReferenceType::find($id);
        Log::info("ProjectsReferenceTypeController : edit id = " . $id);
        Log::info($data);

        return view('backend.projects_reference_type.edit', $data);
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

            $data = ProjectsReferenceType::find($id);;
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

            Log::info("ProjectsReferenceTypeController : update id = " . $id);
            Log::info($request);

            DB::commit();

            return redirect()->route('projectsreferencetype.index');
        } catch (\PDOException $e) {
            Log::info("ProjectsReferenceTypeController : update id = " . $id);
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

            $data = ProjectsReferenceType::find($request->id);
            $data->active_status = '0';
            $data->display_status = '2';
            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            Log::info("ProjectsReferenceTypeController : updateDelete");
            Log::info($request);

            DB::commit();

            return response(200);
        } catch (\PDOException $e) {
            Log::info("ProjectsReferenceTypeController : updateDelete");
            Log::error($e);

            DB::rollBack();

            Alert::error('ไม่สำเร็จ', 'คุณทำรายการที่ต้องการไม่สำเร็จกรุณาทำรายการใหม่');
            return response(300);
        }
    }
}
