<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ProductServicesDetail;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Image;
use Illuminate\Support\Str;

class ProductServicesDetailController extends Controller
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

        $titlePage = "จัดการข้อมูล Product & Services หน้า Detail";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $ProductServicesDetail = ProductServicesDetail::where('product_services_detail.active_status', 1);
        // start search
        if (isset($request->search)) {
            $search_q = $request->search;
            $ProductServicesDetail = $ProductServicesDetail->where(function ($q) use ($search_q) {
                $q->Where('product_services_detail.tilte_th', 'LIKE', '%' . $search_q . '%');
                $q->orWhere('product_services_detail.tilte_en', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->startd_at) {
            $ProductServicesDetail = $ProductServicesDetail->where('product_services_detail.created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->ended_at) {
            $ProductServicesDetail = $ProductServicesDetail->where('product_services_detail.created_at', '<=', $request->ended_at . ' 23:59:59');
        }
        // end search

        $ProductServicesDetail = $ProductServicesDetail->where('product_services_detail.active_status', 1)->orderby('sort_number', 'desc')->paginate(10);
        Log::info("ProductServicesDetailController : index");
        return view('backend.product_services_detail.index', [
            'ProductServicesDetail' => $ProductServicesDetail,
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
        $data["titlePage"] = "สร้างข้อมูล Product & Services หน้า Detail";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = ProductServicesDetail::where('product_services_detail.active_status', 1)->where('product_services_detail.display_status', 1)->orderby('sort_number', 'desc')->first();

        if ($sort) {
            $data['sort_number'] = $sort->sort_number + 1;
        } else {
            $data['sort_number'] = 1;
        }

        Log::info("ProductServicesDetailController : create");
        Log::info($data);

        return view('backend.product_services_detail.create', $data);
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

            $data = new ProductServicesDetail();
            $data->product_services_type_id = $request->product_services_type_id;
            $data->page = '2';
            $data->tilte_th = '';
            $data->tilte_en =  '';
            $data->detail_th = $request->detail_th;
            $data->detail_en = $request->detail_en;
            $data->active_status = '1';
            $data->display_status = '1';
            $data->image_1 = '';
            $data->image_2 = '';
            $data->sort_number = $request->sort_number;
            $data->ip_address = $request->ip();
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }
            $random = Str::random(20);
            $random2 = Str::random(20);
            $random3 = Str::random(20);
            $random4 = Str::random(20);

            $image_1 = ProductServicesDetail::find($data->id);
            if ($request->image_1 == null) {
                $image_1->image_1 =  'assets/backend/images/error/nopic.jpg';
            } else {
                $storeFolder = 'assets/frontend/img/product_services_detail/' . $data->id . '/image_1'; //2
                if ($request->hasFile('image_1')) {
                    $newFileName = $random . '.' . $request->image_1->extension();
                    // $newFileName = $request->image_1->getClientOriginalName();
                    $image_1->image_1 = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    // $request->image_1->move(public_path($storeFolder), $newFileName);
                    $RealPath = 'assets/../assets/frontend/img/product_services_detail/' . $data->id . '/image_1';
                    Image::make($request->image_1->getRealPath())->save($RealPath . '/' . $newFileName);
                }
            }
            $image_1->save();

            $image_2 = ProductServicesDetail::find($data->id);
            if ($request->image_2 == null) {
                $image_2->image_2 =  'assets/backend/images/error/nopic.jpg';
            } else {
                $storeFolder = 'assets/frontend/img/product_services_detail/' . $data->id . '/image_2'; //2
                if ($request->hasFile('image_2')) {
                    $newFileName = $random2 . '.' . $request->image_2->extension();

                    // $newFileName = $request->image_2->getClientOriginalName();
                    $image_2->image_2 = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    // $request->image_2->move(public_path($storeFolder), $newFileName);
                    $RealPath = 'assets/../assets/frontend/img/product_services_detail/' . $data->id . '/image_2';
                    Image::make($request->image_2->getRealPath())->save($RealPath . '/' . $newFileName);
                }
            }
            $image_2->save();

            $image_3 = ProductServicesDetail::find($data->id);
            if ($request->image_3 == null) {
                $image_3->image_3 =  'assets/backend/images/error/nopic.jpg';
            } else {
                $storeFolder = 'assets/frontend/img/product_services_detail/' . $data->id . '/image_3'; //2
                if ($request->hasFile('image_3')) {
                    $newFileName = $random3 . '.' . $request->image_3->extension();

                    // $newFileName = $request->image_3->getClientOriginalName();
                    $image_3->image_3 = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    $RealPath = 'assets/../assets/frontend/img/product_services_detail/' . $data->id . '/image_3';
                    Image::make($request->image_3->getRealPath())->save($RealPath . '/' . $newFileName);
                }
            }
            $image_3->save();

            $image_4 = ProductServicesDetail::find($data->id);
            if ($request->image_4 == null) {
                $image_4->image_4 =  'assets/backend/images/error/nopic.jpg';
            } else {
                $storeFolder = 'assets/frontend/img/product_services_detail/' . $data->id . '/image_4'; //2
                if ($request->hasFile('image_4')) {
                    // $newFileName = $request->image_4->getClientOriginalName();
                    $newFileName = $random4 . '.' . $request->image_4->extension();

                    $image_4->image_4 = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    $RealPath = 'assets/../assets/frontend/img/product_services_detail/' . $data->id . '/image_4';
                    Image::make($request->image_4->getRealPath())->save($RealPath . '/' . $newFileName);
                }
            }
            $image_4->save();

            Log::info("ProductServicesDetailController : store");
            Log::info($request);

            DB::commit();

            return redirect()->route('productservicesdetail.index');
        } catch (\PDOException $e) {
            Log::info("ProductServicesDetailController : store");
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
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูล Product & Services หน้า Detail";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["ProductServicesDetail"] = ProductServicesDetail::find($id);
        Log::info("ProductServicesDetailController : edit id = " . $id);
        Log::info($data);

        return view('backend.product_services_detail.edit', $data);
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

            $data = ProductServicesDetail::find($id);;
            $data->product_services_type_id = $request->product_services_type_id;
            $data->page = '2';
            $data->tilte_th = '';
            $data->tilte_en =  '';
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

            $random = Str::random(20);
            $random2 = Str::random(20);
            $random3 = Str::random(20);
            $random4 = Str::random(20);

            $image_1 = ProductServicesDetail::find($data->id);
            if ($request->image_1 == null) {
                if ($request->image_1Old == null) {
                    $image_1->image_1 = 'assets/backend/images/error/nopic.jpg';
                } else {
                    $image_1->image_1 =  $request->image_1Old;
                }
            } else {
                $storeFolder = 'assets/frontend/img/product_services_detail/' . $data->id . '/image_1'; //2
                if ($request->hasFile('image_1')) {

                    $newFileName = $random . '.' . $request->image_1->extension();
                    // $newFileName = $request->image_1->getClientOriginalName();
                    $image_1->image_1 = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    // $request->image_1->move(public_path($storeFolder), $newFileName);
                    $RealPath = 'assets/../assets/frontend/img/product_services_detail/' . $data->id . '/image_1';
                    Image::make($request->image_1->getRealPath())->save($RealPath . '/' . $newFileName);
                }
            }
            $image_1->save();

            $image_2 = ProductServicesDetail::find($data->id);
            if ($request->image_2 == null) {
                if ($request->image_2Old == null) {
                    $image_2->image_2 = 'assets/backend/images/error/nopic.jpg';
                } else {
                    $image_2->image_2 =  $request->image_2Old;
                }
            } else {
                $storeFolder = 'assets/frontend/img/product_services_detail/' . $data->id . '/image_2'; //2
                if ($request->hasFile('image_2')) {
                    $newFileName = $random2 . '.' . $request->image_2->extension();
                    // $newFileName = $request->image_2->getClientOriginalName();
                    $image_2->image_2 = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    // $request->image_2->move(public_path($storeFolder), $newFileName);
                    $RealPath = 'assets/../assets/frontend/img/product_services_detail/' . $data->id . '/image_2';
                    Image::make($request->image_2->getRealPath())->save($RealPath . '/' . $newFileName);
                }
            }
            $image_2->save();

            $image_3 = ProductServicesDetail::find($data->id);
            if ($request->image_3 == null) {
                if ($request->image_3Old == null) {
                    $image_3->image_3 = 'assets/backend/images/error/nopic.jpg';
                } else {
                    $image_3->image_3 =  $request->image_3Old;
                }
            } else {
                $storeFolder = 'assets/frontend/img/product_services_detail/' . $data->id . '/image_3'; //2
                if ($request->hasFile('image_3')) {
                    $newFileName = $random2 . '.' . $request->image_3->extension();
                    // $newFileName = $request->image_3->getClientOriginalName();
                    $image_3->image_3 = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    // $request->image_3->move(public_path($storeFolder), $newFileName);
                    $RealPath = 'assets/../assets/frontend/img/product_services_detail/' . $data->id . '/image_3';
                    Image::make($request->image_3->getRealPath())->save($RealPath . '/' . $newFileName);
                }
            }
            $image_3->save();

            $image_4 = ProductServicesDetail::find($data->id);
            if ($request->image_4 == null) {
                if ($request->image_4Old == null) {
                    $image_4->image_4 = 'assets/backend/images/error/nopic.jpg';
                } else {
                    $image_4->image_4 =  $request->image_4Old;
                }
            } else {
                $storeFolder = 'assets/frontend/img/product_services_detail/' . $data->id . '/image_4'; //2
                if ($request->hasFile('image_4')) {
                    $newFileName = $random2 . '.' . $request->image_4->extension();
                    // $newFileName = $request->image_4->getClientOriginalName();
                    $image_4->image_4 = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    // $request->image_4->move(public_path($storeFolder), $newFileName);
                    $RealPath = 'assets/../assets/frontend/img/product_services_detail/' . $data->id . '/image_4';
                    Image::make($request->image_4->getRealPath())->save($RealPath . '/' . $newFileName);
                }
            }
            $image_4->save();

            Log::info("ProductServicesDetailController : update id = " . $id);
            Log::info($request);

            DB::commit();

            return redirect()->route('productservicesdetail.index');
        } catch (\PDOException $e) {
            Log::info("ProductServicesDetailController : update id = " . $id);
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

            $data = ProductServicesDetail::find($request->id);
            $data->active_status = '0';
            $data->display_status = '2';
            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            Log::info("ProductServicesDetailController : updateDelete");
            Log::info($request);

            DB::commit();

            return response(200);
        } catch (\PDOException $e) {
            Log::info("ProductServicesDetailController : updateDelete");
            Log::error($e);

            DB::rollBack();

            Alert::error('ไม่สำเร็จ', 'คุณทำรายการที่ต้องการไม่สำเร็จกรุณาทำรายการใหม่');
            return response(300);
        }
    }
}
