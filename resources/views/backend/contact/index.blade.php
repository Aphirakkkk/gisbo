@extends('layouts.backend.sidenav-backend')
@section('css')

@endsection
@section('content')

<div class="card cardboby">
    <form action="{{ route('contact.index') }}" method="GET" onsubmit="return checkdate()">
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <i class="fas fa-search"></i> <label for="search"><b>ค้นหาชื่อ-นามสกุล</b></label>
                        <input id="search" name="search" autocomplete="off" value="{{app('request')->input('search')}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <i class="far fa-calendar-alt"></i> <label for="datepicker_start"><b>วันเริ่มต้น</b></label>
                    <input id="datepicker_start" name="startd_at" autocomplete="off" value="{{app('request')->input('startd_at')}}" type="text" class="form-control">
                </div>
                <div class="col-md-2">
                    <i class="far fa-calendar-alt"></i> <label for="datepicker_end"><b>วันสิ้นสุด</b></label>
                    <input id="datepicker_end" name="ended_at" autocomplete="off" value="{{app('request')->input('ended_at')}}" type="text" class="form-control">
                </div>
                <div class="col-md-2">
                    <br />
                    <button type="Submit" class="mt-2 ml-0 btn w-100 btn-primary">ค้นหา</button>
                </div>
            </div>
        </div>
    </form>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example" class="table table-dark table-bordered table-striped no-wrap responsive">
            <thead>
                <tr class="text-center" width="100%">
                    <th width="5%">#</th>
                    <th width="75%">ข้อมูลผู้ติดต่อ</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ContactUs as $key => $data)
                @php
                $keysOnclick = $ContactUs->firstItem() + $key;
                @endphp
                <tr class="text-center" width="100%">
                    <th>{{ $ContactUs->firstItem() + $key }}</th>
                    <th>ชื่อ - นามสกุล : <b>{{$data->full_name ?? '-'}}</b></th>
                    <th width="20%">
                        @if ($data->active_status == 1)
                        <a href="{{url('/contact' . '/' . $data->id)}}">รอติดต่อกลับ</a>
                        @else
                        <a href="{{url('/contact' . '/' . $data->id)}}">ติดต่อกลับแล้ว (กดดูรายละเอียด)</a>
                        @endif
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <ul class="mr-3 justify-content-end pagination pagination-primary flex_row-center wrap ">
        {{ $ContactUs->onEachSide(0)->withQueryString()->links() }}
    </ul>
</div>
@endsection
@section('javascript')
<script>
    // alert(window.location);
    $(document).ready( function () {
        $('#order_name').on('change', function() {
            // window.location.href=window.location+"&order_name="+this.value;
            if(window.location.search){
                window.location.href=window.location+"&order_name="+this.value;
            } else {
                window.location.href=window.location+"?order_name="+this.value;
            }
        });
        $( "#datepicker_start" ).datepicker({
            dateFormat: "yy-mm-dd",
            changeYear: true
        });
        $( "#datepicker_end" ).datepicker({
            dateFormat: "yy-mm-dd",
            changeYear: true
        });
    });
    function checkdate(){
        var startdate =$( "#datepicker_start" ).val();
        var enddate =$( "#datepicker_end" ).val();
        if(enddate !== null){
            let num_start = parseInt(startdate.replace(/-/g, ""));
            let num_end = parseInt(enddate.replace(/-/g, ""))
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
