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
        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('projectsreferencetype.store') }}">
            {{ csrf_field() }}
            {{ Form::hidden('sort_number', $sort_number, ['class' => 'form-control ']) }}
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ชื่อ Projects Reference Type ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_th" placeholder="กรอกชื่อ Projects Reference Type ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">ชื่อ Projects Reference Type ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_en" placeholder="กรอกชื่อ Projects Reference Type ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <hr>
            <div class="form-group text-center ">
                <a class="btn btn-outline-danger" role="button" href="{{ route('projectsreferencetype.index') }}">ยกเลิก</a>
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
