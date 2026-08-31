<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ThaiDateHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
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

        $titlePage = "จัดการข้อมูลบัญชีผู้ใช้งาน Backend";
        $DataTimeThaiFull = ThaiDateHelperService::DataTimeThaiFull();
        $User = User::where('users.active_status', 1);
        // start search
        if (isset($request->search)) {
            $search_q = $request->search;
            $User = $User->where(function ($q) use ($search_q) {
                $q->Where('users.fullname', 'LIKE', '%' . $search_q . '%');
                $q->orWhere('users.username', 'LIKE', '%' . $search_q . '%');
                $q->orWhere('users.email', 'LIKE', '%' . $search_q . '%');
            });
        }

        if ($request->startd_at) {
            $User = $User->where('users.created_at', '>=', $request->startd_at . ' 00:00:00');
        }
        if ($request->ended_at) {
            $User = $User->where('users.created_at', '<=', $request->ended_at . ' 23:59:59');
        }
        // end search

        $User = $User->where('users.active_status', 1)->orderby('id', 'desc')->paginate(10);
        Log::info("UserController : index");
        return view('backend.users.index', [
            'User' => $User,
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
        $data["titlePage"] = "สร้างข้อมูลบัญชีผู้ใช้งาน Backend";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();

        Log::info("UserController : create");
        Log::info($data);

        return view('backend.users.create', $data);
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
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|same:password|min:8',
        ]);

        try {
            DB::beginTransaction();

            $data = new User();
            $data->fullname = $request->fullname;
            $data->username = $request->username;
            $data->email  = $request->email;
            $data->password = Hash::make($request->password);
            $data->is_code = 'Super Admin';
            $data->active_status = '1';
            $data->is_admin = '1';
            $data->is_deleted = "0";
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }


            Log::info("UserController : store");
            Log::info($request);

            DB::commit();

            return redirect()->route('user.index');
        } catch (\PDOException $e) {
            Log::info("UserController : store");
            Log::error($e);

            DB::rollBack();

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
        $data["titlePage"] = "แสดงรายละเอียดข้อมูลบัญชีผู้ใช้งาน Backend";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["User"] = User::find($id);

        Log::info("UserController : show id = " . $id);
        Log::info($data);

        return view('backend.users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["titlePage"] = "เปลี่ยนแปลงข้อมูลบัญชีผู้ใช้งาน Backend";
        $data["DataTimeThaiFull"] = ThaiDateHelperService::DataTimeThaiFull();
        $data["User"] = User::find($id);

        Log::info("UserController : edit id = " . $id);
        Log::info($data);

        return view('backend.users.edit', $data);
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
        // $request->validate([
        //     'username' => 'required|string|max:255',
        // ]);
        try {
            DB::beginTransaction();

            $data = User::find($id);;
            $data->fullname = $request->fullname;
            $data->username = $request->username;
            $data->email  = $request->email;
            if ($data->username === $request->username) {

                $data->username = $request->username;
            } else {
                $request->validate([
                    'username' => 'required|string|max:255|unique:users',
                ]);
                $data->username = $data->username;
            }

            if ($request->change_password == 'on') {
                $request->validate([
                    'password' => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
                    'password_confirmation' => 'required|same:password|min:8',
                ]);
                $data->password = Hash::make($request->password);
            } else {
                $data->password = $data->password;
            }
            $data->is_code = $data->is_code;
            $data->is_admin = $data->is_admin;
            $data->is_deleted = $data->is_deleted;
            $data->active_status = $data->active_status;
            $data->created_by = $data->created_by;
            $data->updated_by = Auth::user()->id;

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }


            Log::info("UserController : update id = " . $id);
            Log::info($request);

            DB::commit();

            return redirect()->route('user.index');
        } catch (\PDOException $e) {
            Log::info("UserController : update id = " . $id);
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

            $data = User::find($request->id);
            $data->active_status = "0";
            $data->is_admin = "0";
            $data->is_deleted = "1";
            $data->deleted_at = Carbon::now();

            if ($data->save()) {
                Alert::success('สำเร็จ', 'คุณทำรายการที่ต้องการสำเร็จเรียบร้อย');
            }


            Log::info("UserController : updateDelete");
            Log::info($request);

            DB::commit();

            return response(200);
        } catch (\PDOException $e) {
            Log::info("UserController : updateDelete");
            Log::error($e);

            DB::rollBack();

            Alert::error('ไม่สำเร็จ', 'คุณทำรายการที่ต้องการไม่สำเร็จกรุณาทำรายการใหม่');
            return response(300);
        }
    }
}
