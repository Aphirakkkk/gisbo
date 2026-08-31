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

        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('contactus.update', [$Contact->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{ Form::hidden('id', $Contact->id, ['class' => 'form-control']) }}
            {{ Form::hidden('active_status', $Contact->active_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('display_status', $Contact->display_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('created_by', $Contact->created_by, ['class' => 'form-control ']) }}

            {{ Form::hidden('sort_number', $Contact->sort_number, ['class' => 'form-control ']) }}

            <div class="form-group row">
                <label for="m" class="col-sm-12 ontrol-label TilteInput">รูป Contact US <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 1920px*950px)</span></label>
                <div class="col-sm-12 ">
                    @if(($Contact->image_main))
                    <img class="blah" id="blah" width='20%' src="{{ asset($Contact->image_main) }}">
                    @else
                    <img class="blah" id="blah" src="{{ asset('assets/backend/images/error/nopic.jpg') }} " width='20%'>
                    @endif
                    <input type="file" id='imgInp' name="image_main" class="inp form-control" accept="image/gif, image/jpeg, image/png">
                    <input type="hidden" name="image_mainOld" class="inp form-control" value="{{ $Contact->image_main }}">
                </div>
            </div>
            <hr>
            <div class="form-group text-center ">
                <a class="btn btn-outline-danger" role="button" href="{{ route('contactus.index') }}">ยกเลิก</a>
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
