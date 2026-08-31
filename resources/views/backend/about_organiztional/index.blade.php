@extends('layouts.backend.sidenav-backend')
@section('css')
<style>
    .person-thumb {
        width: 50px;
        height: 65px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
</style>
@endsection
@section('content')

<div class="card cardboby">
    <div class="card-header bg-transparent border-0 pb-0">
        <h3 class="mb-0 font-weight-bold text-primary">
            <i class="fas fa-sitemap mr-2"></i>{{ $titlePage }}
        </h3>
    </div>
    <form action="{{ route('aboutusorganiztionalstructure.index') }}" method="GET" onsubmit="return checkdate()">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group mb-2">
                        <i class="fas fa-search"></i> <label for="search"><b>ค้นหาชื่อ หรือตำแหน่ง</b></label>
                        <input id="search" name="search" autocomplete="off" value="{{ request('search') }}" type="text" class="form-control" placeholder="พิมพ์ชื่อ-นามสกุล หรือตำแหน่ง...">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-2">
                        <i class="far fa-calendar-alt"></i> <label for="datepicker_start"><b>วันเริ่มต้น</b></label>
                        <input id="datepicker_start" name="startd_at" autocomplete="off" value="{{ request('startd_at') }}" type="text" class="form-control" placeholder="YYYY-MM-DD">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-2">
                        <i class="far fa-calendar-alt"></i> <label for="datepicker_end"><b>วันสิ้นสุด</b></label>
                        <input id="datepicker_end" name="ended_at" autocomplete="off" value="{{ request('ended_at') }}" type="text" class="form-control" placeholder="YYYY-MM-DD">
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-end mb-2">
                    <button type="submit" class="btn btn-primary mr-1 flex-grow-1"><i class="fas fa-search mr-1"></i>ค้นหา</button>
                    @if(request('search') || request('startd_at') || request('ended_at'))
                    <a href="{{ route('aboutusorganiztionalstructure.index') }}" class="btn btn-outline-secondary mr-1"><i class="fas fa-undo mr-1"></i>ล้าง</a>
                    @endif
                    <a class="btn btn-success flex-grow-1" href="{{ route('aboutusorganiztionalstructure.create') }}"><i class="fas fa-plus mr-1"></i>เพิ่มข้อมูล</a>
                </div>
            </div>
        </div>
    </form>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-items-center table-hover">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th width="5%">#</th>
                        <th width="10%">รูปภาพ</th>
                        <th width="25%">ชื่อ-นามสกุล (TH / EN)</th>
                        <th width="25%">ตำแหน่ง (TH / EN)</th>
                        <th width="10%">ลำดับ</th>
                        <th width="15%">จัดการ (Action)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($AboutUsOrganiztional as $key => $data)
                    <tr class="text-center">
                        <td class="align-middle font-weight-bold">{{ $AboutUsOrganiztional->firstItem() + $key }}</td>
                        <td class="align-middle">
                            @if($data->image_main && $data->image_main != 'assets/backend/images/error/nopic.jpg')
                            <img src="{{ asset($data->image_main) }}" alt="person" class="person-thumb shadow-sm">
                            @else
                            <img src="{{ asset('assets/backend/images/error/nopic.jpg') }}" alt="no image" class="person-thumb shadow-sm">
                            @endif
                        </td>
                        <td class="text-left align-middle">
                            <div class="font-weight-bold text-dark">{{ $data->full_name_th ?: '-' }}</div>
                            <small class="text-muted">{{ $data->full_name_en ?: '-' }}</small>
                        </td>
                        <td class="text-left align-middle">
                            <div class="font-weight-600 text-primary">{{ $data->position_th ?: '-' }}</div>
                            <small class="text-muted">{{ $data->position_en ?: '-' }}</small>
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-pill badge-info px-3 py-2 font-weight-bold">{{ $data->sort_number }}</span>
                        </td>
                        <td class="align-middle">
                            <a class="btn btn-sm btn-outline-warning mr-1" href="{{ route('aboutusorganiztionalstructure.edit', $data->id) }}">
                                <i class="fas fa-edit mr-1"></i>แก้ไข
                            </a>

                            <form action="{{ route('aboutusorganiztionalstructure.destroy', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลคุณ {{ $data->full_name_th }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash-alt mr-1"></i>ลบ
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                            ไม่พบข้อมูลโครงสร้างองค์กร
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-end">
            {{ $AboutUsOrganiztional->withQueryString()->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    $(document).ready(function () {
        $("#datepicker_start").datepicker({
            dateFormat: "yy-mm-dd",
            changeYear: true
        });
        $("#datepicker_end").datepicker({
            dateFormat: "yy-mm-dd",
            changeYear: true
        });
    });

    function checkdate(){
        var startdate = $("#datepicker_start").val();
        var enddate = $("#datepicker_end").val();
        if(startdate && enddate){
            let num_start = parseInt(startdate.replace(/-/g, ""));
            let num_end = parseInt(enddate.replace(/-/g, ""));
            if(num_start > num_end){
                Swal.fire({
                    icon: 'error',
                    title: 'กรอกข้อมูลผิด',
                    text: 'กรุณาตรวจสอบวันเริ่มต้นและวันสิ้นสุดให้ถูกต้อง',
                });
                return false;
            }
        }
    }
</script>
@endsection
