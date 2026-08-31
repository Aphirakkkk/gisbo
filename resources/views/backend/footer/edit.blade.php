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

        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('footer.update', [$Footer->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{ Form::hidden('id', $Footer->id, ['class' => 'form-control']) }}
            {{ Form::hidden('active_status', $Footer->active_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('display_status', $Footer->display_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('created_by', $Footer->created_by, ['class' => 'form-control ']) }}
            {{ Form::hidden('sort_number', $Footer->sort_number, ['class' => 'form-control ']) }}
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">ส่วนแสดงข้อมูล</label>
                <div class="col-sm-12 col-md-12">
                    <select class="form-control select2" name="type_footer" data-live-search="true">
                        <option value="">กรุณาเลือกส่วนแสดงข้อมูล</option>
                        <option value="1" {{($Footer->type_footer == "1") ? 'selected' : ''}}>ที่อยู่</option>
                        <option value="2" {{($Footer->type_footer == "2") ? 'selected' : ''}}>เบอร์โทรศัพท์</option>
                        <option value="3" {{($Footer->type_footer == "3") ? 'selected' : ''}}>โทรสาร</option>
                        <option value="4" {{($Footer->type_footer == "4") ? 'selected' : ''}}>E-mail</option>
                        <option value="5" {{($Footer->type_footer == "5") ? 'selected' : ''}}>facebook</option>
                        <option value="6" {{($Footer->type_footer == "6") ? 'selected' : ''}}>ไลน์</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">กรอกรายละเอียด Footer ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{$Footer->tilte_th  }}" class="form-control" name="tilte_th" placeholder="กรอกรายละเอียด Footer ภาษาไทย" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">รายละเอียด Footer ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <input type="text" value="{{$Footer->tilte_en  }}" class="form-control" name="tilte_en" placeholder="กรอกรายละเอียด Footer ภาษาอังกฤษ" autocomplete="off">
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
