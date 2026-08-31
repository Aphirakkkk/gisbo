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
<div class="card cardboby">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-edit"></i>
            {{ $titlePage }}
        </h3>
    </div>
    <div class="card-body">
        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('banner.store') }}">
            {{ csrf_field() }}
            {{ Form::hidden('sort_number', $sort_number, ['class' => 'form-control ']) }}
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ข้อความ Banner ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_th" placeholder="กรอกข้อความ Banner ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ข้อความย่อย Banner ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="detail_th" placeholder="กรอกข้อความย่อย Banner ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ข้อความ Banner ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_en" placeholder="กรอกข้อความ Banner ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ข้อความย่อย Banner ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="detail_en" placeholder="กรอกข้อความย่อย Banner ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">รูป Text Banner <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 960px*87px)</span></label>
                <div class="col-sm-12">
                    <div class="mb-2">
                        <img id="preview_text" style="max-height: 80px; max-width: 300px; background-color: #f1f5f9; padding: 4px; border: 1px solid #e2e8f0; border-radius: 4px;" src="{{ asset('assets/backend/images/error/nopic.jpg') }}">
                    </div>
                    <input type="file" id="inp_text" name="image_banner_text" class="form-control" accept="image/gif, image/jpeg, image/png, image/webp">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">รูป Banner <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 1920px*900px)</span></label>
                <div class="col-sm-12">
                    <div class="mb-2">
                        <img id="preview_slide" style="max-height: 140px; max-width: 300px; background-color: #f1f5f9; padding: 4px; border: 1px solid #e2e8f0; border-radius: 4px;" src="{{ asset('assets/backend/images/error/nopic.jpg') }}">
                    </div>
                    <input type="file" name="image_banner_slide" id='imgInp' class="form-control" accept="image/gif, image/jpeg, image/png, image/webp">
                </div>
            </div>
            <hr>
            <div class="form-group text-center ">
                <a class="btn btn-outline-danger" role="button" href="{{ route('banner.index') }}">ยกเลิก</a>
                <input class="btn btn-outline-primary" type="submit" value="ยืนยันข้อมูล">
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
    function readURL(input, targetSelector) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(targetSelector).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function() {
        readURL(this, '#preview_slide');
    });
    $("#inp_text").change(function() {
        readURL(this, '#preview_text');
    });
</script>

@endsection
