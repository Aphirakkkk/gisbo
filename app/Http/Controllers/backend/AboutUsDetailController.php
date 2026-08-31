<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUsDetail;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class AboutUsDetailController extends Controller
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

        $titlePage = "จัดการข้อมูล About Us หน้า Detail";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $AboutUsDetail = AboutUsDetail::where('active_status', 1);

        // search
        if ($request->filled('search')) {
            $search_q = $request->search;
            $AboutUsDetail = $AboutUsDetail->where(function ($q) use ($search_q) {
                $q->where('detail_th', 'LIKE', '%' . $search_q . '%')
                  ->orWhere('detail_en', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->filled('startd_at')) {
            $AboutUsDetail = $AboutUsDetail->where('created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->filled('ended_at')) {
            $AboutUsDetail = $AboutUsDetail->where('created_at', '<=', $request->ended_at . ' 23:59:59');
        }

        $AboutUsDetail = $AboutUsDetail->orderBy('sort_number', 'asc')->paginate(10);
        Log::info("AboutUsDetailController : index");

        return view('backend.about_us_detail.index', [
            'AboutUsDetail' => $AboutUsDetail,
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
        $data["titlePage"] = "สร้างข้อมูล About Us หน้า Detail";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = AboutUsDetail::where('active_status', 1)->orderBy('sort_number', 'desc')->first();

        $data['sort_number'] = $sort ? ($sort->sort_number + 1) : 1;

        Log::info("AboutUsDetailController : create");

        return view('backend.about_us_detail.create', $data);
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
            'detail_th' => 'required',
        ], [
            'detail_th.required' => 'กรุณากรอกรายละเอียดภาษาไทย',
        ]);

        try {
            DB::beginTransaction();

            $data = new AboutUsDetail();
            $data->detail_th = $request->detail_th;
            $data->detail_en = $request->detail_en;
            $data->active_status = 1;
            $data->display_status = 1;
            $data->sort_number = $request->sort_number ?? 1;
            $data->ip_address = $request->ip();
            $data->created_by = Auth::id() ?? 1;
            $data->updated_by = Auth::id() ?? 1;
            $data->image_main = 'assets/backend/images/error/nopic.jpg';
            $data->save();

            if ($request->hasFile('image_main')) {
                $file = $request->file('image_main');
                $destinationPath = public_path('assets/frontend/img/AboutUsDetail/' . $data->id);
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
                
                try {
                    Image::make($file->getRealPath())->save($destinationPath . '/' . $fileName);
                } catch (\Throwable $e) {
                    $file->move($destinationPath, $fileName);
                }

                $data->image_main = 'assets/frontend/img/AboutUsDetail/' . $data->id . '/' . $fileName;
                $data->save();
            }

            DB::commit();

            Alert::success('สำเร็จ', 'เพิ่มข้อมูล About Us Detail เรียบร้อยแล้ว');
            return redirect()->route('aboutusdetail.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsDetailController : store error -> " . $e->getMessage());
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
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูล About Us หน้า Detail";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["AboutUsDetail"] = AboutUsDetail::findOrFail($id);

        Log::info("AboutUsDetailController : edit id = " . $id);

        return view('backend.about_us_detail.edit', $data);
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
            'detail_th' => 'required',
        ], [
            'detail_th.required' => 'กรุณากรอกรายละเอียดภาษาไทย',
        ]);

        try {
            DB::beginTransaction();

            $data = AboutUsDetail::findOrFail($id);
            $data->detail_th = $request->detail_th;
            $data->detail_en = $request->detail_en;
            $data->sort_number = $request->sort_number ?? $data->sort_number;
            $data->active_status = $request->active_status ?? 1;
            $data->display_status = $request->display_status ?? 1;
            $data->ip_address = $request->ip();
            $data->updated_by = Auth::id() ?? 1;

            if ($request->hasFile('image_main')) {
                $file = $request->file('image_main');
                $destinationPath = public_path('assets/frontend/img/AboutUsDetail/' . $data->id);
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
                
                try {
                    Image::make($file->getRealPath())->save($destinationPath . '/' . $fileName);
                } catch (\Throwable $e) {
                    $file->move($destinationPath, $fileName);
                }

                $data->image_main = 'assets/frontend/img/AboutUsDetail/' . $data->id . '/' . $fileName;
            } elseif ($request->filled('image_mainOld')) {
                $data->image_main = $request->image_mainOld;
            }

            $data->save();

            DB::commit();

            Alert::success('สำเร็จ', 'แก้ไขข้อมูล About Us Detail เรียบร้อยแล้ว');
            return redirect()->route('aboutusdetail.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsDetailController : update error -> " . $e->getMessage());
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
            $data = AboutUsDetail::find($id);
            if ($data) {
                $data->delete();
                Alert::success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว');
            } else {
                Alert::warning('ไม่พบข้อมูล', 'ไม่พบข้อมูลที่ต้องการลบ');
            }
        } catch (\Throwable $e) {
            Log::error("AboutUsDetailController : destroy error -> " . $e->getMessage());
            Alert::error('ไม่สำเร็จ', 'เกิดข้อผิดพลาดในการลบข้อมูล');
        }

        return redirect()->route('aboutusdetail.index');
    }

    public function updateDelete(Request $request)
    {
        try {
            $data = AboutUsDetail::find($request->id);
            if ($data) {
                $data->active_status = 0;
                $data->display_status = 2;
                $data->save();
            }
            return response()->json(['status' => 200, 'message' => 'success']);
        } catch (\Throwable $e) {
            Log::error("AboutUsDetailController : updateDelete error -> " . $e->getMessage());
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }
}
