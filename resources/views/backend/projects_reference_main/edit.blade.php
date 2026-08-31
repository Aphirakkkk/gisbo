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

        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('projectsreferencemain.update', [$ProjectsReferenceMain->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{ Form::hidden('id', $ProjectsReferenceMain->id, ['class' => 'form-control']) }}
            {{ Form::hidden('active_status', $ProjectsReferenceMain->active_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('display_status', $ProjectsReferenceMain->display_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('created_by', $ProjectsReferenceMain->created_by, ['class' => 'form-control ']) }}
            {{ Form::hidden('sort_number', $ProjectsReferenceMain->sort_number, ['class' => 'form-control ']) }}

            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">กลุ่มของProjects</label>
                <div class="col-sm-12 col-md-12">
                    {{ Form::select('projects_reference_type_id', App\Models\ProjectsReferenceType::where('active_status', 1)->pluck('tilte_th', 'id'), $ProjectsReferenceMain->projects_reference_type_id, ['class' => 'select2 form-control', 'data-live-search' => 'true', 'placeholder' => 'กรุณาเลือกกลุ่มของProjects']) }}
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ชื่อ Projects ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{ $ProjectsReferenceMain->tilte_th }}" class="form-control" name="tilte_th" placeholder="กรอกชื่อProjects ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">เจ้าของ Projects ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{ $ProjectsReferenceMain->project_owner_th }}" class="form-control" name="project_owner_th" placeholder="กรอกเจ้าของProjects ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">Seament ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{ $ProjectsReferenceMain->seament_th }}" class="form-control" name="seament_th" placeholder="กรอก Seament ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ชื่อ Projects ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{ $ProjectsReferenceMain->tilte_en }}" class="form-control" name="tilte_en" placeholder="กรอกชื่อProjects ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">เจ้าของ Projects ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{ $ProjectsReferenceMain->project_owner_en }}" class="form-control" name="project_owner_en" placeholder="กรอกเจ้าของProjects ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">Seaments ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{ $ProjectsReferenceMain->seament_en }}" class="form-control" name="seament_en" placeholder="กรอก Seament ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ราคา Projects</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{ $ProjectsReferenceMain->project_value }}" class="form-control" name="project_value" placeholder="กรอกราคาProjects" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">เดือนที่เริ่มต้น</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{ $ProjectsReferenceMain->project_start_month }}" class="form-control" name="project_start_month" placeholder="กรอกปีที่เริ่มต้น" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ปีที่เริ่มต้น</label>
                <div class="col-sm-12 ">
                    <input type="number" value="{{ $ProjectsReferenceMain->project_start }}" class="form-control" name="project_start" placeholder="กรอกปีที่เริ่มต้น" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">เดือนที่แล้วเสร็จ</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{ $ProjectsReferenceMain->project_completion_month }}" class="form-control" name="project_completion_month" placeholder="กรอกปีที่แล้วเสร็จ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ปีที่แล้วเสร็จ</label>
                <div class="col-sm-12 ">
                    <input type="number" value="{{ $ProjectsReferenceMain->project_completion }}" class="form-control" name="project_completion" placeholder="กรอกปีที่แล้วเสร็จ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รูป Projects <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 290px*210px)</span></label>
                <div class="col-sm-12 col-md-12">
                    <img class="blah" id="blah" width='20%' src="{{ asset('assets/backend/images/error/nopic.jpg') }}">
                    <input type="file" id='imgInp' name="image_main" class="inp form-control" accept="image/gif, image/jpeg, image/png">
                    <input type="hidden" name="image_mainOld" class="inp form-control" value="{{ $ProjectsReferenceMain->image_main }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รูป Projects (เพิ่มเติม) <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 1920px*950px)</span></label>
                <div class="col-sm-12 col-md-12">
                    <div id="thumbnail_list"></div>
                    <button type="button" id="add_thumbnail" class="btn btn-primary">เพิ่มรูปภาพ</button>
                    <button style="display:none" type="button" id="delete_thumbnail" class="btn btn-danger">ลบรูปภาพ</button>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover dataTable" id="row-thumbail">
                <thead>
                    <tr class="text-center success">
                        <th style="width:15%">รูปภาพ</th>
                        <th style="width:20%">การดำเนินการ</th>
                    </tr>
                </thead>
                <tbody class="">
                    @forelse ($Images as $key => $Image)
                    <tr id="{{ $Image->id }}">
                        <td class="text-center"><img src="{{ url($Image->image) }}" alt="{{ $Image->image }}" height="40">
                        </td>
                        @if($Image->sort_number == 1)
                        <td class="text-center">
                            <a id="{{ $Image->id }}" class="btn bg-red waves-effect disabled"><i class="far fa-trash-alt" style="color:white"></i></a>
                        </td>
                        @else
                        <td class="text-center">
                            <a id="{{ $Image->id }}" class="btn delete_product_thumbnail bg-red waves-effect"><i class="far fa-trash-alt" style="color:white"></i></a>
                        </td>
                        @endif
                    </tr>
                    @empty
                    {{-- <p>ไม่มีรูปภาพ</p> --}}
                    @endforelse
                </tbody>
            </table>
            <hr>
            <div class="form-group text-center ">
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
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".delete_product_thumbnail").click(function () {
            // var id = $(this).attr('id').replace("destroy_", "");
            var rows = document.getElementById("row-thumbail").getElementsByTagName("tr").length;
            var id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "/projectsreferencemain/image/delete/"+id,
                        method: "delete",
                        data: {
                            id: id
                        },
                        success: function (data) {
                            if (data == 200) {
                                Swal.fire({
                                    type: 'success',
                                    title: 'Deleted!',
                                    showConfirmButton:false
                                });
                                setTimeout(function () {
                                    swal.close();
                                }, 2000);
                                // window.location.reload();
                                $("#"+id).fadeOut();
                                // rows = rows-1;
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'เกิดข้อผิดพลาดในการลบข้อมูล',
                                    showConfirmButton:false,
                                })
                            }
                        }
                    });
                }
            });
        });
    });
</script>

@endsection
