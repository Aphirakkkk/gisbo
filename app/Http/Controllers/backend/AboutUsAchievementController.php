<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUsAchievementDetail;
use App\Models\AboutUsAchievementImage;
use App\Models\AboutUsAchievementMain;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class AboutUsAchievementController extends Controller
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

        $titlePage = "จัดการข้อมูล About Us ความสำเร็จ / รางวัล (Achievement)";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $AboutUsAchievementMain = AboutUsAchievementMain::with('aboutUsAchievementDetail')->where('active_status', 1);

        // start search
        if ($request->filled('search')) {
            $search_q = $request->search;
            $AboutUsAchievementMain = $AboutUsAchievementMain->where(function ($q) use ($search_q) {
                $q->where('tilte_th', 'LIKE', '%' . $search_q . '%')
                  ->orWhere('tilte_en', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->filled('startd_at')) {
            $AboutUsAchievementMain = $AboutUsAchievementMain->where('created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->filled('ended_at')) {
            $AboutUsAchievementMain = $AboutUsAchievementMain->where('created_at', '<=', $request->ended_at . ' 23:59:59');
        }

        $AboutUsAchievementMain = $AboutUsAchievementMain->orderBy('sort_number', 'asc')->paginate(10);
        Log::info("AboutUsAchievementMainController : index");

        return view('backend.about_achievement_main.index', [
            'AboutUsAchievementMain' => $AboutUsAchievementMain,
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
        $data["titlePage"] = "สร้างข้อมูล About Us ความสำเร็จ / รางวัล";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = AboutUsAchievementMain::where('active_status', 1)->orderBy('sort_number', 'desc')->first();

        $data['sort_number'] = $sort ? ($sort->sort_number + 1) : 1;

        Log::info("AboutUsAchievementMainController : create");

        return view('backend.about_achievement_main.create', $data);
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

            $data = new AboutUsAchievementMain();
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->active_status = 1;
            $data->display_status = 1;
            $data->sort_number = $request->sort_number ?? 1;
            $data->ip_address = $request->ip();
            $data->created_by = Auth::id() ?? 1;
            $data->updated_by = Auth::id() ?? 1;
            $data->image_main = 'assets/backend/images/error/nopic.jpg';
            $data->save();

            $dataDetail = new AboutUsAchievementDetail();
            $dataDetail->about_achievement_main_id = $data->id;
            $dataDetail->tilte_th = $request->tilte_thDetail ?: $request->tilte_th;
            $dataDetail->tilte_en = $request->tilte_enDetail ?: $request->tilte_en;
            $dataDetail->date = $request->dateDetail ?: date('Y-m-d');
            $dataDetail->detail_th = $request->detail_thDetail;
            $dataDetail->detail_en = $request->detail_enDetail;
            $dataDetail->active_status = 1;
            $dataDetail->display_status = 1;
            $dataDetail->sort_number = $request->sort_number ?? 1;
            $dataDetail->ip_address = $request->ip();
            $dataDetail->created_by = Auth::id() ?? 1;
            $dataDetail->updated_by = Auth::id() ?? 1;
            $dataDetail->save();

            // Main Image
            if ($request->hasFile('image_main')) {
                $file = $request->file('image_main');
                $ext = $file->getClientOriginalExtension() ?: 'jpg';
                $newFileName = time() . '_' . Str::random(8) . '.' . $ext;
                $storeFolder = 'assets/frontend/img/about_achievement_main/' . $data->id;

                if (!File::isDirectory(public_path($storeFolder))) {
                    File::makeDirectory(public_path($storeFolder), 0777, true, true);
                }
                if (!File::isDirectory(base_path($storeFolder))) {
                    File::makeDirectory(base_path($storeFolder), 0777, true, true);
                }

                $destinationPath = public_path($storeFolder . '/' . $newFileName);
                Image::make($file->getRealPath())->fit(720, 480, function ($constraint) {
                    $constraint->upsize();
                })->save($destinationPath, 90);

                if (base_path($storeFolder) !== public_path($storeFolder)) {
                    @copy($destinationPath, base_path($storeFolder . '/' . $newFileName));
                }

                $data->image_main = $storeFolder . '/' . $newFileName;
                $data->save();

                $dataImage = new AboutUsAchievementImage();
                $dataImage->about_achievement_id = $data->id;
                $dataImage->image = $storeFolder . '/' . $newFileName;
                $dataImage->active_status = 1;
                $dataImage->display_status = 1;
                $dataImage->sort_number = 1;
                $dataImage->ip_address = $request->ip();
                $dataImage->created_by = Auth::id() ?? 1;
                $dataImage->updated_by = Auth::id() ?? 1;
                $dataImage->save();
            }

            // More Images
            if ($request->hasFile('image_more')) {
                $moreFiles = $request->file('image_more');
                foreach ($moreFiles as $idx => $moreFile) {
                    if ($moreFile) {
                        $ext = $moreFile->getClientOriginalExtension() ?: 'jpg';
                        $moreFileName = time() . '_' . Str::random(8) . '_' . ($idx + 2) . '.' . $ext;
                        $storeFolder = 'assets/frontend/img/about_achievement_main/' . $data->id;

                        if (!File::isDirectory(public_path($storeFolder))) {
                            File::makeDirectory(public_path($storeFolder), 0777, true, true);
                        }
                        if (!File::isDirectory(base_path($storeFolder))) {
                            File::makeDirectory(base_path($storeFolder), 0777, true, true);
                        }

                        $destinationPath = public_path($storeFolder . '/' . $moreFileName);
                        Image::make($moreFile->getRealPath())->fit(1080, 600, function ($constraint) {
                            $constraint->upsize();
                        })->save($destinationPath, 90);

                        if (base_path($storeFolder) !== public_path($storeFolder)) {
                            @copy($destinationPath, base_path($storeFolder . '/' . $moreFileName));
                        }

                        $images_more = new AboutUsAchievementImage();
                        $images_more->about_achievement_id = $data->id;
                        $images_more->image = $storeFolder . '/' . $moreFileName;
                        $images_more->active_status = 1;
                        $images_more->display_status = 1;
                        $images_more->sort_number = $idx + 2;
                        $images_more->ip_address = $request->ip();
                        $images_more->created_by = Auth::id() ?? 1;
                        $images_more->updated_by = Auth::id() ?? 1;
                        $images_more->save();
                    }
                }
            }

            DB::commit();

            Alert::success('สำเร็จ', 'เพิ่มข้อมูลความสำเร็จ / รางวัลเรียบร้อยแล้ว');
            return redirect()->route('aboutusachievement.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsAchievementMainController : store error -> " . $e->getMessage());
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
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูล About Us ความสำเร็จ / รางวัล";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $achievement = AboutUsAchievementMain::with('aboutUsAchievementDetail')->findOrFail($id);

        if (!$achievement->aboutUsAchievementDetail) {
            $dataDetail = new AboutUsAchievementDetail();
            $dataDetail->about_achievement_main_id = $achievement->id;
            $dataDetail->tilte_th = $achievement->tilte_th;
            $dataDetail->tilte_en = $achievement->tilte_en;
            $dataDetail->date = date('Y-m-d');
            $dataDetail->active_status = 1;
            $dataDetail->display_status = 1;
            $dataDetail->sort_number = $achievement->sort_number ?? 1;
            $dataDetail->save();
            $achievement->load('aboutUsAchievementDetail');
        }

        $data["AboutUsAchievementMain"] = $achievement;
        $data["Images"] = AboutUsAchievementImage::where('about_achievement_id', $id)->orderBy('sort_number', 'asc')->get();

        Log::info("AboutUsAchievementMainController : edit id = " . $id);

        return view('backend.about_achievement_main.edit', $data);
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

            $data = AboutUsAchievementMain::findOrFail($id);
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->active_status = $request->active_status ?? 1;
            $data->display_status = $request->display_status ?? 1;
            $data->sort_number = $request->sort_number ?? $data->sort_number;
            $data->ip_address = $request->ip();
            $data->updated_by = Auth::id() ?? 1;

            $dataDetail = AboutUsAchievementDetail::where('about_achievement_main_id', $id)->first();
            if (!$dataDetail) {
                $dataDetail = new AboutUsAchievementDetail();
                $dataDetail->about_achievement_main_id = $id;
            }
            $dataDetail->tilte_th = $request->tilte_thDetail ?: $request->tilte_th;
            $dataDetail->tilte_en = $request->tilte_enDetail ?: $request->tilte_en;
            $dataDetail->date = $request->dateDetail ?: date('Y-m-d');
            $dataDetail->detail_th = $request->detail_thDetail;
            $dataDetail->detail_en = $request->detail_enDetail;
            $dataDetail->ip_address = $request->ip();
            $dataDetail->active_status = $request->active_status ?? 1;
            $dataDetail->display_status = $request->display_status ?? 1;
            $dataDetail->sort_number = $request->sort_number ?? $data->sort_number;
            $dataDetail->updated_by = Auth::id() ?? 1;
            $dataDetail->save();

            // Main image
            if ($request->hasFile('image_main')) {
                $file = $request->file('image_main');
                $ext = $file->getClientOriginalExtension() ?: 'jpg';
                $newFileName = time() . '_' . Str::random(8) . '.' . $ext;
                $storeFolder = 'assets/frontend/img/about_achievement_main/' . $data->id;

                if (!File::isDirectory(public_path($storeFolder))) {
                    File::makeDirectory(public_path($storeFolder), 0777, true, true);
                }
                if (!File::isDirectory(base_path($storeFolder))) {
                    File::makeDirectory(base_path($storeFolder), 0777, true, true);
                }

                $destinationPath = public_path($storeFolder . '/' . $newFileName);
                Image::make($file->getRealPath())->fit(720, 480, function ($constraint) {
                    $constraint->upsize();
                })->save($destinationPath, 90);

                if (base_path($storeFolder) !== public_path($storeFolder)) {
                    @copy($destinationPath, base_path($storeFolder . '/' . $newFileName));
                }

                $data->image_main = $storeFolder . '/' . $newFileName;

                $table_image = AboutUsAchievementImage::where('about_achievement_id', $data->id)->where('sort_number', 1)->first();
                if ($table_image) {
                    $table_image->image = $data->image_main;
                    $table_image->updated_by = Auth::id() ?? 1;
                    $table_image->save();
                } else {
                    $dataImage = new AboutUsAchievementImage();
                    $dataImage->about_achievement_id = $data->id;
                    $dataImage->image = $data->image_main;
                    $dataImage->active_status = 1;
                    $dataImage->display_status = 1;
                    $dataImage->sort_number = 1;
                    $dataImage->ip_address = $request->ip();
                    $dataImage->created_by = Auth::id() ?? 1;
                    $dataImage->updated_by = Auth::id() ?? 1;
                    $dataImage->save();
                }
            } elseif ($request->filled('image_mainOld')) {
                $data->image_main = $request->image_mainOld;
            }

            $data->save();

            // More images
            if ($request->hasFile('image_more')) {
                $maxSort = AboutUsAchievementImage::where('about_achievement_id', $data->id)->max('sort_number') ?: 1;
                $moreFiles = $request->file('image_more');
                foreach ($moreFiles as $idx => $moreFile) {
                    if ($moreFile) {
                        $ext = $moreFile->getClientOriginalExtension() ?: 'jpg';
                        $moreFileName = time() . '_' . Str::random(8) . '_' . ($maxSort + $idx + 1) . '.' . $ext;
                        $storeFolder = 'assets/frontend/img/about_achievement_main/' . $data->id;

                        if (!File::isDirectory(public_path($storeFolder))) {
                            File::makeDirectory(public_path($storeFolder), 0777, true, true);
                        }
                        if (!File::isDirectory(base_path($storeFolder))) {
                            File::makeDirectory(base_path($storeFolder), 0777, true, true);
                        }

                        $destinationPath = public_path($storeFolder . '/' . $moreFileName);
                        Image::make($moreFile->getRealPath())->fit(1080, 600, function ($constraint) {
                            $constraint->upsize();
                        })->save($destinationPath, 90);

                        if (base_path($storeFolder) !== public_path($storeFolder)) {
                            @copy($destinationPath, base_path($storeFolder . '/' . $moreFileName));
                        }

                        $images_more = new AboutUsAchievementImage();
                        $images_more->about_achievement_id = $data->id;
                        $images_more->image = $storeFolder . '/' . $moreFileName;
                        $images_more->active_status = 1;
                        $images_more->display_status = 1;
                        $images_more->sort_number = $maxSort + $idx + 1;
                        $images_more->ip_address = $request->ip();
                        $images_more->created_by = Auth::id() ?? 1;
                        $images_more->updated_by = Auth::id() ?? 1;
                        $images_more->save();
                    }
                }
            }

            DB::commit();

            Alert::success('สำเร็จ', 'แก้ไขข้อมูลความสำเร็จ / รางวัลเรียบร้อยแล้ว');
            return redirect()->route('aboutusachievement.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsAchievementMainController : update error -> " . $e->getMessage());
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
            DB::beginTransaction();

            $data = AboutUsAchievementMain::find($id);
            if ($data) {
                // Delete detail
                AboutUsAchievementDetail::where('about_achievement_main_id', $id)->delete();
                // Delete image records
                AboutUsAchievementImage::where('about_achievement_id', $id)->delete();

                // Delete physical image folder
                $storeFolder = 'assets/frontend/img/about_achievement_main/' . $id;
                if (File::isDirectory(public_path($storeFolder))) {
                    File::deleteDirectory(public_path($storeFolder));
                }
                if (File::isDirectory(base_path($storeFolder))) {
                    File::deleteDirectory(base_path($storeFolder));
                }

                $data->delete();

                DB::commit();
                Alert::success('สำเร็จ', 'ลบข้อมูลความสำเร็จ / รางวัลเรียบร้อยแล้ว');
            } else {
                Alert::warning('ไม่พบข้อมูล', 'ไม่พบข้อมูลที่ต้องการลบ');
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsAchievementMainController : destroy error -> " . $e->getMessage());
            Alert::error('ไม่สำเร็จ', 'เกิดข้อผิดพลาดในการลบข้อมูล');
        }

        return redirect()->route('aboutusachievement.index');
    }

    public function destoyImage($id)
    {
        try {
            $Images = AboutUsAchievementImage::find($id);
            if ($Images) {
                if ($Images->image && File::exists(public_path($Images->image))) {
                    File::delete(public_path($Images->image));
                }
                if ($Images->image && File::exists(base_path($Images->image))) {
                    File::delete(base_path($Images->image));
                }
                $Images->delete();
            }
            return response()->json(['status' => 200, 'message' => 'success']);
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateDelete(Request $request)
    {
        try {
            $data = AboutUsAchievementMain::find($request->id);
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
