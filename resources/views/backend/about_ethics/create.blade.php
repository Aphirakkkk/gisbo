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
<div class="card cardboby">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-plus-circle mr-2"></i>{{ $titlePage }}
        </h3>
    </div>
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('aboutusethics.store') }}">
            @csrf
            
            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">ลำดับการแสดงผล</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" name="sort_number" value="{{ $sort_number }}" min="1">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">หัวข้อ Ethics ภาษาไทย <span class="text-danger">*</span></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="tilte_th" placeholder="กรอกหัวข้อ Ethics ภาษาไทย" required autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">รายละเอียด Ethics ภาษาไทย</label>
                <div class="col-sm-12">
                    <textarea name="detail_th" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Ethics ภาษาไทย"></textarea>
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">หัวข้อ Ethics ภาษาอังกฤษ</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="tilte_en" placeholder="กรอกหัวข้อ Ethics ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">รายละเอียด Ethics ภาษาอังกฤษ</label>
                <div class="col-sm-12">
                    <textarea name="detail_en" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Ethics ภาษาอังกฤษ"></textarea>
                </div>
            </div>

            <hr>

            <div class="text-center form-group">
                <a class="btn btn-outline-danger mr-2" role="button" href="{{ route('aboutusethics.index') }}">ยกเลิก</a>
                <button class="btn btn-primary" type="submit"><i class="fas fa-save mr-1"></i>ยืนยันข้อมูล</button>
            </div>
        </form>
    </div>
</div>
@endsection
