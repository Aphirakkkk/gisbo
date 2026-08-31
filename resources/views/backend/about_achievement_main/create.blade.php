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
        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('aboutusachievement.store') }}">
            {{ csrf_field() }}
            {{ Form::hidden('sort_number', $sort_number, ['class' => 'form-control ']) }}

            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">วันที่ลงข้อมูล</label>
                <div class="col-sm-12 ">
                    <input class="form-control inp" type="date" name="dateDetail">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อ AboutUs Achievement ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_th" placeholder="กรอกหัวข้อ AboutUs Achievement ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อของรายละเอียด AboutUs Achievement ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_thDetail" placeholder="กรอกหัวข้อของรายละเอียด AboutUs Achievement ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียดหัวข้อของรายละเอียด AboutUs Achievement ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_thDetail" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียดหัวข้อของรายละเอียด AboutUs Achievement ภาษาไทย"></textarea>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อ AboutUs Achievement ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_en" placeholder="กรอกหัวข้อ AboutUs Achievement ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อของรายละเอียด AboutUs Achievement ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_enDetail" placeholder="กรอกหัวข้อของรายละเอียด AboutUs Achievement ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียดหัวข้อของรายละเอียด AboutUs Achievement ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_enDetail" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียดหัวข้อของรายละเอียด AboutUs Achievement ภาษาอังกฤษ"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รูป AboutUs Achievement (รูปหลัก) <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 360px*240px)</span></label>
                <div class="col-sm-12 col-md-12">
                    <img class="blah" id="blah" src="{{ asset('assets/backend/images/error/nopic.jpg') }} " width='20%'>
                    <input type="file" name="image_main" id='imgInp' class="form-control" accept="image/gif, image/jpeg, image/png">
                </div>
            </div>
            {{-- <div id="thumbnail_list"></div> --}}
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รูป AboutUs Achievement (เพิ่มเติม) <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 720px*400px)</span></label>
                <div class="col-sm-12 col-md-12">
                    <div id="thumbnail_list"></div>
                    <button type="button" id="add_thumbnail" class="btn btn-primary">เพิ่มรูปภาพ</button>
                    <button style="display:none" type="button" id="delete_thumbnail" class="btn btn-danger">ลบรูปภาพ</button>
                </div>
            </div>
            <hr>
            <div class="text-center form-group ">
                <a class="btn btn-outline-danger" role="button" href="{{ route('aboutusachievement.index') }}">ยกเลิก</a>
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
    counter = 0;
                $("#add_thumbnail").click(function () {
                    $("#delete_thumbnail").show();
                    counter = counter + 1;
                    $("#thumbnail_list").append("<div id='thumbnail_section_" + counter +"'><img class='blah' id='blah_" + counter +"'src='{{ asset('assets/backend/images/error/nopic.jpg') }} ' onchange='readURL_other(this,'#blah_"+counter+"')' width='20%'>"
                        +"<input type='file' name='image_more[]' id='imgInp_"+counter+"' class='form-control' accept='image/gif, image/jpeg, image/png' onchange='readURL_other(this,"+counter+")'><br/></div>");
                });
                $("#delete_thumbnail").click(function () {
                    $("#thumbnail_section_" + counter).remove();
                    counter = counter - 1;
                    if (counter == 0) {
                        $("#delete_thumbnail").hide();
                    }
                });

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
                function readURL_other(input,counter) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $("#blah_"+counter).attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
</script>

@endsection
