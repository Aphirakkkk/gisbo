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

        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('aboutusachievement.update', [$AboutUsAchievementMain->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{ Form::hidden('id', $AboutUsAchievementMain->id, ['class' => 'form-control']) }}
            {{ Form::hidden('active_status', $AboutUsAchievementMain->active_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('display_status', $AboutUsAchievementMain->display_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('created_by', $AboutUsAchievementMain->created_by, ['class' => 'form-control ']) }}
            {{ Form::hidden('sort_number', $AboutUsAchievementMain->sort_number, ['class' => 'form-control ']) }}

            @php
            $date2 = date('Y-m-d');
            if ($AboutUsAchievementMain->aboutUsAchievementDetail && $AboutUsAchievementMain->aboutUsAchievementDetail->date) {
                try {
                    $dtend = new \DateTime($AboutUsAchievementMain->aboutUsAchievementDetail->date);
                    $date2 = $dtend->format('Y-m-d');
                } catch (\Throwable $e) {
                    $date2 = date('Y-m-d');
                }
            }
            @endphp
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">วันที่ลงข่าว</label>
                <div class="col-sm-12 ">
                    <input class="form-control inp" type="date" name="dateDetail" value="{{ $date2 }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อ AboutUs Achievement ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_th" placeholder="กรอกหัวข้อ AboutUs Achievement ภาษาไทย" autocomplete="off" value="{{ $AboutUsAchievementMain->tilte_th }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อของรายละเอียด AboutUs Achievement ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_thDetail" placeholder="กรอกหัวข้อของรายละเอียด AboutUs Achievement ภาษาไทย" autocomplete="off" value="{{ $AboutUsAchievementMain->aboutUsAchievementDetail->tilte_th ?? $AboutUsAchievementMain->tilte_th }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียดหัวข้อของรายละเอียด AboutUs Achievement ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_thDetail" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียดหัวข้อของรายละเอียด AboutUs Achievement ภาษาไทย">{{ $AboutUsAchievementMain->aboutUsAchievementDetail->detail_th ?? '' }}</textarea>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อ AboutUs Achievement ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_en" placeholder="กรอกหัวข้อ AboutUs Achievement ภาษาอังกฤษ" autocomplete="off" value="{{ $AboutUsAchievementMain->tilte_en }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อของรายละเอียด AboutUs Achievement ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_enDetail" placeholder="กรอกหัวข้อของรายละเอียด AboutUs Achievement ภาษาอังกฤษ" autocomplete="off" value="{{ $AboutUsAchievementMain->aboutUsAchievementDetail->tilte_en ?? $AboutUsAchievementMain->tilte_en }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียดหัวข้อของรายละเอียด AboutUs Achievement ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_enDetail" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียดหัวข้อของรายละเอียด AboutUs Achievement ภาษาอังกฤษ">{{ $AboutUsAchievementMain->aboutUsAchievementDetail->detail_en ?? '' }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รูป Achievement (รูปหลัก) <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 360px*240px)</span></label>
                <div class="col-sm-12 col-md-12">
                    @if($AboutUsAchievementMain->image_main && $AboutUsAchievementMain->image_main != 'Unknown' && $AboutUsAchievementMain->image_main != 'assets/backend/images/error/nopic.jpg')
                    <img class="blah" id="blah" width='20%' src="{{ asset($AboutUsAchievementMain->image_main) }}">
                    @else
                    <img class="blah" id="blah" width='20%' src="{{ asset('assets/backend/images/error/nopic.jpg') }}">
                    @endif
                    <input type="file" id='imgInp' name="image_main" class="inp form-control mt-2" accept="image/gif, image/jpeg, image/png">
                    <input type="hidden" name="image_mainOld" class="inp form-control" value="{{ $AboutUsAchievementMain->image_main }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รูป Achievement (เพิ่มเติม) <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 720px*400px)</span></label>
                <div class="col-sm-12 col-md-12">
                    <div id="thumbnail_list"></div>
                    <button type="button" id="add_thumbnail" class="btn btn-primary mt-2">เพิ่มรูปภาพ</button>
                    <button style="display:none" type="button" id="delete_thumbnail" class="btn btn-danger mt-2">ลบรูปภาพ</button>
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
                    <tr id="img_row_{{ $Image->id }}">
                        <td class="text-center">
                            <img src="{{ asset($Image->image) }}" alt="{{ $Image->image }}" height="50" style="object-fit: cover; border-radius: 4px;">
                        </td>
                        @if($Image->sort_number == 1)
                        <td class="text-center">
                            <span class="badge badge-info">รูปภาพหลัก</span>
                        </td>
                        @else
                        <td class="text-center">
                            <button type="button" data-id="{{ $Image->id }}" class="btn delete_product_thumbnail btn-sm btn-outline-danger">
                                <i class="far fa-trash-alt mr-1"></i>ลบรูปนี้
                            </button>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted">ไม่มีรูปภาพเพิ่มเติม</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <hr>
            <div class="form-group text-center ">
                <a class="btn btn-outline-danger" role="button" href="{{ route('aboutusachievement.index') }}">ยกเลิก</a>
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
    var counter = 0;
    $("#add_thumbnail").click(function () {
        $("#delete_thumbnail").show();
        counter = counter + 1;
        $("#thumbnail_list").append("<div id='thumbnail_section_" + counter +"' class='mb-3'><img class='blah' id='blah_" + counter +"' src='{{ asset('assets/backend/images/error/nopic.jpg') }}' width='20%'>"
            +"<input type='file' name='image_more[]' id='imgInp_"+counter+"' class='form-control mt-1' accept='image/gif, image/jpeg, image/png' onchange='readURL_other(this,"+counter+")'></div>");
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

    function readURL_other(input, counter) {
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
            var id = $(this).data('id');
            Swal.fire({
                title: 'ยืนยันการลบรูปภาพ?',
                text: "คุณไม่สามารถย้อนกลับการทำรายการนี้ได้!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ใช่, ลบรูปภาพ!'
            }).then((result) => {
                if (result.value || result.isConfirmed) {
                    $.ajax({
                        url: "/aboutusachievement/image/delete/" + id,
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function (data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบรูปภาพสำเร็จ!',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            $("#img_row_" + id).fadeOut(300, function() { $(this).remove(); });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาดในการลบรูปภาพ',
                                showConfirmButton: true,
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
