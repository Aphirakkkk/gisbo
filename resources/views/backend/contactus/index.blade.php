@extends('layouts.backend.sidenav-backend')
@section('css')

@endsection
@section('content')

<div class="card cardboby">
    <form action="{{ route('contactus.index') }}" method="GET" onsubmit="return checkdate()">
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-md-4">
                    <i class="far fa-calendar-alt"></i> <label for="datepicker_start"><b>วันเริ่มต้น</b></label>
                    <input id="datepicker_start" name="startd_at" autocomplete="off" value="{{app('request')->input('startd_at')}}" type="text" class="form-control">
                </div>
                <div class="col-md-4">
                    <i class="far fa-calendar-alt"></i> <label for="datepicker_end"><b>วันสิ้นสุด</b></label>
                    <input id="datepicker_end" name="ended_at" autocomplete="off" value="{{app('request')->input('ended_at')}}" type="text" class="form-control">
                </div>
                <div class="col-md-2">
                    <br />
                    <button type="Submit" class="mt-2 ml-0 btn w-100 btn-primary">ค้นหา</button>
                </div>
                <div class="text-right col-md-2">
                    <br />
                    <a class="mt-2 ml-0 btn w-100 btn-outline-success" href="{{ route('contactus.create') }}">เพิ่มข้อมูล</a>
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
                    <th width="65%">รูป Contact</th>
                    <th width="30%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Contact as $key => $data)
                @php
                $keysOnclick = $Contact->firstItem() + $key;
                @endphp
                <tr class="text-center" width="100%">
                    <th>{{ $Contact->firstItem() + $key }}</th>
                    <th><img width='20%' src="{{ asset($data->image_main) }}"></th>
                    <th width="20%">
                        {{-- <a class="btn btn-sm btn-outline-info" href="{{url('/contactus' . '/' . $data->id)}}">รายละเอียด</a> --}}
                        <a class="btn btn-sm btn-outline-warning" href="{{url('/contactus' . '/' . $data->id . '/' . 'edit')}}">แก้ไข</a>
                        <button class='btn btn-sm btn-outline-danger' onclick="updateDelete({{$keysOnclick}},{{$data->id}})">ลบ</button>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <ul class="mr-3 justify-content-end pagination pagination-primary flex_row-center wrap ">
        {{ $Contact->onEachSide(0)->withQueryString()->links() }}
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

{{-- @*updateHiddenDisplay*@ --}}
<script language="javascript">
    function updateHiddenDisplay(row, id) {
            Swal.fire({
                title: 'คุณแน่ใจที่ยกเลิกการแสดงข้อมูล ?',
                text: "คุณกำลังทำการยกเลิกการแสดงข้อมูล  !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: '/contactus/updateHiddenDisplay',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status = "200") {
                                location.reload();
                            }
                        }
                    });
                }
            })
        }

</script>

{{-- @*updateShowDisplay*@ --}}
<script language="javascript">
    function updateShowDisplay(row, id) {
            Swal.fire({
                title: 'คุณแน่ใจที่แสดงข้อมูล ?',
                text: "คุณกำลังทำการแสดงข้อมูลอีกครั้ง  !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: '/contactus/updateShowDisplay',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status = "200") {
                                location.reload();
                            }
                        }
                    });
                }
            })
        }

</script>

{{-- @*updateDelete*@ --}}
<script language="javascript">
    function updateDelete(row, id) {
            Swal.fire({
                title: 'คุณแน่ใจที่จะลบข้อมูล ?',
                text: "คุณกำลังทำการลบข้อมูล  !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                     type:"POST",
                     url:'/contactus/updateDelete',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.status = "200") {
                                location.reload();
                            }
                        },
                        error:function(error){
                            alert(error.error);
                        }
                    });

                }
            })
        }

</script>


@endsection
