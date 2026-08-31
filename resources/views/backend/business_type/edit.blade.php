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

        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('businesstype.update', [$BusinessType->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{ Form::hidden('id', $BusinessType->id, ['class' => 'form-control']) }}
            {{ Form::hidden('active_status', $BusinessType->active_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('display_status', $BusinessType->display_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('created_by', $BusinessType->created_by, ['class' => 'form-control ']) }}

            {{ Form::hidden('sort_number', $BusinessType->sort_number, ['class' => 'form-control ']) }}
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ชื่อ Business ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{ $BusinessType->tilte_th }}" class="form-control" name="tilte_th" placeholder="กรอกชื่อ Business ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ชื่อ Business ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{ $BusinessType->tilte_en }}" class="form-control" name="tilte_en" placeholder="กรอกชื่อ Business ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">รูป ICON <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 273px*190px)</span></label>
                <div class="col-sm-12 ">
                    @if(($BusinessType->image_icon))
                    <img class="blah" id="blah" width='20%' src="{{ asset($BusinessType->image_icon) }}">
                    @else
                    <img class="blah" id="blah" src="{{ asset('assets/backend/images/error/nopic.jpg') }} " width='20%'>
                    @endif
                    <input type="file" id='imgInp' name="image_icon" class="inp form-control" accept="image/gif, image/jpeg, image/png">
                    <input type="hidden" name="image_iconOld" class="inp form-control" value="{{ $BusinessType->image_icon }}">
                </div>
            </div>
            <hr>
            <div class="form-group text-center ">
                <a class="btn btn-outline-danger" role="button" href="{{ route('businesstype.index') }}">ยกเลิก</a>
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
