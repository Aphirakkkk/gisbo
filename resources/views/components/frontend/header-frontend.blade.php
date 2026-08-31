<div class="header sty2">

    <a class="logo" href="/">

        <img class="write" src="{{ asset('assets/frontend/img/logo.png') }}" alt="logo write" style="opacity: 1" />

    </a>

    @if(Config::get('app.locale') == 'en')

    <div class="headMenu ani300" id="headMenu">

        <a data-menuanchor="firstPage" class="ani300 active d-none" href="/#banner">

            <span class="txt txt2"><span>About<br />GIS Group</span></span>

        </a>

        <a data-menuanchor="secondPage" class="ani300 " href="/#about">

            <span class="txt txt2"><span>{!! $Menu1->tilte_en !!}</span></span>

        </a>

        <a data-menuanchor="3Page" class="ani300" href="/#our_business">

            <span class="txt txt2"><span>{!! $Menu2->tilte_en !!}</span></span>

        </a>

        <a data-menuanchor="4Page" class="ani300" href="/#pdandservice">

            <span class="txt txt2"><span>{!! $Menu3->tilte_en !!}</span></span>

        </a>

        <a data-menuanchor="5Page" class="ani300" href="/#projectref">

            <span class="txt txt2"><span>{!! $Menu4->tilte_en !!}</span></span>

        </a>

        <a data-menuanchor="6Page" class="ani300" href="/#news">

            <span class="txt txt2"><span>{!! $Menu5->tilte_en !!}</span></span>

        </a>

        <a data-menuanchor="7Page" class="ani300" href="/#career">

            <span class="txt txt2"><span>{!! $Menu6->tilte_en !!}</span></span>

        </a>

        <a data-menuanchor="8Page" class="ani300" href="/#map-contact">

            <span class="txt txt2"><span>{!! $Menu7->tilte_en !!}</span></span>

        </a>

    </div>

    @else

    <div class="headMenu ani300" id="headMenu">

        <a data-menuanchor="firstPage" class="ani300 active d-none" href="/#banner">

            <span class="txt txt2"><span>About<br />GIS Group</span></span>

        </a>

        <a data-menuanchor="secondPage" class="ani300 " href="/#about">

            <span class="txt txt2"><span>{!! $Menu1->tilte_th !!}</span></span>

        </a>

        <a data-menuanchor="3Page" class="ani300" href="/#our_business">

            <span class="txt txt2"><span>{!! $Menu2->tilte_th !!}</span></span>

        </a>

        <a data-menuanchor="4Page" class="ani300" href="/#pdandservice">

            <span class="txt txt2"><span>{!! $Menu3->tilte_th !!}</span></span>

        </a>

        <a data-menuanchor="5Page" class="ani300" href="/#projectref">

            <span class="txt txt2"><span>{!! $Menu4->tilte_th !!}</span></span>

        </a>

        <a data-menuanchor="6Page" class="ani300" href="/#news">

            <span class="txt txt2"><span>{!! $Menu5->tilte_th !!}</span></span>

        </a>

        <a data-menuanchor="7Page" class="ani300" href="/#career">

            <span class="txt txt2"><span>{!! $Menu6->tilte_th !!}</span></span>

        </a>

        <a data-menuanchor="8Page" class="ani300" href="/#map-contact">

            <span class="txt txt2"><span>{!! $Menu7->tilte_th !!}</span></span>

        </a>

    </div>

    @endif

</div>

