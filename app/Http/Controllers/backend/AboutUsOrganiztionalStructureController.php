<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUsOrganiztional;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class AboutUsOrganiztionalStructureController extends Controller
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

        $titlePage = "จัดการข้อมูล About Us โครงสร้างองค์กร (Organizational Structure)";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();

        // Check and assign sequential sort numbers 1-6 if there are gaps or duplicates
        $hasDuplicatesOrGaps = AboutUsOrganiztional::where('active_status', 1)
            ->whereIn('sort_number', [5, 10])
            ->exists();

        if ($hasDuplicatesOrGaps) {
            // Assign specific clean order:
            $orderMap = [
                'ภาณุวัฒน์' => 1,
                'สมเกียรติ' => 2,
                'สุชาติ' => 3,
                'วีระสิงห์' => 4,
                'อารยา' => 5,
                'เจม' => 6,
            ];

            foreach ($orderMap as $nameKeyword => $orderNum) {
                AboutUsOrganiztional::where('active_status', 1)
                    ->where('full_name_th', 'LIKE', '%' . $nameKeyword . '%')
                    ->update(['sort_number' => $orderNum]);
            }
        }

        $AboutUsOrganiztional = AboutUsOrganiztional::where('active_status', 1);

        // search
        if ($request->filled('search')) {
            $search_q = $request->search;
            $AboutUsOrganiztional = $AboutUsOrganiztional->where(function ($q) use ($search_q) {
                $q->where('full_name_th', 'LIKE', '%' . $search_q . '%')
                  ->orWhere('full_name_en', 'LIKE', '%' . $search_q . '%')
                  ->orWhere('position_th', 'LIKE', '%' . $search_q . '%')
                  ->orWhere('position_en', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->filled('startd_at')) {
            $AboutUsOrganiztional = $AboutUsOrganiztional->where('created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->filled('ended_at')) {
            $AboutUsOrganiztional = $AboutUsOrganiztional->where('created_at', '<=', $request->ended_at . ' 23:59:59');
        }

        $AboutUsOrganiztional = $AboutUsOrganiztional->orderBy('sort_number', 'asc')->paginate(10);
        Log::info("AboutUsOrganiztionalStructureController : index");

        return view('backend.about_organiztional.index', [
            'AboutUsOrganiztional' => $AboutUsOrganiztional,
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
        $data["titlePage"] = "สร้างข้อมูล About Us โครงสร้างองค์กร";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $count = AboutUsOrganiztional::where('active_status', 1)->count();

        $data['sort_number'] = $count + 1;

        Log::info("AboutUsOrganiztionalStructureController : create");

        return view('backend.about_organiztional.create', $data);
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
            'full_name_th' => 'required',
            'position_th' => 'required',
        ], [
            'full_name_th.required' => 'กรุณากรอกชื่อ-นามสกุล ภาษาไทย',
            'position_th.required' => 'กรุณากรอกตำแหน่งงาน ภาษาไทย',
        ]);

        try {
            DB::beginTransaction();

            $data = new AboutUsOrganiztional();
            $data->full_name_th = $request->full_name_th;
            $data->full_name_en = $request->full_name_en;
            $data->position_th = $request->position_th;
            $data->position_en = $request->position_en;
            $data->study_th = $request->study_th;
            $data->study_en = $request->study_en;
            $data->work_th = $request->work_th;
            $data->work_en = $request->work_en;
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
                $ext = $file->getClientOriginalExtension() ?: 'png';
                $newFileName = time() . '_' . Str::random(8) . '.' . $ext;
                $relFolder = 'assets/frontend/img/AboutUsOrganiztional/' . $data->id;

                $publicDir = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, public_path($relFolder));
                $baseDir   = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, base_path($relFolder));

                if (!file_exists($publicDir)) {
                    @mkdir($publicDir, 0777, true);
                }
                if (!file_exists($baseDir)) {
                    @mkdir($baseDir, 0777, true);
                }

                $destFile = $publicDir . DIRECTORY_SEPARATOR . $newFileName;
                Image::make($file->getRealPath())->fit(400, 500, function ($constraint) {
                    $constraint->upsize();
                })->save($destFile, 90);

                if ($publicDir !== $baseDir && file_exists($baseDir)) {
                    @copy($destFile, $baseDir . DIRECTORY_SEPARATOR . $newFileName);
                }

                $data->image_main = $relFolder . '/' . $newFileName;
                $data->save();
            }

            DB::commit();

            Alert::success('สำเร็จ', 'เพิ่มข้อมูลโครงสร้างองค์กรเรียบร้อยแล้ว');
            return redirect()->route('aboutusorganiztionalstructure.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsOrganiztionalStructureController : store error -> " . $e->getMessage());
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
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูล About Us โครงสร้างองค์กร";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["AboutUsOrganiztional"] = AboutUsOrganiztional::findOrFail($id);

        Log::info("AboutUsOrganiztionalStructureController : edit id = " . $id);

        return view('backend.about_organiztional.edit', $data);
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
            'full_name_th' => 'required',
            'position_th' => 'required',
        ], [
            'full_name_th.required' => 'กรุณากรอกชื่อ-นามสกุล ภาษาไทย',
            'position_th.required' => 'กรุณากรอกตำแหน่งงาน ภาษาไทย',
        ]);

        try {
            DB::beginTransaction();

            $data = AboutUsOrganiztional::findOrFail($id);
            $data->full_name_th = $request->full_name_th;
            $data->full_name_en = $request->full_name_en;
            $data->position_th = $request->position_th;
            $data->position_en = $request->position_en;
            $data->study_th = $request->study_th;
            $data->study_en = $request->study_en;
            $data->work_th = $request->work_th;
            $data->work_en = $request->work_en;
            $data->sort_number = $request->sort_number ?? $data->sort_number;
            $data->active_status = $request->active_status ?? 1;
            $data->display_status = $request->display_status ?? 1;
            $data->ip_address = $request->ip();
            $data->updated_by = Auth::id() ?? 1;

            if ($request->hasFile('image_main')) {
                $file = $request->file('image_main');
                $ext = $file->getClientOriginalExtension() ?: 'png';
                $newFileName = time() . '_' . Str::random(8) . '.' . $ext;
                $relFolder = 'assets/frontend/img/AboutUsOrganiztional/' . $data->id;

                $publicDir = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, public_path($relFolder));
                $baseDir   = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, base_path($relFolder));

                if (!file_exists($publicDir)) {
                    @mkdir($publicDir, 0777, true);
                }
                if (!file_exists($baseDir)) {
                    @mkdir($baseDir, 0777, true);
                }

                $destFile = $publicDir . DIRECTORY_SEPARATOR . $newFileName;
                Image::make($file->getRealPath())->fit(400, 500, function ($constraint) {
                    $constraint->upsize();
                })->save($destFile, 90);

                if ($publicDir !== $baseDir && file_exists($baseDir)) {
                    @copy($destFile, $baseDir . DIRECTORY_SEPARATOR . $newFileName);
                }

                $data->image_main = $relFolder . '/' . $newFileName;
            } elseif ($request->filled('image_mainOld')) {
                $data->image_main = $request->image_mainOld;
            }

            $data->save();

            DB::commit();

            Alert::success('สำเร็จ', 'แก้ไขข้อมูลโครงสร้างองค์กรเรียบร้อยแล้ว');
            return redirect()->route('aboutusorganiztionalstructure.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsOrganiztionalStructureController : update error -> " . $e->getMessage());
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
            $data = AboutUsOrganiztional::find($id);
            if ($data) {
                // Delete image folder if exists
                $storeFolder = 'assets/frontend/img/AboutUsOrganiztional/' . $data->id;
                if (File::isDirectory(public_path($storeFolder))) {
                    File::deleteDirectory(public_path($storeFolder));
                }
                if (File::isDirectory(base_path($storeFolder))) {
                    File::deleteDirectory(base_path($storeFolder));
                }

                $data->delete();
                Alert::success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว');
            } else {
                Alert::warning('ไม่พบข้อมูล', 'ไม่พบข้อมูลที่ต้องการลบ');
            }
        } catch (\Throwable $e) {
            Log::error("AboutUsOrganiztionalStructureController : destroy error -> " . $e->getMessage());
            Alert::error('ไม่สำเร็จ', 'เกิดข้อผิดพลาดในการลบข้อมูล');
        }

        return redirect()->route('aboutusorganiztionalstructure.index');
    }

    public function updateDelete(Request $request)
    {
        try {
            $data = AboutUsOrganiztional::find($request->id);
            if ($data) {
                $data->active_status = 0;
                $data->display_status = 2;
                $data->save();
            }
            return response()->json(['status' => '200', 'message' => 'success']);
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json(['status' => '500', 'message' => $e->getMessage()], 500);
        }
    }

    public function resequence()
    {
        try {
            $items = AboutUsOrganiztional::where('active_status', 1)->orderBy('sort_number', 'asc')->get();
            $index = 1;
            foreach ($items as $item) {
                $item->sort_number = $index++;
                $item->save();
            }
            Alert::success('สำเร็จ', 'จัดเรียงลำดับตัวเลข 1, 2, 3... ใหม่อัตโนมัติเรียบร้อยแล้ว');
        } catch (\Throwable $e) {
            Log::error("AboutUsOrganiztionalStructureController : resequence error -> " . $e->getMessage());
            Alert::error('ไม่สำเร็จ', 'เกิดข้อผิดพลาดในการจัดเรียง: ' . $e->getMessage());
        }
        return redirect()->route('aboutusorganiztionalstructure.index');
    }
}
