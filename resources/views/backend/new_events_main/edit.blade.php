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

        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('neweventsmain.update', [$NewEventsMain->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{ Form::hidden('id', $NewEventsMain->id, ['class' => 'form-control']) }}
            {{ Form::hidden('active_status', $NewEventsMain->active_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('display_status', $NewEventsMain->display_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('created_by', $NewEventsMain->created_by, ['class' => 'form-control ']) }}
            {{ Form::hidden('sort_number', $NewEventsMain->sort_number, ['class' => 'form-control ']) }}

            @php
            $dtend = \DateTime::createFromFormat('Y-m-d', $NewEventsMain->date);
            $date2 = $dtend->format('Y-m-d');

            @endphp
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">วันที่ลงข่าว</label>
                <div class="col-sm-12 ">
                    <input class="form-control inp" type="date" name="date" value="{{ $date2}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ชื่อหัวข้อข่าว ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{ $NewEventsMain->tilte_th }}" class="form-control" name="tilte_th" placeholder="กรอกชื่อหัวข้อข่าว ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียดหัวข้อข่าวภาษาไทย</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_th" class="form-control " placeholder="กรอกรายละเอียดข่าว ภาษาไทย">{{ $NewEventsMain->detail_th }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ชื่อหัวข้อข่าว ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{ $NewEventsMain->tilte_en }}" class="form-control" name="tilte_en" placeholder="กรอกชื่อหัวข้อข่าว ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียดหัวข้อข่าว ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_en" class="form-control " placeholder="กรอกรายละเอียดข่าว ภาษาอังกฤษ">{{ $NewEventsMain->detail_en }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รูปข่าว (รูปหลัก / รูปปกหน้าแรก & รูปแรกในแกลเลอรี) <span class="text-danger">(ขนาดรูปที่แนะนำ 538px*230px)</span></label>
                <div class="col-sm-12 col-md-12">
                    <img class="blah d-block" id="blah" style="max-height: 150px; border-radius: 8px; margin-bottom: 10px; border: 1px solid #ddd; object-fit: cover;" src="{{ !empty($NewEventsMain->image_main) && $NewEventsMain->image_main != 'Unknown' ? asset($NewEventsMain->image_main) : asset('assets/backend/images/error/nopic.jpg') }}">
                    <input type="file" id='imgInp' name="image_main" class="inp form-control" accept="image/gif, image/jpeg, image/png">
                    <input type="hidden" name="image_mainOld" class="inp form-control" value="{{ $NewEventsMain->image_main }}">
                    <small class="text-muted d-block mt-1">* หากต้องการเปลี่ยนรูปหลัก/รูปแรก ให้กดเลือกไฟล์ใหม่ที่ช่องนี้ได้เลย (หากไม่เปลี่ยน ให้ปล่อยว่างไว้)</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">เพิ่มรูปภาพเพิ่มเติมในแกลเลอรี <span class="text-danger">(ขนาดรูปที่แนะนำ 700px*400px)</span></label>
                <div class="col-sm-12 col-md-12">
                    <div id="thumbnail_list"></div>
                    <button type="button" id="add_thumbnail" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มรูปภาพใหม่</button>
                    <button style="display:none" type="button" id="delete_thumbnail" class="btn btn-danger"><i class="fas fa-minus"></i> ลบช่องที่เพิ่ม</button>
                </div>
            </div>
            <div class="mt-4 mb-2">
                <h5 class="text-primary font-weight-bold"><i class="fas fa-images"></i> รายการรูปภาพทั้งหมดในแกลเลอรีปัจจุบัน</h5>
                <small class="text-muted d-block mb-2">* แถวที่ 1 คือรูปหลัก (หากต้องการเปลี่ยนให้เลือกที่ช่อง "รูปข่าวหลัก" ด้านบน) / แถวที่ 2 เป็นต้นไป สามารถกดปุ่มถังขยะสีแดงเพื่อลบรูปออกได้</small>
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
                <a class="btn btn-outline-danger" role="button" href="{{ route('neweventsmain.index') }}">ยกเลิก</a>
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
                        url: "/neweventsmain/image/delete/"+id,
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
