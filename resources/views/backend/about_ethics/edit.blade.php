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
<div class="card cardboby card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-edit mr-2"></i>{{ $titlePage }}
        </h3>
    </div>
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('aboutusethics.update', $AboutUsEthics->id) }}">
            @csrf
            @method('PATCH')

            <input type="hidden" name="active_status" value="{{ $AboutUsEthics->active_status }}">
            <input type="hidden" name="display_status" value="{{ $AboutUsEthics->display_status }}">

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">ลำดับการแสดงผล</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" name="sort_number" value="{{ $AboutUsEthics->sort_number }}" min="1">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">หัวข้อ Ethics ภาษาไทย <span class="text-danger">*</span></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="tilte_th" value="{{ $AboutUsEthics->tilte_th }}" placeholder="กรอกหัวข้อ Ethics ภาษาไทย" required autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">รายละเอียด Ethics ภาษาไทย</label>
                <div class="col-sm-12">
                    <textarea name="detail_th" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Ethics ภาษาไทย">{{ $AboutUsEthics->detail_th }}</textarea>
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">หัวข้อ Ethics ภาษาอังกฤษ</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="tilte_en" value="{{ $AboutUsEthics->tilte_en }}" placeholder="กรอกหัวข้อ Ethics ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">รายละเอียด Ethics ภาษาอังกฤษ</label>
                <div class="col-sm-12">
                    <textarea name="detail_en" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Ethics ภาษาอังกฤษ">{{ $AboutUsEthics->detail_en }}</textarea>
                </div>
            </div>

            <hr>

            <div class="form-group text-center">
                <a class="btn btn-outline-danger mr-2" role="button" href="{{ route('aboutusethics.index') }}">ยกเลิก</a>
                <button class="btn btn-primary" type="submit"><i class="fas fa-save mr-1"></i>บันทึกการแก้ไข</button>
            </div>
        </form>
    </div>
</div>
@endsection
