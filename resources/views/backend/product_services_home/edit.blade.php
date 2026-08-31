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

        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('productserviceshome.update', [$ProductServicesHome->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{ Form::hidden('id', $ProductServicesHome->id, ['class' => 'form-control']) }}
            {{ Form::hidden('active_status', $ProductServicesHome->active_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('display_status', $ProductServicesHome->display_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('created_by', $ProductServicesHome->created_by, ['class' => 'form-control ']) }}
            {{ Form::hidden('sort_number', $ProductServicesHome->sort_number, ['class' => 'form-control ']) }}


            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อหลัก Product & Services ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_th" placeholder="กรอกหัวข้อหลัก Product & Services ภาษาไทย" autocomplete="off" value="{{ $ProductServicesHome->tilte_th }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียด Product & Services ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_th" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Product & Services ภาษาไทย">{{ $ProductServicesHome->detail_th }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">หัวข้อหลัก Product & Services ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_en" placeholder="กรอกหัวข้อหลัก Product & Services ภาษาอังกฤษ" autocomplete="off" value="{{ $ProductServicesHome->tilte_en }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียด Product & Services ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_en" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Product & Services ภาษาอังกฤษ">{{ $ProductServicesHome->detail_en }}</textarea>
                </div>
            </div>

            <hr>
            <div class="form-group text-center ">
                <a class="btn btn-outline-danger" role="button" href="{{ route('productserviceshome.index') }}">ยกเลิก</a>
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
