@extends('layouts.backend.sidenav-backend')
@section('css')
<style>

</style>
@endsection

@section('content')
<!-- Form Element sizes -->
class="card cardboby card-primary"
<div class="card-header">
    <h3 class="card-title">
        <i class="fas fa-edit"></i>
        {{ $titlePage ?? 'ไม่ระบุ'  }}
    </h3>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th width="100%">{{ $titlePage ?? 'ไม่ระบุ'  }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-left" scope="col" width="100%">ชื่อ-นามสกุล : <b>{{ $User->fullname ?? 'ไม่ระบุ'  }}</b></td>
                </tr>
                <tr>
                    <td class="text-left" scope="col" width="100%">ชื่อผู้ใช้งานสำหรับเข้าสู่ระบบ : <b>{{ $User->username ?? 'ไม่ระบุ'  }}</b></td>
                </tr>
                <tr>
                    <td class="text-left" scope="col" width="100%">Email : <b>{{ $User->email ?? 'ไม่ระบุ'  }}</b></td>
                </tr>
                <tr>
                    <td class="text-left" scope="col" width="100%">สถานะการใช้งาน : <b>{{ $User->WithStatus->status_th ?? 'ไม่ระบุ'  }}</b></td>
                </tr>
                <tr>
                    <td class="text-left" scope="col" width="100%">สถานะการแสดง : <b>{{ $User->WithDisplay->display_th ?? 'ไม่ระบุ'  }}</b></td>
                </tr>
                <tr>
                    <td class="text-left" scope="col" width="100%">ผู้เพิ่มข้อมูล : <b>{{ $User->usersCreatedBy->fullname ?? 'ไม่ระบุ'  }}</b></td>
                </tr>
                <tr>
                    <td class="text-left" scope="col" width="100%">วันที่เพิ่มข้อมูล : <b>{{ $User->created_at ?? 'ไม่ระบุ'  }}</b></td>
                </tr>
                <tr>
                    <td class="text-left" scope="col" width="100%">ผู้แก้ไขข้อมูล : <b>{{ $User->usersUpdatedBy->fullname ?? 'ไม่ระบุ'  }}</b></td>
                </tr>
                <tr>
                    <td class="text-left" scope="col" width="100%">วันที่แก้ไขข้อมูล : <b>{{ $User->updated_at ?? 'ไม่ระบุ'  }}</b></td>
                </tr>
            </tbody>
        </table>
        <br>
    </div>
    <hr>
    <div class="form-group text-center ">
        <a class="btn btn-outline-danger" role="button" href="{{ route('user.index')  }}">ย้อนกลับ</a>
        <a class="btn btn-outline-warning" role="button" href="{{ route('user.edit', [$User->id])  }}">แก้ไข</a>
    </div>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

@endsection


@section('javascript')
<script>
    $('.inSummernote').summernote('disable');
</script>
@endsection
