<div class="row align-items-center no-gutters">
    <div class="col-lg-12">
        <nav class="navbar navbar-expand navbar-maintop">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark bg-white  pt-3 mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                @if($titlePage)
                <li class="breadcrumb-item active"><a href="#">{{ $titlePage ?? '' }}</a></li>
                @endif
                @if($DataTimeThaiFull)
                <span class="titlePage">&nbsp;&nbsp;{{ $DataTimeThaiFull ?? '' }}</span>
                @endif
                {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Default</li> --}}
            </ol>
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <div class="name-wrap">
                        <span class="name pr-4">
                            {{ Auth::user()->fullname }}<br>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('ออกจากระบบ') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </span>
                        <div class="avatar">
                            <a class="" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('assets/backend/images/cms/avatar.png') }}" class="img-fluid" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#!" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>My profile</span>
                                </a>
                                <a href="#!" class="dropdown-item">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span>Settings</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
