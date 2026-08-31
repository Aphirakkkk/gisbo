<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
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

        $titlePage = "จัดการข้อมูลติดต่อกลับผู้สอบถามข้อมูล";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $ContactUs = ContactUs::orderby('contact_us.id', 'desc');
        // start search
        if (isset($request->search)) {
            $search_q = $request->search;
            $ContactUs = $ContactUs->where(function ($q) use ($search_q) {
                $q->Where('contact_us.full_name', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->startd_at) {
            $ContactUs = $ContactUs->where('contact_us.created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->ended_at) {
            $ContactUs = $ContactUs->where('contact_us.created_at', '<=', $request->ended_at . ' 23:59:59');
        }
        // end search

        $ContactUs = $ContactUs->paginate(10);

        Log::info("ContactController : index");
        return view('backend.contact.index', [
            'ContactUs' => $ContactUs,
            'titlePage' => $titlePage,
            'DataTimeThaiFull' => $DataTimeThaiFull,
        ]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data["titlePage"] = "แสดงรายละเอียดข้อมูลติดต่อกลับผู้สอบถามข้อมูล";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["ContactUs"] = ContactUs::find($id);
        Log::info("ContactController : show id = " . $id);
        Log::info($data);

        return view('backend.contact.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

            $data = ContactUs::find($id);;
            $data->full_name = $data->full_name;
            $data->email = $data->email;
            $data->telephone = $data->telephone;
            $data->topic = $data->topic;
            $data->details = $data->details;
            $data->active_status = '6';
            $data->display_status = $data->display_status;
            $data->sort_number = $data->sort_number;
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            Log::info("ContactController : update id = " . $id);
            Log::info($request);

            DB::commit();

            return redirect()->route('contact.index');
        } catch (\PDOException $e) {
            Log::info("ContactController : update id = " . $id);
            Log::error($e);

            DB::rollBack();

            Alert::error('ไม่สำเร็จ', 'คุณทำรายการที่ต้องการไม่สำเร็จกรุณาทำรายการใหม่');
            return redirect()->back()->withInput();
        }
    }
}
