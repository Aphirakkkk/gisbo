<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUsMain;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class AboutUsController extends Controller
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

        $titlePage = "จัดการข้อมูล About Us หน้าแรก (About Us Home)";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $AboutUsMain = AboutUsMain::where('active_status', 1);

        // search
        if ($request->filled('search')) {
            $search_q = $request->search;
            $AboutUsMain = $AboutUsMain->where(function ($q) use ($search_q) {
                $q->where('tilte_th', 'LIKE', '%' . $search_q . '%')
                  ->orWhere('tilte_en', 'LIKE', '%' . $search_q . '%')
                  ->orWhere('detail_th', 'LIKE', '%' . $search_q . '%')
                  ->orWhere('detail_en', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->filled('startd_at')) {
            $AboutUsMain = $AboutUsMain->where('created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->filled('ended_at')) {
            $AboutUsMain = $AboutUsMain->where('created_at', '<=', $request->ended_at . ' 23:59:59');
        }

        $AboutUsMain = $AboutUsMain->orderBy('sort_number', 'asc')->paginate(10);
        Log::info("AboutUsController : index");

        return view('backend.about_us_main.index', [
            'AboutUsMain' => $AboutUsMain,
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
        $data["titlePage"] = "สร้างข้อมูล About Us หน้าแรก (About Us Home)";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = AboutUsMain::where('active_status', 1)->orderBy('sort_number', 'desc')->first();

        $data['sort_number'] = $sort ? ($sort->sort_number + 1) : 1;

        Log::info("AboutUsController : create");

        return view('backend.about_us_main.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tilte_th' => 'required',
        ], [
            'tilte_th.required' => 'กรุณากรอกหัวข้อภาษาไทย',
        ]);

        try {
            DB::beginTransaction();

            $data = new AboutUsMain();
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->detail_th = $request->detail_th;
            $data->detail_en = $request->detail_en;
            $data->active_status = 1;
            $data->display_status = 1;
            $data->sort_number = $request->sort_number ?? 1;
            $data->ip_address = $request->ip();
            $data->created_by = Auth::id() ?? 1;
            $data->updated_by = Auth::id() ?? 1;
            $data->save();

            DB::commit();

            Alert::success('สำเร็จ', 'เพิ่มข้อมูล About Us หน้าแรกเรียบร้อยแล้ว');
            return redirect()->route('aboutus.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsController : store error -> " . $e->getMessage());
            Alert::error('ไม่สำเร็จ', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
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
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูล About Us หน้าแรก (About Us Home)";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["AboutUsMain"] = AboutUsMain::findOrFail($id);

        Log::info("AboutUsController : edit id = " . $id);

        return view('backend.about_us_main.edit', $data);
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
        $request->validate([
            'tilte_th' => 'required',
        ], [
            'tilte_th.required' => 'กรุณากรอกหัวข้อภาษาไทย',
        ]);

        try {
            DB::beginTransaction();

            $data = AboutUsMain::findOrFail($id);
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->detail_th = $request->detail_th;
            $data->detail_en = $request->detail_en;
            $data->sort_number = $request->sort_number ?? $data->sort_number;
            $data->active_status = $request->active_status ?? 1;
            $data->display_status = $request->display_status ?? 1;
            $data->ip_address = $request->ip();
            $data->updated_by = Auth::id() ?? 1;
            $data->save();

            DB::commit();

            Alert::success('สำเร็จ', 'แก้ไขข้อมูล About Us หน้าแรกเรียบร้อยแล้ว');
            return redirect()->route('aboutus.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsController : update error -> " . $e->getMessage());
            Alert::error('ไม่สำเร็จ', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
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
        try {
            $data = AboutUsMain::find($id);
            if ($data) {
                $data->delete();
                Alert::success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว');
            } else {
                Alert::warning('ไม่พบข้อมูล', 'ไม่พบข้อมูลที่ต้องการลบ');
            }
        } catch (\Throwable $e) {
            Log::error("AboutUsController : destroy error -> " . $e->getMessage());
            Alert::error('ไม่สำเร็จ', 'เกิดข้อผิดพลาดในการลบข้อมูล');
        }

        return redirect()->route('aboutus.index');
    }

    public function updateDelete(Request $request)
    {
        try {
            $data = AboutUsMain::find($request->id);
            if ($data) {
                $data->active_status = 0;
                $data->display_status = 2;
                $data->save();
            }
            return response()->json(['status' => 200, 'message' => 'success']);
        } catch (\Throwable $e) {
            Log::error("AboutUsController : updateDelete error -> " . $e->getMessage());
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }
}
