@extends('layouts.backend.sidenav-backend')
@section('css')
<style>
    .note-dropdown-menu.dropdown-menu.note-check.dropdown-fontname.show {
        overflow: scroll;
        height: 200px;
    }

</style>
@endsection

@section('content')
<!-- Form Element sizes -->
class="card cardboby card-primary"
<div class="card-header">
    <h3 class="card-title">
        <i class="fas fa-edit"></i>
        {{ $titlePage }}
    </h3>
</div>
<div class="card-body">

    <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('user.update', [$User->id]) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        {{ Form::hidden('id', $User->id, ['class' => 'form-control']) }}
        <div class="form-group row">
            <div class="col-sm-12 col-md-6">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">ชื่อ-นามสกุล<span class="text-danger">*</span></label>
                <div class="col-sm-12 col-md-12">
                    <input type="text" value="{{ $User->fullname }}" class="form-control @error('fullname') is-validated is-invalid @enderror " name="fullname" placeholder="กรอกชื่อ-นามสกุล" autocomplete="off">
                    @error('fullname')<div class="invalid-feedback">{{ trans('message.fullname') }}</div>@enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">Email</label>
                <div class="col-sm-12 col-md-12">
                    {{ Form::email('email', $User->email, ['class' => 'form-control ', 'placeholder' => 'กรอกEmail', 'autocomplete' => 'off']) }}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 col-md-12">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">ชื่อผู้ใช้งาน<span class="text-danger">* (สำหรับเข้าสู่ระบบ)</span></label>
                <div class="col-sm-12 col-md-12">
                    <input type="text" value="{{ $User->username }}" class="form-control @error('username') is-validated is-invalid @enderror " name="username" placeholder="กรอกชื่อผู้ใช้งาน (Username)" autocomplete="off">
                    @error('username')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="custom-control custom-checkbox mb-3">
                    <input class="custom-control-input" id="change_password" type="checkbox" name="change_password">
                    <label class="custom-control-label" for="change_password">Change Password</label>
                </div>
            </div>

        </div>
        <div class="form-group row">
            <div class="col-sm-12 col-md-6">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รหัสผ่าน<span class="text-danger">*</span></label>
                <div class="col-sm-12 col-md-12">
                    <input type="password" class="form-control password-icon @error('password') is-validated is-invalid @enderror" id="password" name="password" placeholder="รหัสผ่าน">
                    @error('password')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">ยืนยันรหัสผ่าน<span class="text-danger">*</span></label>
                <div class="col-sm-12 col-md-12">
                    <input type="password" class="form-control password-icon @error('password_confirmation') is-validated is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="ยืนยันรหัสผ่าน" autocomplete="off">
                    @error('password_confirmation')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group text-center ">
            <a class="btn btn-outline-danger" role="button" href="{{ route('user.index') }}">ยกเลิก</a>
            <input class="btn btn-outline-primary" type="submit" value="ยืนยันข้อมูล"></button>
        </div>
    </form>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

@endsection


@section('javascript')
<!-- รูปภาพ -->
<script>
    $('#password').attr('disabled',!this.checked)
    $('#password_confirmation').attr('disabled',!this.checked)


    $('#change_password').change(function() {
        $('#password').attr('disabled',!this.checked)
        $('#password_confirmation').attr('disabled',!this.checked)
    });
</script>

@endsection
