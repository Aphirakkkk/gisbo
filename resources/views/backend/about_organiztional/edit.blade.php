@extends('layouts.backend.sidenav-backend')
@section('css')
<style>
    .note-dropdown-menu.dropdown-menu.note-check.dropdown-fontname.show {
        overflow: scroll;
        height: 200px;
    }
    .portrait-preview-box {
        max-width: 200px;
        border: 2px dashed #ddd;
        padding: 6px;
        border-radius: 8px;
        background: #fafafa;
        margin-bottom: 12px;
        text-align: center;
    }
    .portrait-preview-img {
        max-width: 100%;
        max-height: 240px;
        object-fit: contain;
        border-radius: 4px;
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
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('aboutusorganiztionalstructure.update', $AboutUsOrganiztional->id) }}">
            @csrf
            @method('PATCH')

            <input type="hidden" name="id" value="{{ $AboutUsOrganiztional->id }}">
            <input type="hidden" name="active_status" value="{{ $AboutUsOrganiztional->active_status ?? 1 }}">
            <input type="hidden" name="display_status" value="{{ $AboutUsOrganiztional->display_status ?? 1 }}">

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">ลำดับการแสดงผล</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" name="sort_number" value="{{ $AboutUsOrganiztional->sort_number }}" min="1">
                    <small class="text-primary font-weight-bold"><i class="fas fa-info-circle mr-1"></i>เรียงจากน้อยไปมาก (ลำดับ 1 จะแสดงเป็นคนแรกสุด เช่น กรรมการผู้จัดการ)</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label font-weight-bold">ชื่อ-นามสกุล ภาษาไทย <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="full_name_th" value="{{ $AboutUsOrganiztional->full_name_th }}" placeholder="กรอกชื่อ-นามสกุล ภาษาไทย" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="control-label font-weight-bold">ตำแหน่งงาน ภาษาไทย <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="position_th" value="{{ $AboutUsOrganiztional->position_th }}" placeholder="กรอกตำแหน่งงาน ภาษาไทย" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="control-label font-weight-bold">ประวัติการศึกษา ภาษาไทย</label>
                        <textarea name="study_th" class="form-control CreatedDetailTh" placeholder="กรอกประวัติการศึกษา ภาษาไทย">{{ $AboutUsOrganiztional->study_th }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label font-weight-bold">ประวัติการทำงาน ภาษาไทย</label>
                        <textarea name="work_th" class="form-control CreatedDetailTh" placeholder="กรอกประวัติการทำงาน ภาษาไทย">{{ $AboutUsOrganiztional->work_th }}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label font-weight-bold">ชื่อ-นามสกุล ภาษาอังกฤษ</label>
                        <input type="text" class="form-control" name="full_name_en" value="{{ $AboutUsOrganiztional->full_name_en }}" placeholder="กรอกชื่อ-นามสกุล ภาษาอังกฤษ" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="control-label font-weight-bold">ตำแหน่งงาน ภาษาอังกฤษ</label>
                        <input type="text" class="form-control" name="position_en" value="{{ $AboutUsOrganiztional->position_en }}" placeholder="กรอกตำแหน่งงาน ภาษาอังกฤษ" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="control-label font-weight-bold">ประวัติการศึกษา ภาษาอังกฤษ</label>
                        <textarea name="study_en" class="form-control CreatedDetailTh" placeholder="กรอกประวัติการศึกษา ภาษาอังกฤษ">{{ $AboutUsOrganiztional->study_en }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label font-weight-bold">ประวัติการทำงาน ภาษาอังกฤษ</label>
                        <textarea name="work_en" class="form-control CreatedDetailTh" placeholder="กรอกประวัติการทำงาน ภาษาอังกฤษ">{{ $AboutUsOrganiztional->work_en }}</textarea>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">
                    รูปภาพบุคลากร (Portrait Image)
                    <span class="text-muted font-weight-normal">(ระบบจะครอบตัดและปรับขนาดให้พอดี 400x500 px โดยอัตโนมัติ)</span>
                </label>
                <div class="col-sm-6">
                    <div class="portrait-preview-box">
                        @if($AboutUsOrganiztional->image_main && $AboutUsOrganiztional->image_main != 'Unknown')
                        <img id="previewImg" src="{{ asset($AboutUsOrganiztional->image_main) }}" alt="Preview" class="portrait-preview-img">
                        @else
                        <img id="previewImg" src="{{ asset('assets/backend/images/error/nopic.jpg') }}" alt="Preview" class="portrait-preview-img">
                        @endif
                    </div>
                    <input type="file" name="image_main" id="imgInp" class="form-control" accept="image/*">
                    <input type="hidden" name="image_mainOld" value="{{ $AboutUsOrganiztional->image_main }}">
                    <small class="text-muted">หากไม่ต้องการเปลี่ยนรูปภาพ ไม่ต้องเลือกไฟล์ใหม่</small>
                </div>
            </div>

            <hr>
            <div class="text-center form-group">
                <a class="btn btn-outline-danger mr-2" role="button" href="{{ route('aboutusorganiztionalstructure.index') }}">ยกเลิก</a>
                <button class="btn btn-primary" type="submit"><i class="fas fa-save mr-1"></i>ยืนยันข้อมูล</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $('#imgInp').on('change', function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#previewImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endsection
