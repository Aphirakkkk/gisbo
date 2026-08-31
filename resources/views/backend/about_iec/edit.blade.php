@extends('layouts.backend.sidenav-backend')
@section('css')
<style>
    .cert-preview-box {
        max-width: 260px;
        border: 2px dashed #ddd;
        padding: 6px;
        border-radius: 8px;
        background: #fafafa;
        margin-bottom: 12px;
        text-align: center;
    }
    .cert-preview-img {
        max-width: 100%;
        max-height: 320px;
        object-fit: contain;
        border-radius: 4px;
    }
</style>
@endsection

@section('content')
<div class="card cardboby">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-edit mr-2"></i>{{ $titlePage }}
        </h3>
    </div>
    <div class="card-body">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('aboutusiec.update', $AboutUsIEC->id) }}">
            @csrf
            @method('PATCH')

            <input type="hidden" name="id" value="{{ $AboutUsIEC->id }}">
            <input type="hidden" name="active_status" value="{{ $AboutUsIEC->active_status ?? 1 }}">
            <input type="hidden" name="display_status" value="{{ $AboutUsIEC->display_status ?? 1 }}">

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">ลำดับการแสดงผล</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" name="sort_number" value="{{ $AboutUsIEC->sort_number }}" min="1">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label font-weight-bold">
                            รูปภาพใบรับรอง ISO / IEC 27001 (หน้าที่ 1)
                        </label>
                        <div class="cert-preview-box">
                            @if($AboutUsIEC->image1 && $AboutUsIEC->image1 != 'Unknown' && $AboutUsIEC->image1 != 'assets/backend/images/error/nopic.jpg')
                            <img id="preview1" src="{{ asset($AboutUsIEC->image1) }}" alt="Preview 1" class="cert-preview-img">
                            @else
                            <img id="preview1" src="{{ asset('assets/backend/images/error/nopic.jpg') }}" alt="Preview 1" class="cert-preview-img">
                            @endif
                        </div>
                        <input type="file" name="image1" id="file1" class="form-control" accept="image/*">
                        <input type="hidden" name="image1Old" value="{{ $AboutUsIEC->image1 }}">
                        <small class="text-muted">หากไม่ต้องการเปลี่ยนรูปภาพ ไม่ต้องเลือกไฟล์ใหม่</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label font-weight-bold">
                            รูปภาพใบรับรอง ISO / IEC 27001 (หน้าที่ 2 - ถ้ามี)
                        </label>
                        <div class="cert-preview-box">
                            @if($AboutUsIEC->image2 && $AboutUsIEC->image2 != 'Unknown' && $AboutUsIEC->image2 != 'assets/backend/images/error/nopic.jpg')
                            <img id="preview2" src="{{ asset($AboutUsIEC->image2) }}" alt="Preview 2" class="cert-preview-img">
                            @else
                            <img id="preview2" src="{{ asset('assets/backend/images/error/nopic.jpg') }}" alt="Preview 2" class="cert-preview-img">
                            @endif
                        </div>
                        <input type="file" name="image2" id="file2" class="form-control" accept="image/*">
                        <input type="hidden" name="image2Old" value="{{ $AboutUsIEC->image2 }}">
                        <small class="text-muted">หากไม่ต้องการเปลี่ยนรูปภาพ ไม่ต้องเลือกไฟล์ใหม่</small>
                    </div>
                </div>
            </div>

            <hr>
            <div class="text-center form-group">
                <a class="btn btn-outline-danger mr-2" role="button" href="{{ route('aboutusiec.index') }}">ยกเลิก</a>
                <button class="btn btn-primary" type="submit"><i class="fas fa-save mr-1"></i>ยืนยันข้อมูล</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script>
    function setupPreview(inputSelector, imgSelector) {
        $(inputSelector).on('change', function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(imgSelector).attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    $(document).ready(function () {
        setupPreview('#file1', '#preview1');
        setupPreview('#file2', '#preview2');
    });
</script>
@endsection
