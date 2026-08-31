@extends('layouts.backend.sidenav-backend')
@section('css')
<style>
    .achieve-thumb {
        width: 65px;
        height: 48px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #dee2e6;
    }
    .table td, .table th {
        vertical-align: middle;
    }
</style>
@endsection

@section('content')
<div class="card cardboby">
    <form action="{{ route('aboutusachievement.index') }}" method="GET" onsubmit="return checkdate()">
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <i class="fas fa-search"></i> <label for="search"><b>ค้นหาหัวข้อ</b></label>
                        <input id="search" name="search" autocomplete="off" value="{{ request('search') }}" type="text" class="form-control" placeholder="ค้นหาหัวข้อภาษาไทย หรืออังกฤษ...">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <i class="far fa-calendar-alt"></i> <label for="datepicker_start"><b>วันเริ่มต้น</b></label>
                        <input id="datepicker_start" name="startd_at" autocomplete="off" value="{{ request('startd_at') }}" type="text" class="form-control" placeholder="YYYY-MM-DD">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <i class="far fa-calendar-alt"></i> <label for="datepicker_end"><b>วันสิ้นสุด</b></label>
                        <input id="datepicker_end" name="ended_at" autocomplete="off" value="{{ request('ended_at') }}" type="text" class="form-control" placeholder="YYYY-MM-DD">
                    </div>
                </div>
                <div class="col-md-2">
                    <br />
                    <button type="submit" class="mt-2 ml-0 btn w-100 btn-primary"><i class="fas fa-search mr-1"></i>ค้นหา</button>
                </div>
                <div class="text-right col-md-2">
                    <br />
                    <a class="mt-2 ml-0 btn w-100 btn-outline-success" href="{{ route('aboutusachievement.create') }}"><i class="fas fa-plus mr-1"></i>เพิ่มข้อมูล</a>
                </div>
            </div>
        </div>
    </form>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-items-center no-wrap">
                <thead>
                    <tr class="text-center">
                        <th width="5%">#</th>
                        <th width="10%">รูปภาพหลัก</th>
                        <th width="45%">หัวข้อ AboutUs Achievement (TH / EN)</th>
                        <th width="15%">วันที่บันทึก</th>
                        <th width="8%">ลำดับ</th>
                        <th width="17%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($AboutUsAchievementMain as $key => $data)
                    <tr class="text-center">
                        <td class="font-weight-bold">{{ $AboutUsAchievementMain->firstItem() + $key }}</td>
                        <td>
                            @if($data->image_main && $data->image_main != 'Unknown' && $data->image_main != 'assets/backend/images/error/nopic.jpg')
                            <img src="{{ asset($data->image_main) }}" alt="achievement" class="achieve-thumb shadow-sm">
                            @else
                            <img src="{{ asset('assets/backend/images/error/nopic.jpg') }}" alt="no image" class="achieve-thumb shadow-sm">
                            @endif
                        </td>
                        <td class="text-left">
                            <div class="font-weight-bold text-dark">{!! $data->tilte_th ?: '-' !!}</div>
                            <small class="text-muted">{!! $data->tilte_en ?: '-' !!}</small>
                        </td>
                        <td class="text-muted">
                            {{ $data->aboutUsAchievementDetail->date ?? ($data->created_at ? $data->created_at->format('Y-m-d') : '-') }}
                        </td>
                        <td>
                            <span class="badge badge-pill badge-info px-3 py-1 font-weight-bold">{{ $data->sort_number }}</span>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-outline-warning mr-1" href="{{ route('aboutusachievement.edit', $data->id) }}">
                                <i class="fas fa-edit mr-1"></i>แก้ไข
                            </a>

                            <form action="{{ route('aboutusachievement.destroy', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูล {{ strip_tags($data->tilte_th) }}?');">
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
                            ไม่พบข้อมูลความสำเร็จ / รางวัล
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer py-3 d-flex justify-content-between align-items-center bg-transparent border-0">
        <div class="text-muted small">
            แสดง {{ $AboutUsAchievementMain->firstItem() ?? 0 }} ถึง {{ $AboutUsAchievementMain->lastItem() ?? 0 }} จากทั้งหมด {{ $AboutUsAchievementMain->total() }} รายการ
        </div>
        <div>
            {{ $AboutUsAchievementMain->withQueryString()->links('pagination::bootstrap-4') }}
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
