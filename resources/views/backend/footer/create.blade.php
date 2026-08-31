@extends('layouts.backend.sidenav-backend')
@section('css')
<style>
    .cardboby {
        margin-top: 0rem;
    }

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
        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('footer.store') }}">
            {{ csrf_field() }}
            {{ Form::hidden('sort_number', $sort_number, ['class' => 'form-control ']) }}
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">ส่วนแสดงข้อมูล</label>
                <div class="col-sm-12 col-md-12">
                    <select class="form-control select2" name="type_footer" data-live-search="true">
                        <option value="">กรุณาเลือกส่วนแสดงข้อมูล</option>
                        <option value="1">ที่อยู่</option>
                        <option value="2">เบอร์โทรศัพท์</option>
                        <option value="3">โทรสาร</option>
                        <option value="4">E-mail</option>
                        <option value="5">facebook</option>
                        <option value="6">ไลน์</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">กรอกรายละเอียด Footer ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_th" placeholder="กรอกรายละเอียด Footer ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">รายละเอียด Footer ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" class="form-control" name="tilte_en" placeholder="กรอกรายละเอียด Footer ภาษาอังกฤษ" autocomplete="off">
                </div>
            </div>
            <hr>
            <div class="form-group text-center ">
                <a class="btn btn-outline-danger" role="button" href="{{ route('footer.index') }}">ยกเลิก</a>
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
