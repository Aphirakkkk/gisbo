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

        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('productservicesdetail.update', [$ProductServicesDetail->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{ Form::hidden('id', $ProductServicesDetail->id, ['class' => 'form-control']) }}
            {{ Form::hidden('active_status', $ProductServicesDetail->active_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('display_status', $ProductServicesDetail->display_status, ['class' => 'form-control ']) }}
            {{ Form::hidden('created_by', $ProductServicesDetail->created_by, ['class' => 'form-control ']) }}
            {{ Form::hidden('sort_number', $ProductServicesDetail->sort_number, ['class' => 'form-control ']) }}
            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">หัวข้อ<span class="text-danger">*</span></label>
                <div class="col-sm-12 col-md-12">
                    <select class="form-control select2" name="product_services_type_id" data-live-search="true" required>
                        <option value="">กรุณาเลือกหน้าหัวข้อ</option>
                        <option value="1" {{($ProductServicesDetail->product_services_type_id == "1") ? 'selected' : ''}}>Product</option>
                        <option value="2" {{($ProductServicesDetail->product_services_type_id == "2") ? 'selected' : ''}}>Services</option>
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียด Product & Services ภาษาไทย</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_th" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Product & Services ภาษาไทย">{{ $ProductServicesDetail->detail_th }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="m" class="col-sm-12 col-md-12 control-label TilteInput">รายละเอียด Product & Services ภาษาอังกฤษ</label>
                <div class="col-sm-12 ">
                    <textarea name="detail_en" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียด Product & Services ภาษาอังกฤษ">{{ $ProductServicesDetail->detail_en }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="m" class="col-sm-12 ontrol-label TilteInput">รูปที่ 1 <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 816px*480px)</span></label>
                <div class="col-sm-12 ">
                    @if(($ProductServicesDetail->image_1))
                    <img width='20%' src="{{ asset($ProductServicesDetail->image_1) }}">
                    @else
                    <img src="{{ asset('assets/backend/images/error/nopic.jpg') }} " width='20%'>
                    @endif
                    <input type="file" name="image_1" class="inp form-control" accept="image/gif, image/jpeg, image/png">
                    <input type="hidden" name="image_1Old" class="inp form-control" value="{{ $ProductServicesDetail->image_1 }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="m" class="col-sm-12 ontrol-label TilteInput">รูปที่ 2 <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 816px*480px)</span></label>
                <div class="col-sm-12 ">
                    @if(($ProductServicesDetail->image_2))
                    <img width='20%' src="{{ asset($ProductServicesDetail->image_2) }}">
                    @else
                    <img src="{{ asset('assets/backend/images/error/nopic.jpg') }} " width='20%'>
                    @endif
                    <input type="file" name="image_2" class="inp form-control" accept="image/gif, image/jpeg, image/png">
                    <input type="hidden" name="image_2Old" class="inp form-control" value="{{ $ProductServicesDetail->image_2 }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="m" class="col-sm-12 ontrol-label TilteInput">รูปที่ 3 <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 816px*480px)</span></label>
                <div class="col-sm-12 ">
                    @if(($ProductServicesDetail->image_3))
                    <img width='20%' src="{{ asset($ProductServicesDetail->image_3) }}">
                    @else
                    <img src="{{ asset('assets/backend/images/error/nopic.jpg') }} " width='20%'>
                    @endif
                    <input type="file" name="image_3" class="inp form-control" accept="image/gif, image/jpeg, image/png">
                    <input type="hidden" name="image_3Old" class="inp form-control" value="{{ $ProductServicesDetail->image_3 }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="m" class="col-sm-12 ontrol-label TilteInput">รูปที่ 4 <span class="text-danger">(ขนาดรูปที่แนะนำควรเป็นขนาด 816px*480px)</span></label>
                <div class="col-sm-12 ">
                    @if(($ProductServicesDetail->image_4))
                    <img width='20%' src="{{ asset($ProductServicesDetail->image_4) }}">
                    @else
                    <img src="{{ asset('assets/backend/images/error/nopic.jpg') }} " width='20%'>
                    @endif
                    <input type="file" name="image_4" class="inp form-control" accept="image/gif, image/jpeg, image/png">
                    <input type="hidden" name="image_4Old" class="inp form-control" value="{{ $ProductServicesDetail->image_4 }}">
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
