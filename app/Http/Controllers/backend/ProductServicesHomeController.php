<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ProductServicesHome;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class ProductServicesHomeController extends Controller
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

        $titlePage = "จัดการข้อมูล Product & Services หน้า Home";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $ProductServicesHome = ProductServicesHome::where('product_services_home.active_status', 1);
        // start search
        if (isset($request->search)) {
            $search_q = $request->search;
            $ProductServicesHome = $ProductServicesHome->where(function ($q) use ($search_q) {
                $q->Where('product_services_home.tilte_th', 'LIKE', '%' . $search_q . '%');
                $q->orWhere('product_services_home.tilte_en', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->startd_at) {
            $ProductServicesHome = $ProductServicesHome->where('product_services_home.created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->ended_at) {
            $ProductServicesHome = $ProductServicesHome->where('product_services_home.created_at', '<=', $request->ended_at . ' 23:59:59');
        }
        // end search

        $ProductServicesHome = $ProductServicesHome->where('product_services_home.active_status', 1)->orderby('sort_number', 'desc')->paginate(10);
        Log::info("ProductServicesHomeController : index");
        return view('backend.product_services_home.index', [
            'ProductServicesHome' => $ProductServicesHome,
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
        $data["titlePage"] = "สร้างข้อมูล Product & Services หน้า Home";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = ProductServicesHome::where('product_services_home.active_status', 1)->where('product_services_home.display_status', 1)->orderby('sort_number', 'desc')->first();

        if ($sort) {
            $data['sort_number'] = $sort->sort_number + 1;
        } else {
            $data['sort_number'] = 1;
        }

        Log::info("ProductServicesHomeController : create");
        Log::info($data);

        return view('backend.product_services_home.create', $data);
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

            $data = new ProductServicesHome();
            $data->product_services_type_id = '';
            $data->page = '1';
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->detail_th = $request->detail_th;
            $data->detail_en = $request->detail_en;
            $data->active_status = '1';
            $data->display_status = '1';
            $data->sort_number = $request->sort_number;
            $data->ip_address = $request->ip();
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }



            Log::info("ProductServicesHomeController : store");
            Log::info($request);

            DB::commit();

            return redirect()->route('productserviceshome.index');
        } catch (\PDOException $e) {
            Log::info("ProductServicesHomeController : store");
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
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูล Product & Services หน้า Home";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["ProductServicesHome"] = ProductServicesHome::find($id);
        Log::info("ProductServicesHomeController : edit id = " . $id);
        Log::info($data);

        return view('backend.product_services_home.edit', $data);
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

            $data = ProductServicesHome::find($id);;
            $data->product_services_type_id = '';
            $data->page = '1';
            $data->tilte_th = $request->tilte_th;
            $data->tilte_en = $request->tilte_en;
            $data->detail_th = $request->detail_th;
            $data->detail_en = $request->detail_en;
            $data->active_status = '1';
            $data->display_status = '1';
            $data->ip_address = $request->ip();
            $data->active_status = $request->active_status;
            $data->display_status = $request->display_status;
            $data->sort_number = $request->sort_number;
            $data->created_by = $request->created_by;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            Log::info("ProductServicesHomeController : update id = " . $id);
            Log::info($request);

            DB::commit();

            return redirect()->route('productserviceshome.index');
        } catch (\PDOException $e) {
            Log::info("ProductServicesHomeController : update id = " . $id);
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

            $data = ProductServicesHome::find($request->id);
            $data->active_status = '0';
            $data->display_status = '2';
            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            Log::info("ProductServicesHomeController : updateDelete");
            Log::info($request);

            DB::commit();

            return response(200);
        } catch (\PDOException $e) {
            Log::info("ProductServicesHomeController : updateDelete");
            Log::error($e);

            DB::rollBack();

            Alert::error('ไม่สำเร็จ', 'คุณทำรายการที่ต้องการไม่สำเร็จกรุณาทำรายการใหม่');
            return response(300);
        }
    }
}
