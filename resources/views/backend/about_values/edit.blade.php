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
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('aboutusvalues.update', $AboutUsValues->id) }}">
            @csrf
            @method('PATCH')

            <input type="hidden" name="active_status" value="{{ $AboutUsValues->active_status }}">
            <input type="hidden" name="display_status" value="{{ $AboutUsValues->display_status }}">
            <input type="hidden" name="image_mainOld" value="{{ $AboutUsValues->image_main }}">

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">ลำดับการแสดงผล</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" name="sort_number" value="{{ $AboutUsValues->sort_number }}" min="1">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">หัวข้อ Values ภาษาไทย <span class="text-danger">*</span></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="tilte_th" value="{{ $AboutUsValues->tilte_th }}" placeholder="กรอกหัวข้อ Values ภาษาไทย" required autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">รายละเอียด Values ภาษาไทย</label>
                <div class="col-sm-12">
                    <textarea name="detail_th" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Values ภาษาไทย">{{ $AboutUsValues->detail_th }}</textarea>
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">หัวข้อ Values ภาษาอังกฤษ</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="tilte_en" value="{{ $AboutUsValues->tilte_en }}" placeholder="กรอกหัวข้อ Values ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">รายละเอียด Values ภาษาอังกฤษ</label>
                <div class="col-sm-12">
                    <textarea name="detail_en" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Values ภาษาอังกฤษ">{{ $AboutUsValues->detail_en }}</textarea>
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">รูปภาพประกอบ Values</label>
                <div class="col-sm-12">
                    <div class="mb-2">
                        @if($AboutUsValues->image_main && $AboutUsValues->image_main != 'assets/backend/images/error/nopic.jpg')
                            <img class="blah shadow-sm border rounded" id="blah" src="{{ asset($AboutUsValues->image_main) }}" style="max-height: 180px; max-width: 280px; object-fit: contain;">
                        @else
                            <img class="blah shadow-sm border rounded" id="blah" src="{{ asset('assets/backend/images/error/nopic.jpg') }}" style="max-height: 180px; max-width: 280px; object-fit: contain;">
                        @endif
                    </div>
                    <input type="file" id="imgInp" name="image_main" class="form-control" accept="image/gif, image/jpeg, image/png, image/webp">
                    <small class="text-muted">เลือกรูปภาพใหม่หากต้องการเปลี่ยน (รองรับ JPG, PNG, WEBP)</small>
                </div>
            </div>

            <hr>

            <div class="form-group text-center">
                <a class="btn btn-outline-danger mr-2" role="button" href="{{ route('aboutusvalues.index') }}">ยกเลิก</a>
                <button class="btn btn-primary" type="submit"><i class="fas fa-save mr-1"></i>บันทึกการแก้ไข</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function() {
        readURL(this);
    });
</script>
@endsection
