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
        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('productservicesdetail.store') }}">
            {{ csrf_field() }}
            {{ Form::hidden('sort_number', $sort_number, ['class' => 'form-control ']) }}
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">หัวข้อ<span class="text-danger">*</span></label>
                <div class="col-sm-12 col-md-12">
                    <select class="form-control select2" name="product_services_type_id" data-live-search="true" required>
                        <option value="">กรุณาเลือกหน้าหัวข้อ</option>
                        <option value="1">Product</option>
                        <option value="2">Services</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียด Product & Services ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_th" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Product & Services ภาษาไทย"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียด Product & Services ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_en" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Product & Services ภาษาอังกฤษ"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">รูปที่ 1 <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 816px*480px)</span></label>
                <div class="col-sm-12">
                    <input type="file" name="image_1" class="form-control" accept="image/gif, image/jpeg, image/png">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">รูปที่ 2 <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 816px*480px)</span></label>
                <div class="col-sm-12">
                    <input type="file" name="image_2" class="form-control" accept="image/gif, image/jpeg, image/png">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">รูปที่ 3 <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 816px*480px)</span></label>
                <div class="col-sm-12">
                    <input type="file" name="image_3" class="form-control" accept="image/gif, image/jpeg, image/png">
                </div>
            </div>
            <div class="form-group row">
                <label for="m" class="col-sm-12 control-label TilteInput">รูปที่ 4 <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 816px*480px)</span></label>
                <div class="col-sm-12">
                    <input type="file" name="image_4" class="form-control" accept="image/gif, image/jpeg, image/png">
                </div>
            </div>
            <hr>
            <div class="form-group text-center ">
                <a class="btn btn-outline-danger" role="button" href="{{ route('productservicesdetail.index') }}">ยกเลิก</a>
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


@endsection
