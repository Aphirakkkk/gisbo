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
<div class="card cardboby">
    <div class="card-header bg-transparent border-0">
        <h3 class="mb-0"><i class="fas fa-edit text-warning mr-2"></i>แก้ไขข้อมูล Policy</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('aboutuspolicy.update', $AboutUsPolicy->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="image1Old" value="{{ $AboutUsPolicy->image1 }}">
            <input type="hidden" name="image2Old" value="{{ $AboutUsPolicy->image2 }}">

            <div class="form-group row">
                <label class="col-sm-12 control-label font-weight-bold">ลำดับการแสดงผล</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" name="sort_number" value="{{ $AboutUsPolicy->sort_number }}" min="1">
                </div>
            </div>

            <div class="card bg-secondary p-3 mb-4 border-0">
                <h5 class="text-primary font-weight-bold mb-3"><i class="fas fa-language mr-1"></i>ข้อมูลภาษาไทย (Thai Content)</h5>
                
                <div class="form-group">
                    <label class="font-weight-bold">หัวข้อ Policy ภาษาไทย</label>
                    <input type="text" class="form-control" name="tilte_th" value="{{ $AboutUsPolicy->tilte_th }}" placeholder="กรอกหัวข้อ Policy ภาษาไทย" autocomplete="off">
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">รายละเอียด Policy ภาษาไทย</label>
                    <textarea name="detail_th" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียดเนื้อหา Policy ภาษาไทย">{{ $AboutUsPolicy->detail_th }}</textarea>
                </div>
            </div>

            <div class="card bg-secondary p-3 mb-4 border-0">
                <h5 class="text-primary font-weight-bold mb-3"><i class="fas fa-globe mr-1"></i>ข้อมูลภาษาอังกฤษ (English Content)</h5>
                
                <div class="form-group">
                    <label class="font-weight-bold">หัวข้อ Policy ภาษาอังกฤษ</label>
                    <input type="text" class="form-control" name="tilte_en" value="{{ $AboutUsPolicy->tilte_en }}" placeholder="กรอกหัวข้อ Policy ภาษาอังกฤษ" autocomplete="off">
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">รายละเอียด Policy ภาษาอังกฤษ</label>
                    <textarea name="detail_en" class="form-control CreatedDetailTh" placeholder="กรอกรายละเอียดเนื้อหา Policy ภาษาอังกฤษ">{{ $AboutUsPolicy->detail_en }}</textarea>
                </div>
            </div>

            <div class="card bg-secondary p-3 mb-4 border-0">
                <h5 class="text-primary font-weight-bold mb-3"><i class="fas fa-image mr-1"></i>รูปภาพเอกสารแนบ / ประกาศ (Images Attachment)</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image1"><b>รูปภาพหน้าที่ 1 (Image 1)</b></label>
                            @if($AboutUsPolicy->image1 && $AboutUsPolicy->image1 != 'assets/backend/images/error/nopic.jpg')
                            <div class="mb-2">
                                <img src="{{ asset($AboutUsPolicy->image1) }}" alt="Current Image 1" style="max-height: 140px; border: 1px solid #ddd; padding: 4px; border-radius: 4px;">
                            </div>
                            @endif
                            <input type="file" name="image1" id="image1" class="form-control-file @error('image1') is-invalid @enderror" accept="image/*">
                            <small class="form-text text-muted">เลือกไฟล์ใหม่หากต้องการเปลี่ยนรูปภาพ</small>
                            @error('image1')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image2"><b>รูปภาพหน้าที่ 2 (Image 2)</b></label>
                            @if($AboutUsPolicy->image2 && $AboutUsPolicy->image2 != 'assets/backend/images/error/nopic.jpg')
                            <div class="mb-2">
                                <img src="{{ asset($AboutUsPolicy->image2) }}" alt="Current Image 2" style="max-height: 140px; border: 1px solid #ddd; padding: 4px; border-radius: 4px;">
                            </div>
                            @endif
                            <input type="file" name="image2" id="image2" class="form-control-file @error('image2') is-invalid @enderror" accept="image/*">
                            <small class="form-text text-muted">เลือกไฟล์ใหม่หากต้องการเปลี่ยนรูปภาพ</small>
                            @error('image2')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right mt-4">
                <a href="{{ route('aboutuspolicy.index') }}" class="btn btn-secondary mr-2"><i class="fas fa-arrow-left mr-1"></i>ย้อนกลับ</a>
                <button type="submit" class="btn btn-success"><i class="fas fa-save mr-1"></i>บันทึกการแก้ไข</button>
            </div>
        </form>
    </div>
</div>
@endsection
