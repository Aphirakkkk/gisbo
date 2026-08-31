<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-dark bg-teal" id="sidenav-main" style="background-color: #1a365d !important;">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header align-items-center" style="background-color: #102a4e;">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/frontend/img/logo.png') }}" class="navbar-brand-img" alt="Logo" style="max-height: 2.5rem;">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('เข้าสู่ระบบ') }}</a>
                    </li>
                    @endguest

                    {{-- หน้าหลัก --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">{{ __('หน้าหลัก (Dashboard)') }}</span>
                        </a>
                    </li>

                    {{-- Menu Main --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('menu.*') ? 'active' : '' }}" href="{{ route('menu.index') }}">
                            <i class="fas fa-bars text-yellow"></i>
                            <span class="nav-link-text">{{ __('Menu Main') }}</span>
                        </a>
                    </li>

                    {{-- Banner --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('banner.*') ? 'active' : '' }}" href="{{ route('banner.index') }}">
                            <i class="fas fa-image text-info"></i>
                            <span class="nav-link-text">{{ __('Banner') }}</span>
                        </a>
                    </li>

                    <!-- Divider -->
                    <hr class="my-3" style="border-top: 1px solid rgba(255, 255, 255, 0.15);">
                    <h6 class="navbar-heading p-0 text-muted" style="color: #93c5fd !important; padding-left: 1.5rem !important; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">
                        <span>หมวดหมู่ About Us</span>
                    </h6>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutus.*') ? 'active' : '' }}" href="{{ route('aboutus.index') }}">
                            <i class="fas fa-home text-white"></i>
                            <span class="nav-link-text">{{ __('About - หน้า Home') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutusdetail.*') ? 'active' : '' }}" href="{{ route('aboutusdetail.index') }}">
                            <i class="fas fa-info-circle text-white"></i>
                            <span class="nav-link-text">{{ __('About - หน้า Detail') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutusorganiztionalstructure.*') ? 'active' : '' }}" href="{{ route('aboutusorganiztionalstructure.index') }}">
                            <i class="fas fa-sitemap text-white"></i>
                            <span class="nav-link-text">{{ __('About - โครงสร้างองค์กร') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutusethics.*') ? 'active' : '' }}" href="{{ route('aboutusethics.index') }}">
                            <i class="fas fa-balance-scale text-white"></i>
                            <span class="nav-link-text">{{ __('About - จริยธรรม (Ethics)') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutusvalues.*') ? 'active' : '' }}" href="{{ route('aboutusvalues.index') }}">
                            <i class="fas fa-gem text-white"></i>
                            <span class="nav-link-text">{{ __('About - ค่านิยม (Values)') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutus9001.*') ? 'active' : '' }}" href="{{ route('aboutus9001.index') }}">
                            <i class="fas fa-certificate text-white"></i>
                            <span class="nav-link-text">{{ __('About - ISO 9001') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutus45001.*') ? 'active' : '' }}" href="{{ route('aboutus45001.index') }}">
                            <i class="fas fa-shield-alt text-white"></i>
                            <span class="nav-link-text">{{ __('About - ISO 45001') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutusiec.*') ? 'active' : '' }}" href="{{ route('aboutusiec.index') }}">
                            <i class="fas fa-lock text-white"></i>
                            <span class="nav-link-text">{{ __('About - ISO / IEC 27001') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutusachievement.*') ? 'active' : '' }}" href="{{ route('aboutusachievement.index') }}">
                            <i class="fas fa-trophy text-white"></i>
                            <span class="nav-link-text">{{ __('About - ความสำเร็จ / รางวัล') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutuswhychoose.*') ? 'active' : '' }}" href="{{ route('aboutuswhychoose.index') }}">
                            <i class="fas fa-check-circle text-white"></i>
                            <span class="nav-link-text">{{ __('About - ทำไมต้องเลือกเรา') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutuspolicy.*') ? 'active' : '' }}" href="{{ route('aboutuspolicy.index') }}">
                            <i class="fas fa-file-contract text-white"></i>
                            <span class="nav-link-text">{{ __('About - Policy') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutuscarbon.*') ? 'active' : '' }}" href="{{ route('aboutuscarbon.index') }}">
                            <i class="fas fa-leaf text-white"></i>
                            <span class="nav-link-text">{{ __('About - Carbon Footprint') }}</span>
                        </a>
                    </li>

                    <!-- Divider -->
                    <hr class="my-3" style="border-top: 1px solid rgba(255, 255, 255, 0.15);">
                    <h6 class="navbar-heading p-0 text-muted" style="color: #93c5fd !important; padding-left: 1.5rem !important; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">
                        <span>หมวดหมู่ Our Business</span>
                    </h6>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('businesstype.*') ? 'active' : '' }}" href="{{ route('businesstype.index') }}">
                            <i class="fas fa-layer-group text-white"></i>
                            <span class="nav-link-text">{{ __('Business - จัดการ Type') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('businesshome.*') ? 'active' : '' }}" href="{{ route('businesshome.index') }}">
                            <i class="fas fa-home text-white"></i>
                            <span class="nav-link-text">{{ __('Business - หน้า Home') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('businessdetail.*') ? 'active' : '' }}" href="{{ route('businessdetail.index') }}">
                            <i class="fas fa-file-alt text-white"></i>
                            <span class="nav-link-text">{{ __('Business - หน้า Detail') }}</span>
                        </a>
                    </li>

                    <!-- Divider -->
                    <hr class="my-3" style="border-top: 1px solid rgba(255, 255, 255, 0.15);">
                    <h6 class="navbar-heading p-0 text-muted" style="color: #93c5fd !important; padding-left: 1.5rem !important; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">
                        <span>Products & Services</span>
                    </h6>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('productserviceshome.*') ? 'active' : '' }}" href="{{ route('productserviceshome.index') }}">
                            <i class="fas fa-box-open text-white"></i>
                            <span class="nav-link-text">{{ __('Products - หน้า Home') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('productservicesdetail.*') ? 'active' : '' }}" href="{{ route('productservicesdetail.index') }}">
                            <i class="fas fa-boxes text-white"></i>
                            <span class="nav-link-text">{{ __('Products - หน้า Detail') }}</span>
                        </a>
                    </li>

                    <!-- Divider -->
                    <hr class="my-3" style="border-top: 1px solid rgba(255, 255, 255, 0.15);">
                    <h6 class="navbar-heading p-0 text-muted" style="color: #93c5fd !important; padding-left: 1.5rem !important; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">
                        <span>Projects Reference</span>
                    </h6>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('projectsreferencetype.*') ? 'active' : '' }}" href="{{ route('projectsreferencetype.index') }}">
                            <i class="fas fa-tags text-white"></i>
                            <span class="nav-link-text">{{ __('Projects - จัดการ Type') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('projectsreferencemain.*') ? 'active' : '' }}" href="{{ route('projectsreferencemain.index') }}">
                            <i class="fas fa-building text-white"></i>
                            <span class="nav-link-text">{{ __('Projects - จัดการผลงาน') }}</span>
                        </a>
                    </li>

                    <!-- Divider -->
                    <hr class="my-3" style="border-top: 1px solid rgba(255, 255, 255, 0.15);">
                    <h6 class="navbar-heading p-0 text-muted" style="color: #93c5fd !important; padding-left: 1.5rem !important; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">
                        <span>News & Events</span>
                    </h6>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('neweventsmain.*') ? 'active' : '' }}" href="{{ route('neweventsmain.index') }}">
                            <i class="fas fa-newspaper text-white"></i>
                            <span class="nav-link-text">{{ __('จัดการข่าวสารและกิจกรรม') }}</span>
                        </a>
                    </li>

                    <!-- Divider -->
                    <hr class="my-3" style="border-top: 1px solid rgba(255, 255, 255, 0.15);">
                    <h6 class="navbar-heading p-0 text-muted" style="color: #93c5fd !important; padding-left: 1.5rem !important; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">
                        <span>Career & Contact</span>
                    </h6>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('careermain.*') ? 'active' : '' }}" href="{{ route('careermain.index') }}">
                            <i class="fas fa-briefcase text-white"></i>
                            <span class="nav-link-text">{{ __('Career - หัวข้อหลัก') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('careerdetail.*') ? 'active' : '' }}" href="{{ route('careerdetail.index') }}">
                            <i class="fas fa-user-plus text-white"></i>
                            <span class="nav-link-text">{{ __('Career - รายละเอียดงาน') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contactus.index') ? 'active' : '' }}" href="{{ route('contactus.index') }}">
                            <i class="fas fa-camera text-white"></i>
                            <span class="nav-link-text">{{ __('Contact Us - รูปภาพ') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact.index') ? 'active' : '' }}" href="{{ route('contact.index') }}">
                            <i class="fas fa-envelope text-white"></i>
                            <span class="nav-link-text">{{ __('Contact Us - ข้อความติดต่อ') }}</span>
                        </a>
                    </li>

                    <!-- Divider -->
                    <hr class="my-3" style="border-top: 1px solid rgba(255, 255, 255, 0.15);">
                    <h6 class="navbar-heading p-0 text-muted" style="color: #93c5fd !important; padding-left: 1.5rem !important; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">
                        <span>ตั้งค่าระบบ</span>
                    </h6>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}" href="{{ route('user.index') }}">
                            <i class="fas fa-users-cog text-white"></i>
                            <span class="nav-link-text">{{ __('จัดการบัญชีผู้ใช้งาน') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('footer.*') ? 'active' : '' }}" href="{{ route('footer.index') }}">
                            <i class="fas fa-shoe-prints text-white"></i>
                            <span class="nav-link-text">{{ __('จัดการข้อมูล Footer (ส่วนท้ายเว็บ)') }}</span>
                        </a>
                    </li>
                </ul>
                <div style="height: 120px;"></div>
            </div>
        </div>
    </div>
</nav>
