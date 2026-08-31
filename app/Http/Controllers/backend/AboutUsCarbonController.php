<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUsCarbon;
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

class AboutUsCarbonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->ensureColumnsExist();
    }

    private function ensureColumnsExist()
    {
        try {
            if (Schema::hasTable('about_carbon') && !Schema::hasColumn('about_carbon', 'tilte_th')) {
                Schema::table('about_carbon', function (Blueprint $table) {
                    if (!Schema::hasColumn('about_carbon', 'tilte_th')) {
                        $table->text('tilte_th')->nullable();
                    }
                    if (!Schema::hasColumn('about_carbon', 'tilte_en')) {
                        $table->text('tilte_en')->nullable();
                    }
                    if (!Schema::hasColumn('about_carbon', 'detail_th')) {
                        $table->longText('detail_th')->nullable();
                    }
                    if (!Schema::hasColumn('about_carbon', 'detail_en')) {
                        $table->longText('detail_en')->nullable();
                    }
                });
            }

            $carbon1 = AboutUsCarbon::first();
            if ($carbon1) {
                if (empty($carbon1->detail_th) || strpos($carbon1->detail_th, '<font') !== false) {
                    $carbon1->tilte_th = $carbon1->tilte_th ?: 'Carbon Footprint';
                    $carbon1->tilte_en = $carbon1->tilte_en ?: 'Carbon Footprint';
                    $carbon1->detail_th = '<div class="policy-badge-banner"><h3>คาร์บอนฟุตพริ้นท์ขององค์กร (CFO)</h3></div><p>คือ การประเมินและคำนวณปริมาณการปล่อยก๊าซเรือนกระจกที่เกิดขึ้นจากกิจกรรมทั้งหมดขององค์กร เพื่อให้รู้แหล่งกำเนิดการปล่อย (Emission Sources) และใช้เป็นฐานข้อมูลสำคัญสำหรับการวางแผนสู่การลดและชดเชยคาร์บอน (Carbon Neutrality / Net Zero)</p><div class="policy-badge-banner mt-4"><h3>คาร์บอนฟุตพริ้นท์ของผลิตภัณฑ์ (CFP)</h3></div><p>คือ การประเมินและคำนวณปริมาณการปล่อยก๊าซเรือนกระจกตลอดวัฏจักรชีวิตของผลิตภัณฑ์ (ตั้งแต่การจัดหาวัตถุดิบ การผลิต การขนส่ง การใช้งาน ไปจนถึงการจัดการหลังหมดอายุการใช้งาน) เพื่อใช้เป็นดัชนีแสดงผลกระทบต่อสิ่งแวดล้อม และเป็นข้อมูลสำหรับการตัดสินใจของผู้บริโภคและคู่ค้า</p><p class="mt-4"><strong style="color: #e46a25;">GIS Group</strong> พร้อมให้บริการ ที่ปรึกษาด้านการจัดทำและขอการรับรองทั้ง CFO และ CFP อย่างครบวงจร ตั้งแต่การเก็บข้อมูล การวิเคราะห์ การจัดทำรายงาน ไปจนถึงการยื่นขอการรับรองกับองค์การบริหารจัดการก๊าซเรือนกระจก (องค์การ TGO)</p>';
                    $carbon1->detail_en = '<div class="policy-badge-banner"><h3>Carbon Footprint of Organization (CFO)</h3></div><p>This refers to the assessment and calculation of greenhouse gas emissions resulting from all organizational activities, in order to identify emission sources and provide essential data for planning towards carbon reduction and compensation (Carbon Neutrality / Net Zero).</p><div class="policy-badge-banner mt-4"><h3>Carbon Footprint of Product (CFP)</h3></div><p>This refers to the assessment and calculation of greenhouse gas emissions throughout the entire life cycle of a product (from raw material sourcing, production, transportation, usage, to end-of-life disposal). It serves as an index to demonstrate environmental impacts and as information for consumer and partner decision-making.</p><p class="mt-4"><strong style="color: #e46a25;">GIS Group</strong>, We provide comprehensive consulting services for both CFO and CFP, covering data collection, analysis, report preparation, and submission for certification with the Thailand Greenhouse Gas Management Organization (TGO).</p>';
                    $carbon1->save();
                }
            }
        } catch (\Throwable $e) {
            Log::warning("AboutUsCarbonController ensureColumnsExist: " . $e->getMessage());
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

        $titlePage = "จัดการข้อมูล About Us Carbon Footprint";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $AboutUsCarbon = AboutUsCarbon::where('active_status', 1);

        if ($request->filled('search')) {
            $search_q = $request->search;
            $AboutUsCarbon = $AboutUsCarbon->where(function ($q) use ($search_q) {
                $q->where('tilte_th', 'LIKE', '%' . $search_q . '%')
                  ->orWhere('tilte_en', 'LIKE', '%' . $search_q . '%')
                  ->orWhere('detail_th', 'LIKE', '%' . $search_q . '%')
                  ->orWhere('detail_en', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->filled('startd_at')) {
            $AboutUsCarbon = $AboutUsCarbon->where('created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->filled('ended_at')) {
            $AboutUsCarbon = $AboutUsCarbon->where('created_at', '<=', $request->ended_at . ' 23:59:59');
        }

        $AboutUsCarbon = $AboutUsCarbon->orderBy('sort_number', 'asc')->paginate(10);
        Log::info("AboutUsCarbonController : index");

        return view('backend.about_carbon.index', [
            'AboutUsCarbon' => $AboutUsCarbon,
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
        $data["titlePage"] = "สร้างข้อมูล About Us Carbon Footprint";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = AboutUsCarbon::where('active_status', 1)->orderBy('sort_number', 'desc')->first();

        $data['sort_number'] = $sort ? ($sort->sort_number + 1) : 1;

        Log::info("AboutUsCarbonController : create");

        return view('backend.about_carbon.create', $data);
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

            $data = new AboutUsCarbon();
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

            $storeFolder = 'assets/frontend/img/about_carbon/' . $data->id;

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
                $name1 = 'carbon1_' . time() . '_' . Str::random(6) . '.' . $ext1;
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
                $name2 = 'carbon2_' . time() . '_' . Str::random(6) . '.' . $ext2;
                $dest2 = public_path($storeFolder . '/' . $name2);
                Image::make($file2->getRealPath())->save($dest2, 95);

                if (base_path($storeFolder) !== public_path($storeFolder)) {
                    @copy($dest2, base_path($storeFolder . '/' . $name2));
                }
                $data->image2 = $storeFolder . '/' . $name2;
            }

            $data->save();

            DB::commit();

            Alert::success('สำเร็จ', 'เพิ่มข้อมูล Carbon Footprint เรียบร้อยแล้ว');
            return redirect()->route('aboutuscarbon.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsCarbonController : store error -> " . $e->getMessage());
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
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูล About Us Carbon Footprint";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["AboutUsCarbon"] = AboutUsCarbon::findOrFail($id);

        Log::info("AboutUsCarbonController : edit id = " . $id);

        return view('backend.about_carbon.edit', $data);
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

            $data = AboutUsCarbon::findOrFail($id);
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->detail_th = $this->cleanDetailHtml($request->detail_th);
            $data->detail_en = $this->cleanDetailHtml($request->detail_en);
            $data->sort_number = $request->sort_number ?? $data->sort_number;
            $data->active_status = $request->active_status ?? 1;
            $data->display_status = $request->display_status ?? 1;
            $data->ip_address = $request->ip();
            $data->updated_by = Auth::id() ?? 1;

            $storeFolder = 'assets/frontend/img/about_carbon/' . $data->id;

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
                $name1 = 'carbon1_' . time() . '_' . Str::random(6) . '.' . $ext1;
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
                $name2 = 'carbon2_' . time() . '_' . Str::random(6) . '.' . $ext2;
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

            Alert::success('สำเร็จ', 'แก้ไขข้อมูล Carbon Footprint เรียบร้อยแล้ว');
            return redirect()->route('aboutuscarbon.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("AboutUsCarbonController : update error -> " . $e->getMessage());
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
            $data = AboutUsCarbon::find($id);
            if ($data) {
                $folder = 'assets/frontend/img/about_carbon/' . $id;
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
            Log::error("AboutUsCarbonController : destroy error -> " . $e->getMessage());
            Alert::error('ไม่สำเร็จ', 'เกิดข้อผิดพลาดในการลบข้อมูล');
        }

        return redirect()->route('aboutuscarbon.index');
    }

    public function updateDelete(Request $request)
    {
        try {
            $data = AboutUsCarbon::find($request->id);
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
