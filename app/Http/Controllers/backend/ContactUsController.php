<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class ContactUsController extends Controller
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

        $titlePage = "จัดการข้อมูล Contact US หน้า Home";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $Contact = Contact::where('contact.active_status', 1);

        if ($request->startd_at) {
            $Contact = $Contact->where('contact.created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->ended_at) {
            $Contact = $Contact->where('contact.created_at', '<=', $request->ended_at . ' 23:59:59');
        }
        // end search

        $Contact = $Contact->where('contact.active_status', 1)->orderby('sort_number', 'desc')->paginate(10);
        Log::info("ContactUsController : index");
        return view('backend.contactus.index', [
            'Contact' => $Contact,
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
        $data["titlePage"] = "สร้างข้อมูล Contact US หน้า Home";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $sort = Contact::where('contact.active_status', 1)->where('contact.display_status', 1)->orderby('sort_number', 'desc')->first();

        if ($sort) {
            $data['sort_number'] = $sort->sort_number + 1;
        } else {
            $data['sort_number'] = 1;
        }

        Log::info("ContactUsController : create");
        Log::info($data);

        return view('backend.contactus.create', $data);
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

            $data = new Contact();
            $data->active_status = '1';
            $data->display_status = '1';
            $data->sort_number = $request->sort_number;
            $data->ip_address = $request->ip();
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            $image_main = Contact::find($data->id);
            if ($request->image_main == null) {
                $image_main->image_main =  'assets/backend/images/error/nopic.jpg';
            } else {
                $storeFolder = 'assets/frontend/img/contact/' . $data->id; //2
                if ($request->hasFile('image_main')) {
                    $newFileName = $request->image_main->getClientOriginalName();
                    $image_main->image_main = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    // $request->image_main->move(public_path($storeFolder), $newFileName);
                    $RealPath = 'assets/../assets/frontend/img/contact/' . $data->id;
                    Image::make($request->image_main->getRealPath())->save($RealPath . '/' . $newFileName);
                }
                // if ($request->hasFile('image_main')) {
                //     $fileName = $request->image_main->getClientOriginalName();
                //     $image_main->image_main = $storeFolder . '/' . $fileName;
                //     if (!is_dir($storeFolder)) {
                //         mkdir($storeFolder, 0777, true);
                //         $fileName = $fileName;
                //     }
                //     $RealPath = 'public_html/../image_main/contact/' . $data->id;
                //     Image::make($request->image_main->getRealPath())->save($RealPath . '/' . $fileName);
                // }
            }
            $image_main->save();
            Log::info("ContactUsController : store");
            Log::info($request);

            DB::commit();

            return redirect()->route('contactus.index');
        } catch (\PDOException $e) {
            Log::info("ContactUsController : store");
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
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูล Contact US หน้า Home";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["Contact"] = Contact::find($id);
        Log::info("ContactUsController : edit id = " . $id);
        Log::info($data);

        return view('backend.contactus.edit', $data);
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

            $data = Contact::find($id);;
            $data->ip_address = $request->ip();
            $data->active_status = $request->active_status;
            $data->display_status = $request->display_status;
            $data->sort_number = $request->sort_number;
            $data->created_by = $request->created_by;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            $image_main = Contact::find($data->id);
            if ($request->image_main == null) {
                if ($request->image_mainOld == null) {
                    $image_main->image_main = 'assets/backend/images/error/nopic.jpg';
                } else {
                    $image_main->image_main =  $request->image_mainOld;
                }
            } else {
                $storeFolder = 'assets/frontend/img/contact/' . $data->id; //2
                if ($request->hasFile('image_main')) {
                    $newFileName = $request->image_main->getClientOriginalName();
                    $image_main->image_main = $storeFolder . '/' . $newFileName;
                    if (!is_dir($storeFolder)) {
                        mkdir($storeFolder, 0777, true);
                    }
                    // $request->image_main->move(public_path($storeFolder), $newFileName);
                    $RealPath = 'assets/../assets/frontend/img/contact/' . $data->id;
                    Image::make($request->image_main->getRealPath())->save($RealPath . '/' . $newFileName);
                }
                // if ($request->hasFile('image_main')) {
                //     $fileName = $request->image_main->getClientOriginalName();
                //     $image_main->image_main = $storeFolder . '/' . $fileName;
                //     if (!is_dir($storeFolder)) {
                //         mkdir($storeFolder, 0777, true);
                //         $fileName = $fileName;
                //     }
                //     $RealPath = 'public_html/../image_main/contact/' . $data->id;
                //     Image::make($request->image_main->getRealPath())->save($RealPath . '/' . $fileName);
                // }
            }
            $image_main->save();
            Log::info("ContactUsController : update id = " . $id);
            Log::info($request);

            DB::commit();

            return redirect()->route('contactus.index');
        } catch (\PDOException $e) {
            Log::info("ContactUsController : update id = " . $id);
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

            $data = Contact::find($request->id);
            $data->active_status = '0';
            $data->display_status = '2';
            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }

            Log::info("ContactUsController : updateDelete");
            Log::info($request);

            DB::commit();

            return response(200);
        } catch (\PDOException $e) {
            Log::info("ContactUsController : updateDelete");
            Log::error($e);

            DB::rollBack();

            Alert::error('ไม่สำเร็จ', 'คุณทำรายการที่ต้องการไม่สำเร็จกรุณาทำรายการใหม่');
            return response(300);
        }
    }
}
