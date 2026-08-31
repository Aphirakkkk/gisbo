<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUsIEC;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class AboutUsIECController extends Controller
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

        $titlePage = "จัดการข้อมูล About Us ISO / IEC 27001";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $AboutUsIEC = AboutUsIEC::where('active_status', 1);

        if ($request->filled('startd_at')) {
            $AboutUsIEC = $AboutUsIEC->where('created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->filled('ended_at')) {
            $AboutUsIEC = $AboutUsIEC->where('created_at', '<=', $request->ended_at . ' 23:59:59');
        }

        $AboutUsIEC = $AboutUsIEC->orderBy('sort_number', 'asc')->paginate(10);
        Log::info("AboutUsIECController : index");

        return view('backend.about_iec.index', [
            'AboutUsIEC' => $AboutUsIEC,
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
        $data["titlePage"] = "สร้างข้อมูล About Us ISO / IEC 27001";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = AboutUsIEC::where('active_status', 1)->orderBy('sort_number', 'desc')->first();

        $data['sort_number'] = $sort ? ($sort->sort_number + 1) : 1;

        Log::info("AboutUsIECController : create");

        return view('backend.about_iec.create', $data);
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
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ], [
            'image1.required' => 'กรุณาเลือกรูปภาพใบรับรอง ISO (หน้าที่ 1)',
            'image1.image' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพเท่านั้น',
        ]);

        try {
            DB::beginTransaction();

            $data = new AboutUsIEC();
            $data->active_status = 1;
            $data->display_status = 1;
            $data->sort_number = $request->sort_number ?? 1;
            $data->image1 = 'assets/backend/images/error/nopic.jpg';
            $data->image2 = 'assets/backend/images/error/nopic.jpg';
            $data->ip_address = $request->ip();
            $data->created_by = Auth::id() ?? 1;
            $data->updated_by = Auth::id() ?? 1;
            $data->save();

            $storeFolder = 'assets/frontend/img/about_iec/' . $data->id;

            if (!File::isDirectory(public_path($storeFolder))) {
                File::makeDirectory(public_path($storeFolder), 0777, true, true);
            }
            if (!File::isDirectory(base_path($storeFolder))) {
                File::makeDirectory(base_path($storeFolder), 0777, true, true);
            }

            if ($request->hasFile('image1')) {
                $file1 = $request->file('image1');
                $ext1 = $file1->getClientOriginalExtension() ?: 'jpg';
                $name1 = 'cert1_' . time() . '_' . Str::random(6) . '.' . $ext1;
                $dest1 = public_path($storeFolder . '/' . $name1);
                Image::make($file1->getRealPath())->save($dest1, 95);

                if (base_path($storeFolder) !== public_path($storeFolder)) {
                    @copy($dest1, base_path($storeFolder . '/' . $name1));
                }
                $data->image1 = $storeFolder . '/' . $name1;
            }

            if ($request->hasFile('image2')) {
                $file2 = $request->file('image2');
                $ext2 = $file2->getClientOriginalExtension() ?: 'jpg';
                $name2 = 'cert2_' . time() . '_' . Str::random(6) . '.' . $ext2;
                $dest2 = public_path($storeFolder . '/' . $name2);
                Image::make($file2->getRealPath())->save($dest2, 95);

                if (base_path($storeFolder) !== public_path($storeFolder)) {
                    @copy($dest2, base_path($storeFolder . '/' . $name2));
                }
                $data->image2 = $storeFolder . '/' . $name2;
            }

            $data->save();

            DB::commit();

            Alert::success('สำเร็จ', 'เพิ่มข้อมูลใบรับรอง ISO / IEC 27001 เรียบร้อยแล้ว');
            return redirect()->route('aboutusiec.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsIECController : store error -> " . $e->getMessage());
            Alert::error('ไม่สำเร็จ', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูล About Us ISO / IEC 27001";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["AboutUsIEC"] = AboutUsIEC::findOrFail($id);

        Log::info("AboutUsIECController : edit id = " . $id);

        return view('backend.about_iec.edit', $data);
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

            $data = AboutUsIEC::findOrFail($id);
            $data->sort_number = $request->sort_number ?? $data->sort_number;
            $data->active_status = $request->active_status ?? 1;
            $data->display_status = $request->display_status ?? 1;
            $data->ip_address = $request->ip();
            $data->updated_by = Auth::id() ?? 1;

            $storeFolder = 'assets/frontend/img/about_iec/' . $data->id;

            if (!File::isDirectory(public_path($storeFolder))) {
                File::makeDirectory(public_path($storeFolder), 0777, true, true);
            }
            if (!File::isDirectory(base_path($storeFolder))) {
                File::makeDirectory(base_path($storeFolder), 0777, true, true);
            }

            if ($request->hasFile('image1')) {
                $file1 = $request->file('image1');
                $ext1 = $file1->getClientOriginalExtension() ?: 'jpg';
                $name1 = 'cert1_' . time() . '_' . Str::random(6) . '.' . $ext1;
                $dest1 = public_path($storeFolder . '/' . $name1);
                Image::make($file1->getRealPath())->save($dest1, 95);

                if (base_path($storeFolder) !== public_path($storeFolder)) {
                    @copy($dest1, base_path($storeFolder . '/' . $name1));
                }
                $data->image1 = $storeFolder . '/' . $name1;
            } elseif ($request->filled('image1Old')) {
                $data->image1 = $request->image1Old;
            }

            if ($request->hasFile('image2')) {
                $file2 = $request->file('image2');
                $ext2 = $file2->getClientOriginalExtension() ?: 'jpg';
                $name2 = 'cert2_' . time() . '_' . Str::random(6) . '.' . $ext2;
                $dest2 = public_path($storeFolder . '/' . $name2);
                Image::make($file2->getRealPath())->save($dest2, 95);

                if (base_path($storeFolder) !== public_path($storeFolder)) {
                    @copy($dest2, base_path($storeFolder . '/' . $name2));
                }
                $data->image2 = $storeFolder . '/' . $name2;
            } elseif ($request->filled('image2Old')) {
                $data->image2 = $request->image2Old;
            }

            $data->save();

            DB::commit();

            Alert::success('สำเร็จ', 'แก้ไขข้อมูลใบรับรอง ISO / IEC 27001 เรียบร้อยแล้ว');
            return redirect()->route('aboutusiec.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsIECController : update error -> " . $e->getMessage());
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
            $data = AboutUsIEC::find($id);
            if ($data) {
                // Delete physical files
                $folder = 'assets/frontend/img/about_iec/' . $id;
                if (File::isDirectory(public_path($folder))) {
                    File::deleteDirectory(public_path($folder));
                }
                if (File::isDirectory(base_path($folder))) {
                    File::deleteDirectory(base_path($folder));
                }

                $data->delete();
                Alert::success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว');
            } else {
                Alert::warning('ไม่พบข้อมูล', 'ไม่พบข้อมูลที่ต้องการลบ');
            }
        } catch (\Throwable $e) {
            Log::error("AboutUsIECController : destroy error -> " . $e->getMessage());
            Alert::error('ไม่สำเร็จ', 'เกิดข้อผิดพลาดในการลบข้อมูล');
        }

        return redirect()->route('aboutusiec.index');
    }

    public function updateDelete(Request $request)
    {
        try {
            $data = AboutUsIEC::find($request->id);
            if ($data) {
                $data->active_status = 0;
                $data->display_status = 2;
                $data->save();
            }
            return response()->json(['status' => 200, 'message' => 'success']);
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }
}
