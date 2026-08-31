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
<div class="card cardboby card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-edit"></i>
            {{ $titlePage }}
        </h3>
    </div>
    <div class="card-body">

        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('businessdetail.update', [$BusinessDetail->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{ Form::hidden('id', $BusinessDetail->id, ['class' => 'form-control']) }}
            {{ Form::hidden('active_status', $BusinessDetail->active_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('display_status', $BusinessDetail->display_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('created_by', $BusinessDetail->created_by, ['class' => 'form-control ']) }}
            {{ Form::hidden('sort_number', $BusinessDetail->sort_number, ['class' => 'form-control ']) }}

            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">กลุ่ม Business</label>
                <div class="col-sm-12 col-md-12">
                    {{ Form::select('business_type_id', App\Models\BusinessType::where('active_status', 1)->pluck('tilte_th', 'id'), $BusinessDetail->business_type_id, ['class' => 'select2 form-control', 'data-live-search' => 'true', 'placeholder' => 'กรุณาเลือกกลุ่ม Business']) }}
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อหลัก Business ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_th" placeholder="กรอกหัวข้อหลัก Business ภาษาไทย" autocomplete="off" value="{{ $BusinessDetail->tilte_th }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อย่อย Business ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="sub_tilte_th" placeholder="กรอกหัวข้อหลัก Business ภาษาไทย" autocomplete="off" value="{{ $BusinessDetail->sub_tilte_th }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียด Business ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_th" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Business ภาษาไทย">{{ $BusinessDetail->detail_th }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียดย่อย Business ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <textarea name="sub_detail_th" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Business ภาษาไทย">{{ $BusinessDetail->sub_detail_th }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">คำสโลแกน ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="slogan_th" placeholder="กรอกคำสโลแกน ภาษาไทย" autocomplete="off" value="{{ $BusinessDetail->slogan_th }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อหลัก Business ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_en" placeholder="กรอกหัวข้อหลัก Business ภาษาอังกฤษ" autocomplete="off" value="{{ $BusinessDetail->tilte_en }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อย่อย Business ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="sub_tilte_en" placeholder="กรอกหัวข้อหลัก Business ภาษาอังกฤษ" autocomplete="off" value="{{ $BusinessDetail->sub_tilte_en }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียด Business ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_en" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Business ภาษาอังกฤษ">{{ $BusinessDetail->detail_en }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียดย่อย Business ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <textarea name="sub_detail_en" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Business ภาษาอังกฤษ">{{ $BusinessDetail->sub_detail_en }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">คำสโลแกน ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="slogan_en" placeholder="กรอกคำสโลแกน ภาษาอังกฤษ" autocomplete="off" value="{{ $BusinessDetail->slogan_en }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">Link VDO</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="link_VDO" placeholder="กรอก Link VDO" autocomplete="off" value="{{ $BusinessDetail->link_VDO }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">รูป VDO <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 1080px*610px)</span></label>
                <div class="col-sm-12 ">
                    @if(($BusinessDetail->image_VDO))
                    <img class="blah" id="blah" width='20%' src="{{ asset($BusinessDetail->image_VDO) }}">
                    @else
                    <img class="blah" id="blah" src="{{ asset('assets/backend/images/error/nopic.jpg') }} " width='20%'>
                    @endif
                    <input type="file" id='imgInp' name="image_VDO" class="inp form-control" accept="image/gif, image/jpeg, image/png">
                    <input type="hidden" name="image_VDOOld" class="inp form-control" value="{{ $BusinessDetail->image_VDO }}">
                </div>
            </div>
            <hr>
            <div class="form-group text-center ">
                <a class="btn btn-outline-danger" role="button" href="{{ route('businessdetail.index') }}">ยกเลิก</a>
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
