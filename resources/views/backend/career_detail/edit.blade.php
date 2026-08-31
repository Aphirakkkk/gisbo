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

        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('careerdetail.update', [$CareerDetail->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{ Form::hidden('id', $CareerDetail->id, ['class' => 'form-control']) }}
            {{ Form::hidden('active_status', $CareerDetail->active_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('display_status', $CareerDetail->display_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('created_by', $CareerDetail->created_by, ['class' => 'form-control ']) }}
            {{ Form::hidden('sort_number', $CareerDetail->sort_number, ['class' => 'form-control ']) }}

            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อรายละเอียด Career ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_th" placeholder="กรอกหัวข้อรายละเอียด Career ภาษาไทย" autocomplete="off" value="{{ $CareerDetail->tilte_th }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียด Career ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_th" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Career ภาษาไทย">{{ $CareerDetail->detail_th }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อรายละเอียด Career ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_en" placeholder="กรอกหัวข้อรายละเอียด Career ภาษาอังกฤษ" autocomplete="off" value="{{ $CareerDetail->tilte_en }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียด Career ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_en" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Career ภาษาอังกฤษ">{{ $CareerDetail->detail_en }}</textarea>
                </div>
            </div>
            <hr>
            <div class="form-group text-center ">
                <a class="btn btn-outline-danger" role="button" href="{{ route('careerdetail.index') }}">ยกเลิก</a>
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
                        url: "/imageNews/delete/"+id,
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
