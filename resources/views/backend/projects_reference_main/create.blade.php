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
        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('projectsreferencemain.store') }}">
            {{ csrf_field() }}
            {{ Form::hidden('sort_number', $sort_number, ['class' => 'form-control ']) }}
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">กลุ่มของProjects</label>
                <div class="col-sm-12 col-md-12">
                    {{ Form::select('projects_reference_type_id', App\Models\ProjectsReferenceType::where('active_status', 1)->pluck('tilte_th', 'id'), null, ['class' => 'select2 form-control', 'data-live-search' => 'true', 'placeholder' => 'กรุณาเลือกกลุ่มของProjects']) }}
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ชื่อ Projects ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_th" placeholder="กรอกชื่อProjects ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">เจ้าของ Projects ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="project_owner_th" placeholder="กรอกเจ้าของProjects ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">Seament ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="seament_th" placeholder="กรอก Seament ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ชื่อ Projects ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_en" placeholder="กรอกชื่อProjects ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">เจ้าของ Projects ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="project_owner_en" placeholder="กรอกเจ้าของProjects ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">Seaments ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="seament_en" placeholder="กรอก Seament ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ราคา Projects</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="project_value" placeholder="กรอกราคาProjects" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">เดือนที่เริ่มต้น</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="project_start_month" placeholder="กรอกปีที่เริ่มต้น" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ปีที่เริ่มต้น</label>
                <div class="col-sm-12 ">
                    <input type="number" class="form-control" name="project_start" placeholder="กรอกปีที่เริ่มต้น" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">เดือนที่แล้วเสร็จ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="project_completion_month" placeholder="กรอกปีที่แล้วเสร็จ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ปีที่แล้วเสร็จ</label>
                <div class="col-sm-12 ">
                    <input type="number" class="form-control" name="project_completion" placeholder="กรอกปีที่แล้วเสร็จ" autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รูป Projects (รูปหลัก) <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 290px*210px)</span></label>
                <div class="col-sm-12 col-md-12">
                    <img class="blah" id="blah" src="{{ asset('assets/backend/images/error/nopic.jpg') }} " width='20%'>
                    <input type="file" name="image_main" id='imgInp' class="form-control" accept="image/gif, image/jpeg, image/png">
                </div>
            </div>
            {{-- <div id="thumbnail_list"></div> --}}
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รูป Projects (เพิ่มเติม) <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 1920px*950px)</span></label>
                <div class="col-sm-12 col-md-12">
                    <div id="thumbnail_list"></div>
                    <button type="button" id="add_thumbnail" class="btn btn-primary">เพิ่มรูปภาพ</button>
                    <button style="display:none" type="button" id="delete_thumbnail" class="btn btn-danger">ลบรูปภาพ</button>
                </div>
            </div>
            <hr>
            <div class="text-center form-group ">
                <a class="btn btn-outline-danger" role="button" href="{{ route('projectsreferencemain.index') }}">ยกเลิก</a>
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
