@extends('layouts.backend.sidenav-backend')
@section('css')
<style>

</style>
@endsection

@section('content')
<!-- Form Element sizes -->
<div class="card cardboby card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-edit"></i>
            {{ $titlePage ?? 'ไม่ระบุ'  }}
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th width="100%">{{ $titlePage ?? 'ไม่ระบุ'  }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left" scope="col" width="100%">ชื่อ - นามสกุล : <b>{{ $ContactUs->full_name ?? 'ไม่ระบุ'  }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-left" scope="col" width="100%">Email : <b>{{ $ContactUs->email ?? 'ไม่ระบุ'  }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-left" scope="col" width="100%">เบอร์โทรศัพท์ : <b>{{ $ContactUs->telephone ?? 'ไม่ระบุ'  }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-left" scope="col" width="100%">รายละเอียดการติดต่อ : <b>{{ $ContactUs->details ?? 'ไม่ระบุ'  }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-left" scope="col" width="100%">สถานะการใช้งาน :
                            <b>
                                @if($ContactUs->active_status == 1)
                                รอติดต่อกลับ
                                @else
                                ติดต่อกลับแล้ว
                                @endif
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left" scope="col" width="100%">วันที่ติดต่อ : <b>{{ $ContactUs->created_at ?? 'ไม่ระบุ'  }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-left" scope="col" width="100%">วันที่ติดต่อกลับ: <b>{{ $ContactUs->updated_at ?? 'ไม่ระบุ'  }}</b></td>
                    </tr>
                </tbody>
            </table>
            <br>
        </div>
        <hr>

        @if($ContactUs->active_status == 1)
        <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('contact.update', [$ContactUs->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{ Form::hidden('id', $ContactUs->id, ['class' => 'form-control']) }}
            <div class="form-group text-center ">
                <a class="btn btn-outline-danger" role="button" href="{{ route('contact.index')  }}">ย้อนกลับ</a>
                <input class="btn btn-outline-primary" type="submit" value="ยืนยันการติดต่อกลับ"></button>
            </div>
        </form>
        @endif
        @if($ContactUs->active_status == 6)
        <div class="form-group text-center ">
            <a class="btn btn-outline-danger" role="button" href="{{ route('contact.index')  }}">ย้อนกลับ</a>
        </div>
        @endif
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@endsection


@section('javascript')
<script>
    $('.inSummernote').summernote('disable');
</script>
@endsection