{{-- ปุ่มไอคอนขวาบน --}}
<div style="position: fixed; top: 10px; right: 15px; z-index: 99999; display: flex; flex-direction: row; align-items: center; gap: 6px;">

    {{-- Home --}}
    <a href="/" title="Home" style="display:flex; align-items:center; justify-content:center; width:42px; height:42px; background:#fff; border-radius:6px; box-shadow:0 2px 6px rgba(0,0,0,.25); text-decoration:none; cursor:pointer;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
    </a>

    {{-- Language --}}
    @if(Config::get('app.locale') == 'en')
    <a href="{{ URL::to('change/th') }}" title="ภาษาไทย" style="display:flex; align-items:center; justify-content:center; width:42px; height:42px; background:#fff; border-radius:6px; box-shadow:0 2px 6px rgba(0,0,0,.25); text-decoration:none; cursor:pointer; font-size:12px; font-weight:700; color:#555; letter-spacing:0.5px; font-family:Arial,sans-serif;">EN</a>
    @else
    <a href="{{ URL::to('change/en') }}" title="English" style="display:flex; align-items:center; justify-content:center; width:42px; height:42px; background:#fff; border-radius:6px; box-shadow:0 2px 6px rgba(0,0,0,.25); text-decoration:none; cursor:pointer; font-size:12px; font-weight:700; color:#555; letter-spacing:0.5px; font-family:Arial,sans-serif;">TH</a>
    @endif

    {{-- Sitemap --}}
    <a href="javascript:void(0);" onclick="myFunction()" title="Sitemap" style="display:flex; align-items:center; justify-content:center; width:42px; height:42px; background:#fff; border-radius:6px; box-shadow:0 2px 6px rgba(0,0,0,.25); text-decoration:none; cursor:pointer;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="6" x2="21" y2="6"/>
            <line x1="3" y1="12" x2="21" y2="12"/>
            <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
    </a>

</div>





<div id="showsitemap">

    <div class="subsitemap">

        <ul>

            <li><a href="/about-detail">About Us</a></li>

            <li><a href="/about_ethics-detail">Ethics</a></li>

            <li><a href="/about_values-detail">Values</a></li>

            <li><a href="/about_9001-detail">ISO 9001</a></li>

            <li><a href="/about_45001-detail">ISO 45001</a></li>

            <li><a href="/about_iec-detail">ISO / IEC 27001</a></li>

            <li><a href="/about_why-detail">Why Choose</a></li>

            <li><a href="/about_organiztional-detail">Organizational Structure</a></li>

            <li><a href="/about_achievement-detail">Achievement</a></li>

            <li><a href="/our_businessHome">Our Business</a></li>

            <li><a href="/pdandserviceHome">Products & Services</a></li>

            <li><a href="/projectrefHome">Projects Reference</a></li>

            <li><a href="/newsHome">News & Events</a></li>

            <li><a href="/careerHome">Career</a></li>

            <li><a href="/about_policy">Policy</a></li>

            <li><a href="/about_carbon-detail">Carbon Footprint</a></li>

        </ul>

    </div>

    <div class="subsitemap">

        <ul>

            <li><a href="/business-epc">EPC</a></li>

            <li><a href="/business-ibt">IBT</a></li>

            <li><a href="/business-enr">ENR</a></li>

        </ul>

    </div>

    <div class="subsitemap d-none d-xl-block" style="background-image: none;">

        <ul>

            <li></li>



        </ul>

    </div>

    <div class="subsitemap">

        <ul>

            <li><a class="button js-filter btn-slider1" href="/#projectref" data-filter=".HiglightProject">Highlight Projects</a></li>

            <li><a class="button js-filter website btn-slider2" href="/#projectref" data-filter=".category-Commercial">Commercial</a></li>

            <li><a class="button js-filter btn-slider3" href="/#projectref" data-filter=".category-Residential">Residential</a></li>

            <li><a class="button js-filter btn-slider9" href="/#projectref" data-filter=".category-Health">Hotel & Leisure</a></li>

            <li><a class="button js-filter btn-slider4" href="/#projectref" data-filter=".category-Government">Health & Education</a></li>

            <li><a class="button js-filter btn-slider5" href="/#projectref" data-filter=".category-Industrial">Government</a></li>

            <li><a class="button js-filter btn-slider6" href="/#projectref" data-filter=".category-CriticalSpace">Industrial</a></li>

            <li><a class="button js-filter btn-slider7" href="/#projectref" data-filter=".category-Construction">Critical Space</a></li>

            <li><a class="button js-filter btn-slider8" href="/#projectref" data-filter=".category-Hotel">Construction</a></li>

            <li><a class="button js-filter btn-slider10" href="/#projectref" data-filter=".category-Others">Other</a></li>

        </ul>

    </div>

</div>

