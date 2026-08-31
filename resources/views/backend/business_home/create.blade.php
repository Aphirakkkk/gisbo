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
        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('businesshome.store') }}">
            {{ csrf_field() }}
            {{ Form::hidden('sort_number', $sort_number, ['class' => 'form-control ']) }}
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">กลุ่ม Business</label>
                <div class="col-sm-12 col-md-12">
                    {{ Form::select('business_type_id', App\Models\BusinessType::where('active_status', 1)->pluck('tilte_th', 'id'), null, ['class' => 'select2 form-control', 'data-live-search' => 'true', 'placeholder' => 'กรุณาเลือกกลุ่ม Business']) }}
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อหลัก Business ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_th" placeholder="กรอกหัวข้อหลัก Business ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อย่อย Business ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="sub_tilte_th" placeholder="กรอกหัวข้อหลัก Business ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียด Business ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_th" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Business ภาษาไทย"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อหลัก Business ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_en" placeholder="กรอกหัวข้อหลัก Business ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อย่อย Business ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="sub_tilte_en" placeholder="กรอกหัวข้อหลัก Business ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียด Business ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_en" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Business ภาษาอังกฤษ"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">Link VDO</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="link_VDO" placeholder="กรอก Link VDO" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">รูป VDO <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 868px*567px)</span></label>
                <div class="col-sm-12">
                    <img class="blah" id="blah" src="{{ asset('assets/backend/images/error/nopic.jpg') }} " width='20%'>
                    <input type="file" name="image_VDO" id='imgInp' class="form-control" accept="image/gif, image/jpeg, image/png">
                </div>
            </div>
            <hr>
            <div class="form-group text-center ">
                <a class="btn btn-outline-danger" role="button" href="{{ route('businesshome.index') }}">ยกเลิก</a>
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
