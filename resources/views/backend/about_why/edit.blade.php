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
            <i class="fas fa-edit mr-2"></i>{{ $titlePage }}
        </h3>
    </div>
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('aboutuswhychoose.update', $AboutUsWhyChoose->id) }}">
            @csrf
            @method('PATCH')

            <input type="hidden" name="id" value="{{ $AboutUsWhyChoose->id }}">
            <input type="hidden" name="active_status" value="{{ $AboutUsWhyChoose->active_status ?? 1 }}">
            <input type="hidden" name="display_status" value="{{ $AboutUsWhyChoose->display_status ?? 1 }}">

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">ลำดับการแสดงผล</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" name="sort_number" value="{{ $AboutUsWhyChoose->sort_number }}" min="1">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">หัวข้อ Why Choose ภาษาไทย <span class="text-danger">*</span></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="tilte_th" placeholder="กรอกหัวข้อ Why Choose ภาษาไทย" required autocomplete="off" value="{{ $AboutUsWhyChoose->tilte_th }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">รายละเอียด Why Choose ภาษาไทย</label>
                <div class="col-sm-12">
                    <textarea name="detail_th" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Why Choose ภาษาไทย">{{ $AboutUsWhyChoose->detail_th }}</textarea>
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">หัวข้อ Why Choose ภาษาอังกฤษ</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="tilte_en" placeholder="กรอกหัวข้อ Why Choose ภาษาอังกฤษ" autocomplete="off" value="{{ $AboutUsWhyChoose->tilte_en }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">รายละเอียด Why Choose ภาษาอังกฤษ</label>
                <div class="col-sm-12">
                    <textarea name="detail_en" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Why Choose ภาษาอังกฤษ">{{ $AboutUsWhyChoose->detail_en }}</textarea>
                </div>
            </div>

            <hr>

            <div class="form-group text-center">
                <a class="btn btn-outline-danger mr-2" role="button" href="{{ route('aboutuswhychoose.index') }}">ยกเลิก</a>
                <button class="btn btn-primary" type="submit"><i class="fas fa-save mr-1"></i>ยืนยันข้อมูล</button>
            </div>
        </form>
    </div>
</div>
@endsection
