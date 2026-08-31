<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
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

        $titlePage = "จัดการข้อมูลเมนูหลัก";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $Menu = Menu::where('menu.active_status', 1);
        // start search
        if (isset($request->search)) {
            $search_q = $request->search;
            $Menu = $Menu->where(function ($q) use ($search_q) {
                $q->Where('menu.tilte_th', 'LIKE', '%' . $search_q . '%');
                $q->orWhere('menu.tilte_en', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->startd_at) {
            $Menu = $Menu->where('menu.created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->ended_at) {
            $Menu = $Menu->where('menu.created_at', '<=', $request->ended_at . ' 23:59:59');
        }
        // end search

        $Menu = $Menu->where('menu.active_status', 1)->orderby('sort_number', 'asc')->get();
        Log::info("MenuController : index");
        return view('backend.menu.index', [
            'Menu' => $Menu,
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
        $data["titlePage"] = "สร้างข้อมูลเมนูหลัก";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = Menu::where('menu.active_status', 1)->where('menu.display_status', 1)->orderby('sort_number', 'desc')->first();

        if ($sort) {
            $data['sort_number'] = $sort->sort_number + 1;
        } else {
            $data['sort_number'] = 1;
        }

        Log::info("MenuController : create");
        Log::info($data);

        return view('backend.menu.create', $data);
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

            $data = new Menu();
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

            Log::info("MenuController : store");
            Log::info($request);

            DB::commit();

            return redirect()->route('menu.index');
        } catch (\PDOException $e) {
            Log::info("MenuController : store");
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
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูลเมนูหลัก";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["Menu"] = Menu::find($id);
        Log::info("MenuController : edit id = " . $id);
        Log::info($data);

        return view('backend.menu.edit', $data);
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

            $data = Menu::find($id);;
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

            Log::info("MenuController : update id = " . $id);
            Log::info($request);

            DB::commit();

            return redirect()->route('menu.index');
        } catch (\PDOException $e) {
            Log::info("MenuController : update id = " . $id);
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

            $data = Menu::find($request->id);
            $data->active_status = '0';
            $data->display_status = '2';
            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            Log::info("MenuController : updateDelete");
            Log::info($request);

            DB::commit();

            return response(200);
        } catch (\PDOException $e) {
            Log::info("MenuController : updateDelete");
            Log::error($e);

            DB::rollBack();

            Alert::error('ไม่สำเร็จ', 'คุณทำรายการที่ต้องการไม่สำเร็จกรุณาทำรายการใหม่');
            return response(300);
        }
    }
}
