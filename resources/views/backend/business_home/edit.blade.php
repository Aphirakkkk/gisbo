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

        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('businesshome.update', [$BusinessHome->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{ Form::hidden('id', $BusinessHome->id, ['class' => 'form-control']) }}
            {{ Form::hidden('active_status', $BusinessHome->active_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('display_status', $BusinessHome->display_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('created_by', $BusinessHome->created_by, ['class' => 'form-control ']) }}
            {{ Form::hidden('sort_number', $BusinessHome->sort_number, ['class' => 'form-control ']) }}

            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">กลุ่ม Business</label>
                <div class="col-sm-12 col-md-12">
                    {{ Form::select('business_type_id', App\Models\BusinessType::where('active_status', 1)->pluck('tilte_th', 'id'), $BusinessHome->business_type_id, ['class' => 'select2 form-control', 'data-live-search' => 'true', 'placeholder' => 'กรุณาเลือกกลุ่ม Business']) }}
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อหลัก Business ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_th" placeholder="กรอกหัวข้อหลัก Business ภาษาไทย" autocomplete="off" value="{{ $BusinessHome->tilte_th }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อย่อย Business ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="sub_tilte_th" placeholder="กรอกหัวข้อหลัก Business ภาษาไทย" autocomplete="off" value="{{ $BusinessHome->sub_tilte_th }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียด Business ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_th" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Business ภาษาไทย">{{ $BusinessHome->detail_th }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อหลัก Business ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_en" placeholder="กรอกหัวข้อหลัก Business ภาษาอังกฤษ" autocomplete="off" value="{{ $BusinessHome->tilte_en }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อย่อย Business ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="sub_tilte_en" placeholder="กรอกหัวข้อหลัก Business ภาษาอังกฤษ" autocomplete="off" value="{{ $BusinessHome->sub_tilte_en }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียด Business ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_en" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Business ภาษาอังกฤษ">{{ $BusinessHome->detail_en }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">Link VDO YouTube <span class="text-info" style="font-size: 13px; font-weight: normal;">(ใส่เป็นลิงก์ YouTube เช่น https://www.youtube.com/watch?v=... หรือใส่เฉพาะ Video ID ก็ได้)</span></label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="link_VDO" placeholder="วางลิงก์ YouTube (เช่น https://www.youtube.com/watch?v=...)" autocomplete="off" value="{{ $BusinessHome->link_VDO }}">
                    @if(!empty($BusinessHome->link_VDO))
                    <div class="mt-2 p-2" style="background: #1e293b; border-radius: 6px; display: inline-block;">
                        <span class="text-white small d-block mb-1"><i class="fab fa-youtube text-danger"></i> ตัวอย่างวิดีโอปัจจุบัน:</span>
                        <iframe width="320" height="180" src="https://www.youtube.com/embed/{{ $BusinessHome->link_VDO }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">รูป VDO <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 868px*567px)</span></label>
                <div class="col-sm-12 ">
                    @if(($BusinessHome->image_VDO))
                    <img class="blah" id="blah" width='20%' src="{{ asset($BusinessHome->image_VDO) }}">
                    @else
                    <img class="blah" id="blah" src="{{ asset('assets/backend/images/error/nopic.jpg') }} " width='20%'>
                    @endif
                    <input type="file" id='imgInp' name="image_VDO" class="inp form-control" accept="image/gif, image/jpeg, image/png">
                    <input type="hidden" name="image_VDOOld" class="inp form-control" value="{{ $BusinessHome->image_VDO }}">
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
