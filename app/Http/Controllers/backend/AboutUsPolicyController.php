<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUsPolicy;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Image;

class AboutUsPolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->ensureColumnsExist();
    }

    private function ensureColumnsExist()
    {
        try {
            if (Schema::hasTable('about_policy') && !Schema::hasColumn('about_policy', 'tilte_th')) {
                Schema::table('about_policy', function (Blueprint $table) {
                    if (!Schema::hasColumn('about_policy', 'tilte_th')) {
                        $table->text('tilte_th')->nullable();
                    }
                    if (!Schema::hasColumn('about_policy', 'tilte_en')) {
                        $table->text('tilte_en')->nullable();
                    }
                    if (!Schema::hasColumn('about_policy', 'detail_th')) {
                        $table->longText('detail_th')->nullable();
                    }
                    if (!Schema::hasColumn('about_policy', 'detail_en')) {
                        $table->longText('detail_en')->nullable();
                    }
                });
            }

            $policy1 = AboutUsPolicy::first();
            if ($policy1) {
                if (empty($policy1->detail_th) || strpos($policy1->detail_th, '<font') !== false) {
                    $policy1->tilte_th = $policy1->tilte_th ?: 'นโยบายความยั่งยืน';
                    $policy1->tilte_en = $policy1->tilte_en ?: 'Sustainability Policy';
                    $policy1->detail_th = '<p><strong style="color: #e46a25;">GIS Group</strong> เป็นองค์กรที่ให้ความสำคัญกับความยั่งยืนและความรับผิดชอบต่อสิ่งแวดล้อม โดยเฉพาะอย่างยิ่งในการบริหารจัดการพลังงานอย่างมีประสิทธิภาพภายในสำนักงานและโครงการต่างๆ เรามุ่งมั่นลดผลกระทบต่อสภาพภูมิอากาศด้วยการนำเทคโนโลยีอาคารอัจฉริยะและพลังงานสะอาดมาใช้ในกระบวนการดำเนินงาน ทั้งผู้บริหารและพนักงานทุกระดับให้ความสำคัญกับการปรับปรุงประสิทธิภาพการใช้พลังงานและลดการสูญเสียพลังงานไฟฟ้า ส่งผลให้สามารถลดการใช้ไฟฟ้าจากภายนอกและลดการปล่อยก๊าซคาร์บอนไดออกไซด์ลงอย่างต่อเนื่องในแต่ละปี GIS Group จึงขอแสดงเจตนารมณ์ในการดำเนินธุรกิจอย่างเป็นมิตรต่อสิ่งแวดล้อม คำนึงถึงกฎหมายและมาตรฐานที่เกี่ยวข้อง พร้อมทั้งมุ่งสร้างสรรค์อนาคตที่ยั่งยืนให้กับชุมชนและสิ่งแวดล้อมของเราต่อไป</p>';
                    $policy1->detail_en = $policy1->detail_en ?: '<p><strong style="color: #e46a25;">GIS Group</strong> is an organization that focuses on sustainability and environmental responsibility, especially for efficient energy management within offices and projects. We are committed to minimizing climate impact by implementing smart building technology and clean energy. Executives and employees of all levels focus on improving energy efficiency and reducing electricity consumption, reducing external power consumption and reducing CO2 emissions each year. GIS Group is committed to environmentally friendly business operations in consideration of relevant laws and standards. At the same time, we are committed to building a sustainable future for our communities and the environment.</p>';
                    $policy1->save();
                }
            }
        } catch (\Throwable $e) {
            Log::warning("AboutUsPolicyController ensureColumnsExist: " . $e->getMessage());
        }
    }

    private function cleanDetailHtml($html)
    {
        if (empty($html)) return $html;
        $html = preg_replace('/<\/?font[^>]*>/i', '', $html);
        return $html;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->startd_at && $request->ended_at) {
            if ($request->startd_at > $request->ended_at) {
                Alert::error('ข้อมูลค้นหาไม่ถูกต้อง', 'กรุณาตรวจสอบวันเริ่มต้นและวันสิ้นสุดให้ถูกต้อง');
                return redirect()->back()->withInput();
            }
        }

        $titlePage = "จัดการข้อมูล About Us Policy";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $AboutUsPolicy = AboutUsPolicy::where('active_status', 1);

        if ($request->filled('search')) {
            $search_q = $request->search;
            $AboutUsPolicy = $AboutUsPolicy->where(function ($q) use ($search_q) {
                $q->where('tilte_th', 'LIKE', '%' . $search_q . '%')
                  ->orWhere('tilte_en', 'LIKE', '%' . $search_q . '%')
                  ->orWhere('detail_th', 'LIKE', '%' . $search_q . '%')
                  ->orWhere('detail_en', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->filled('startd_at')) {
            $AboutUsPolicy = $AboutUsPolicy->where('created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->filled('ended_at')) {
            $AboutUsPolicy = $AboutUsPolicy->where('created_at', '<=', $request->ended_at . ' 23:59:59');
        }

        $AboutUsPolicy = $AboutUsPolicy->orderBy('sort_number', 'asc')->paginate(10);
        Log::info("AboutUsPolicyController : index");

        return view('backend.about_policy.index', [
            'AboutUsPolicy' => $AboutUsPolicy,
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
        $data["titlePage"] = "สร้างข้อมูล About Us Policy";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = AboutUsPolicy::where('active_status', 1)->orderBy('sort_number', 'desc')->first();

        $data['sort_number'] = $sort ? ($sort->sort_number + 1) : 1;

        Log::info("AboutUsPolicyController : create");

        return view('backend.about_policy.create', $data);
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
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ], [
            'image1.image' => 'ไฟล์หน้าที่ 1 ต้องเป็นรูปภาพเท่านั้น',
            'image2.image' => 'ไฟล์หน้าที่ 2 ต้องเป็นรูปภาพเท่านั้น',
        ]);

        try {
            DB::beginTransaction();

            $data = new AboutUsPolicy();
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->detail_th = $request->detail_th;
            $data->detail_en = $request->detail_en;
            $data->active_status = 1;
            $data->display_status = 1;
            $data->sort_number = $request->sort_number ?? 1;
            $data->image1 = null;
            $data->image2 = null;
            $data->ip_address = $request->ip();
            $data->created_by = Auth::id() ?? 1;
            $data->updated_by = Auth::id() ?? 1;
            $data->save();

            $storeFolder = 'assets/frontend/img/about_policy/' . $data->id;

            if ($request->hasFile('image1') || $request->hasFile('image2')) {
                if (!File::isDirectory(public_path($storeFolder))) {
                    File::makeDirectory(public_path($storeFolder), 0777, true, true);
                }
                if (!File::isDirectory(base_path($storeFolder))) {
                    File::makeDirectory(base_path($storeFolder), 0777, true, true);
                }
            }

            if ($request->hasFile('image1')) {
                $file1 = $request->file('image1');
                $ext1 = $file1->getClientOriginalExtension() ?: 'jpg';
                $name1 = 'policy1_' . time() . '_' . Str::random(6) . '.' . $ext1;
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
                $name2 = 'policy2_' . time() . '_' . Str::random(6) . '.' . $ext2;
                $dest2 = public_path($storeFolder . '/' . $name2);
                Image::make($file2->getRealPath())->save($dest2, 95);

                if (base_path($storeFolder) !== public_path($storeFolder)) {
                    @copy($dest2, base_path($storeFolder . '/' . $name2));
                }
                $data->image2 = $storeFolder . '/' . $name2;
            }

            $data->save();

            DB::commit();

            Alert::success('สำเร็จ', 'เพิ่มข้อมูล Policy เรียบร้อยแล้ว');
            return redirect()->route('aboutuspolicy.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsPolicyController : store error -> " . $e->getMessage());
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
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูล About Us Policy";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["AboutUsPolicy"] = AboutUsPolicy::findOrFail($id);

        Log::info("AboutUsPolicyController : edit id = " . $id);

        return view('backend.about_policy.edit', $data);
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
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ], [
            'image1.image' => 'ไฟล์หน้าที่ 1 ต้องเป็นรูปภาพเท่านั้น',
            'image2.image' => 'ไฟล์หน้าที่ 2 ต้องเป็นรูปภาพเท่านั้น',
        ]);

        try {
            DB::beginTransaction();

            $data = AboutUsPolicy::findOrFail($id);
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->detail_th = $this->cleanDetailHtml($request->detail_th);
            $data->detail_en = $this->cleanDetailHtml($request->detail_en);
            $data->sort_number = $request->sort_number ?? $data->sort_number;
            $data->active_status = $request->active_status ?? 1;
            $data->display_status = $request->display_status ?? 1;
            $data->ip_address = $request->ip();
            $data->updated_by = Auth::id() ?? 1;

            $storeFolder = 'assets/frontend/img/about_policy/' . $data->id;

            if ($request->hasFile('image1') || $request->hasFile('image2')) {
                if (!File::isDirectory(public_path($storeFolder))) {
                    File::makeDirectory(public_path($storeFolder), 0777, true, true);
                }
                if (!File::isDirectory(base_path($storeFolder))) {
                    File::makeDirectory(base_path($storeFolder), 0777, true, true);
                }
            }

            if ($request->hasFile('image1')) {
                $file1 = $request->file('image1');
                $ext1 = $file1->getClientOriginalExtension() ?: 'jpg';
                $name1 = 'policy1_' . time() . '_' . Str::random(6) . '.' . $ext1;
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
                $name2 = 'policy2_' . time() . '_' . Str::random(6) . '.' . $ext2;
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

            Alert::success('สำเร็จ', 'แก้ไขข้อมูล Policy เรียบร้อยแล้ว');
            return redirect()->route('aboutuspolicy.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsPolicyController : update error -> " . $e->getMessage());
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
            $data = AboutUsPolicy::find($id);
            if ($data) {
                $folder = 'assets/frontend/img/about_policy/' . $id;
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
            Log::error("AboutUsPolicyController : destroy error -> " . $e->getMessage());
            Alert::error('ไม่สำเร็จ', 'เกิดข้อผิดพลาดในการลบข้อมูล');
        }

        return redirect()->route('aboutuspolicy.index');
    }

    public function updateDelete(Request $request)
    {
        try {
            $data = AboutUsPolicy::find($request->id);
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
