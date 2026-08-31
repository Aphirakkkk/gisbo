@extends('layouts.frontend.sidenav-frontend')
@section('css')
<style>
    a.text-white {
        font-family: 'fc_minimalbold';
    }

    .card-Achievement .content a {
        color: #ffffff;
        text-decoration: none;
        cursor: pointer;
        font-family: "fc_minimalbold";
        font-size: 20px;
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding: 0 10px;
    }

    .modal-backdrop {
        z-index: 1040 !important;
    }

    .modal {
        z-index: 1055 !important;
    }

    .card-person .content a {
        cursor: pointer;
    }

    .card-person .person {
        max-width: 140px;
        max-height: 200px;
        width: auto;
        height: auto;
        object-fit: contain;
    }

    .personModal .card-person .person {
        max-width: 100%;
        max-height: 320px;
        object-fit: contain;
    }

    .iso-slider-wrapper {
        position: relative;
        width: 100%;
    }

    .iso-slides-window {
        overflow: hidden;
        position: relative;
        width: 100%;
    }

    .iso-slide-item {
        position: relative;
        display: none;
        width: 100%;
        backface-visibility: hidden;
    }

    .iso-slide-item.active {
        display: block;
    }

    .iso-slide-item.iso-slide-next-in {
        display: block;
        animation: isoSlideNextIn 0.6s ease-in-out forwards;
    }

    .iso-slide-item.iso-slide-next-out {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        animation: isoSlideNextOut 0.6s ease-in-out forwards;
    }

    .iso-slide-item.iso-slide-prev-in {
        display: block;
        animation: isoSlidePrevIn 0.6s ease-in-out forwards;
    }

    .iso-slide-item.iso-slide-prev-out {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        animation: isoSlidePrevOut 0.6s ease-in-out forwards;
    }

    @keyframes isoSlideNextIn {
        from { transform: translateX(100%); }
        to { transform: translateX(0); }
    }

    @keyframes isoSlideNextOut {
        from { transform: translateX(0); }
        to { transform: translateX(-100%); }
    }

    @keyframes isoSlidePrevIn {
        from { transform: translateX(-100%); }
        to { transform: translateX(0); }
    }

    @keyframes isoSlidePrevOut {
        from { transform: translateX(0); }
        to { transform: translateX(100%); }
    }

    .iso-nav-btn {
        position: absolute;
        bottom: 10px;
        top: auto;
        transform: none;
        z-index: 30;
        background: transparent !important;
        border: none !important;
        outline: none !important;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        opacity: 0.65;
        transition: opacity 0.25s ease, transform 0.25s ease;
    }

    .iso-nav-btn:hover {
        opacity: 1;
        transform: scale(1.15);
    }

    .iso-btn-prev {
        left: -25px;
    }

    .iso-btn-next {
        right: 12%;
    }

    /* Policy Card (1 Section - Spacious & Centered) */
    #v-pills-Policy .policy-card-custom {
        background: transparent;
        padding: 0 10px;
        max-width: 500px;
        margin: 0 auto;
        width: 100%;
    }

    #v-pills-Policy .policy-badge-banner {
        display: block;
        width: 100%;
        max-width: 400px;
        background: linear-gradient(90deg, #e46a25 0%, #f77f00 100%);
        padding: 8px 20px;
        transform: skewX(-20deg);
        border-radius: 4px;
        box-shadow: 0 4px 12px rgba(228, 106, 37, 0.35);
        margin: 0 auto 20px auto;
        text-align: center;
    }

    #v-pills-Policy .policy-badge-banner h3 {
        margin: 0;
        transform: skewX(20deg);
        font-size: 28px !important;
        font-weight: 900 !important;
        font-style: italic;
        color: #000000 !important;
        letter-spacing: 0.5px;
        font-family: 'fc_minimalbold', 'Prompt', sans-serif;
    }

    #v-pills-Policy .policy-body-content {
        font-size: 22px !important;
        line-height: 1.55 !important;
        color: #000000 !important;
        text-align: left;
        font-family: 'fc_minimalregular', 'Prompt', sans-serif;
    }

    #v-pills-Policy .policy-body-content p {
        margin-bottom: 1rem;
        font-size: 22px !important;
        line-height: 1.55 !important;
        color: #000000 !important;
    }

    #v-pills-Policy .policy-body-content strong, 
    #v-pills-Policy .policy-body-content b {
        font-size: 23px !important;
        font-weight: 800 !important;
        color: #e46a25 !important;
    }

    /* Carbon Footprint Card (Multiple Sections - Compact & Fits Perfectly on One Screen) */
    #v-pills-Carbon .policy-card-custom {
        background: transparent;
        padding: 0 10px;
        max-width: 500px;
        margin: 0 auto;
        width: 100%;
    }

    #v-pills-Carbon .policy-badge-banner {
        display: block;
        width: 100%;
        max-width: 390px;
        background: linear-gradient(90deg, #e46a25 0%, #f77f00 100%);
        padding: 6px 18px;
        transform: skewX(-20deg);
        border-radius: 4px;
        box-shadow: 0 3px 8px rgba(228, 106, 37, 0.3);
        margin: 0 auto 12px auto !important;
        text-align: center;
    }

    #v-pills-Carbon .policy-badge-banner h3 {
        margin: 0;
        transform: skewX(20deg);
        font-size: 23px !important;
        font-weight: 900 !important;
        font-style: italic;
        color: #000000 !important;
        letter-spacing: 0.5px;
        font-family: 'fc_minimalbold', 'Prompt', sans-serif;
    }

    #v-pills-Carbon .policy-body-content {
        font-size: 20px !important;
        line-height: 1.5 !important;
        color: #000000 !important;
        text-align: left;
        font-family: 'fc_minimalregular', 'Prompt', sans-serif;
    }

    #v-pills-Carbon .policy-body-content p {
        margin-bottom: 0.85rem !important;
        font-size: 20px !important;
        line-height: 1.5 !important;
        color: #000000 !important;
    }

    #v-pills-Carbon .policy-body-content strong, 
    #v-pills-Carbon .policy-body-content b {
        font-size: 21px !important;
        font-weight: 800 !important;
        color: #e46a25 !important;
    }

    #v-pills-Carbon .policy-badge-banner.mt-4 {
        margin-top: 18px !important;
    }

    .policy-body-content font, 
    .policy-body-content font[size],
    .policy-body-content span {
        font-size: inherit !important;
        line-height: inherit !important;
    }
</style>

@endsection
@section('content')
{{-- banner --}}
<section id="banner" class="section banner active">
    <section id="carouselBannerFade" class="carousel slide carousel-fade" data-ride="carousel" data-touch="true" data-interval="true">
        <div class="carousel-inner">
            @foreach($Banner as $key => $data)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="background-image: url({{ asset($data->image_banner_slide) }});" data-interval="10000">
                <div class="banner-content">
                    @if(Config::get('app.locale') == 'en')
                    <h2 class="h2">{{ $data->tilte_en }}</h2>
                    @if(!empty($data->image_banner_text) && $data->image_banner_text != 'assets/backend/images/error/nopic.jpg')
                    <div class="font">
                        <img src="{{ asset($data->image_banner_text) }}" alt="" style="max-width: 900px; height: auto;"/>
                    </div>
                    @endif
                    @else
                    <h2 class="h2">{{ $data->tilte_th }}</h2>
                    @if(!empty($data->image_banner_text) && $data->image_banner_text != 'assets/backend/images/error/nopic.jpg')
                    <div class="font">
                        <img src="{{ asset($data->image_banner_text) }}" alt="" style="max-width: 900px; height: auto;"/>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
            @endforeach

        </div>
        <a class="carousel-control-prev" href="#carouselBannerFade" role="button" data-slide="prev">
            <img src="img/btn-pv.png" alt="" />
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselBannerFade" role="button" data-slide="next">
            <img src="img/btn-next.png" alt="" />
            <span class="sr-only">Next</span>
        </a>
    </section>
</section>
{{-- about --}}
{{-- about --}}
<section id="about" class="section home-about ">
    <div class="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-3">
                    <div class="content-left"> <img src="img/about-line-1.png" alt="" /></div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12 col-lg-9 pl-4 pr-0">
                    <div class="tab-content" id="v-pills-tabContent">
                        {{-- about_us_main --}}
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="row">
                                <div class="col-12 col-xl-4">
                                    <div class="content-left">
                                        <h1 class="h1 color1">OUR GIS GROUP</h1>
                                        @if(Config::get('app.locale') == 'en')
                                        <h3 class="h3">{!! $about_us_main->tilte_en ?? $about_us_main->tilte_th ?? '-' !!}</h3>
                                        <p>{!! $about_us_main->detail_en ?? $about_us_main->detail_th ?? '-' !!}</p>
                                        @else
                                        <h3 class="h3">{!! $about_us_main->tilte_th ?? $about_us_main->tilte_en ?? '-' !!}</h3>
                                        <p>{!! $about_us_main->detail_th ?? $about_us_main->detail_en ?? '-' !!}</p>
                                        @endif
                                        <a href="/about-detail" class="btn btn-first">Read More</a>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-8">
                                    <div class="content-about">
                                        <img class="w-100" src="img/about-home.png" alt="" />
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{-- OrganiztionalStructure --}}
                        <div class="tab-pane fade" id="v-OrganiztionalStructure-tab" role="tabpanel" aria-labelledby="v-pills-OrganiztionalStructure-tab">
                            <div class="content-left">
                                <h1 class="h1 color1">Organizational Structure</h1>
                            </div>
                            <div class="px-0 px-xl-5">
                                <div class="row">
                                    @foreach($AboutUsOrganiztional as $key => $data)
                                    <div class="col-12 col-sm-6 col-xl-3">
                                        <div class="card-person">
                                            <div class="card-box" data-toggle="modal" data-target="#personModal_{{ $data->id }}" style="cursor: pointer;"></div>
                                            <img class="person" src="{{ asset($data->image_main ?: 'assets/backend/images/error/nopic.jpg') }}" alt="" data-toggle="modal" data-target="#personModal_{{ $data->id }}" style="cursor: pointer;">
                                            <div class="content">
                                                @if(Config::get('app.locale') == 'en')
                                                <div class="position">
                                                    <a data-toggle="modal" data-target="#personModal_{{ $data->id }}"><b>{{ $data->position_en ?? '-'}}</b></a>
                                                </div>
                                                <div class="name-person">
                                                    <a data-toggle="modal" data-target="#personModal_{{ $data->id }}">{{ $data->full_name_en ?? '-'}}</a>
                                                </div>
                                                @else
                                                <div class="position">
                                                    <a data-toggle="modal" data-target="#personModal_{{ $data->id }}"><b>{{ $data->position_th ?? '-'}}</b></a>
                                                </div>
                                                <div class="name-person">
                                                    <a data-toggle="modal" data-target="#personModal_{{ $data->id }}">{{ $data->full_name_th ?? '-'}}</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade personModal" id="personModal_{{ $data->id }}" tabindex="-1" aria-labelledby="personModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg px-5">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="personModalLabel">Organizational Structure</h5>
                                                    <button type="button" class="close p-2" data-dismiss="modal" aria-label="Close">
                                                        <img src="{{ asset('img/Organize/close.png') }}" alt="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="card-person">
                                                                <div class="card-box"></div>
                                                                <img class="person" src="{{ asset($data->image_main ?: 'assets/backend/images/error/nopic.jpg') }}" alt="">
                                                                <div class="personafter"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            @if(Config::get('app.locale') == 'en')
                                                            <div class="content-person">
                                                                <h5>{{ $data->full_name_en ?? '-'}}</h5>
                                                                <div class="mb-2"><b>ตำแหน่ง : </b><span>{{ $data->position_en ?? '-'}}</span></div>
                                                                <div class="mb-2"><b>การศึกษา : </b></div>
                                                                <ul class="mb-2">
                                                                    {!! $data->study_en ?? '-'!!}
                                                                </ul>
                                                                <div class="mb-2"><b>ประวัติการทำงาน : </b></div>
                                                                <div class="list-exp">
                                                                    {!! $data->work_en ?? '-'!!}
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="content-person">
                                                                <h5>{{ $data->full_name_th ?? '-'}}</h5>
                                                                <div class="mb-2"><b>ตำแหน่ง : </b><span>{{ $data->position_th ?? '-'}}</span></div>
                                                                <div class="mb-2"><b>การศึกษา : </b></div>
                                                                <ul class="mb-2">
                                                                    {!! $data->study_th ?? '-'!!}
                                                                </ul>
                                                                <div class="mb-2"><b>ประวัติการทำงาน : </b></div>
                                                                <div class="list-exp">
                                                                    {!! $data->work_th ?? '-'!!}
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- Ethics --}}
                        <div class="tab-pane fade" id="v-pills-Ethics" role="tabpanel" aria-labelledby="v-pills-Ethics-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="content-left">
                                        @if(Config::get('app.locale') == 'en')
                                        <div class="content-ethics content-ethics-main">
                                            <h1 class="h1 color1 text-uppercase my-3">Ethics</h1>
                                            <div class="topic topic1">
                                                <h2 class="h2">{!! $AboutUsEthics1->tilte_en ?? '-' !!}</h2>
                                            </div>
                                            <p class="detail detail1">
                                                {!! $AboutUsEthics1->detail_en ?? '-' !!}
                                            </p>
                                            <div class="topic topic2">
                                                <h2 class="h2">{!! $AboutUsEthics2->tilte_en ?? '-' !!}</h2>
                                            </div>
                                            <p class="detail detail2">
                                                {!! $AboutUsEthics2->detail_en ?? '-' !!}
                                            </p>
                                            <div class="topic topic3">
                                                <h2 class="h2">{!! $AboutUsEthics3->tilte_en ?? '-' !!}</h2>
                                            </div>
                                            <p class="detail detail3">
                                                {!! $AboutUsEthics3->detail_en ?? '-' !!}
                                            </p>
                                            <img src="img/People.png" class="w-100 people-content-ethics" alt="">
                                        </div>
                                        @else
                                        <div class="content-ethics content-ethics-main">
                                            <h1 class="h1 color1 text-uppercase my-3">Ethics</h1>
                                            <div class="topic topic1">
                                                <h2 class="h2">{!! $AboutUsEthics1->tilte_th ?? '-' !!}</h2>
                                            </div>
                                            <p class="detail detail1">
                                                {!! $AboutUsEthics1->detail_th ?? '-' !!}
                                            </p>
                                            <div class="topic topic2">
                                                <h2 class="h2">{!! $AboutUsEthics2->tilte_th ?? '-' !!}</h2>
                                            </div>
                                            <p class="detail detail2">
                                                {!! $AboutUsEthics2->detail_th ?? '-' !!}
                                            </p>
                                            <div class="topic topic3">
                                                <h2 class="h2">{!! $AboutUsEthics3->tilte_th ?? '-' !!}</h2>
                                            </div>
                                            <p class="detail detail3">
                                                {!! $AboutUsEthics3->detail_th ?? '-' !!}
                                            </p>
                                            <img src="img/People.png" class="w-100 people-content-ethics" alt="">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Achievement --}}
                        <div class="tab-pane fade" id="v-pills-Achievement" role="tabpanel" aria-labelledby="v-pills-Achievement-tab">
                            <div class="content-left">

                                <h1 class="h1 color1">Achievement</h1>
                            </div>
                            <div class="px-0 px-xl-5">
                                <div class="row">
                                    @php
                                    $totalAboutUsAchievementMain = (count($AboutUsAchievementMain) % 6 == 0) ? count($AboutUsAchievementMain) : (count($AboutUsAchievementMain) + 1);
                                    @endphp
                                    <div id="carouselExampleCaptions2" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @if(isset($AboutUsAchievementMain[0]))
                                            <li data-target="#carouselExampleCaptions2" data-slide-to="0" class="active"></li>
                                            @endif
                                            @if(isset($AboutUsAchievementMain[6]))
                                            <li data-target="#carouselExampleCaptions2" data-slide-to="1"></li>
                                            @endif
                                            @if(isset($AboutUsAchievementMain[12]))
                                            <li data-target="#carouselExampleCaptions2" data-slide-to="2"></li>
                                            @endif
                                            @if(isset($AboutUsAchievementMain[18]))
                                            <li data-target="#carouselExampleCaptions2" data-slide-to="3"></li>
                                            @endif
                                        </ol>
                                        <div class="carousel-inner">
                                            @if(Config::get('app.locale') == 'en')
                                            @if(isset($AboutUsAchievementMain[0]))
                                            <div class="carousel-item active" data-delay="100">
                                                <div class="container">
                                                    <div class="row">
                                                        @if(isset($AboutUsAchievementMain[0]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[0]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[0]->id )}}" class="text-white">{!! $AboutUsAchievementMain[0]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[1]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[1]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[1]->id )}}" class="text-white">{!! $AboutUsAchievementMain[1]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[2]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[2]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[2]->id )}}" class="text-white">{!! $AboutUsAchievementMain[2]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[3]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[3]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[3]->id )}}" class="text-white">{!! $AboutUsAchievementMain[3]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[4]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[4]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[4]->id )}}" class="text-white">{!! $AboutUsAchievementMain[4]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[5]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[5]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[5]->id )}}" class="text-white">{!! $AboutUsAchievementMain[5]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(isset($AboutUsAchievementMain[6]))
                                            <div class="carousel-item " data-delay="100">
                                                <div class="container">
                                                    <div class="row">
                                                        @if(isset($AboutUsAchievementMain[6]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[6]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[6]->id )}}" class="text-white">{!! $AboutUsAchievementMain[6]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[7]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[7]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[7]->id )}}" class="text-white">{!! $AboutUsAchievementMain[7]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[8]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[8]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[8]->id )}}" class="text-white">{!! $AboutUsAchievementMain[8]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[9]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[9]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[9]->id )}}" class="text-white">{!! $AboutUsAchievementMain[9]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[10]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[10]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[10]->id )}}" class="text-white">{!! $AboutUsAchievementMain[10]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[11]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[11]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[11]->id )}}" class="text-white">{!! $AboutUsAchievementMain[11]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(isset($AboutUsAchievementMain[12]))
                                            <div class="carousel-item " data-delay="100">
                                                <div class="container">
                                                    <div class="row">
                                                        @if(isset($AboutUsAchievementMain[12]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[12]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[12]->id )}}" class="text-white">{!! $AboutUsAchievementMain[12]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[13]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[13]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[13]->id )}}" class="text-white">{!! $AboutUsAchievementMain[13]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[14]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[14]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[14]->id )}}" class="text-white">{!! $AboutUsAchievementMain[14]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[15]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[15]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[15]->id )}}" class="text-white">{!! $AboutUsAchievementMain[15]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[16]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[16]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[16]->id )}}" class="text-white">{!! $AboutUsAchievementMain[16]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[17]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[17]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[17]->id )}}" class="text-white">{!! $AboutUsAchievementMain[17]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(isset($AboutUsAchievementMain[18]))
                                            <div class="carousel-item " data-delay="100">
                                                <div class="container">
                                                    <div class="row">
                                                        @if(isset($AboutUsAchievementMain[18]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[18]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[18]->id )}}" class="text-white">{!! $AboutUsAchievementMain[18]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[19]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[19]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[19]->id )}}" class="text-white">{!! $AboutUsAchievementMain[19]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[20]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[20]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[20]->id )}}" class="text-white">{!! $AboutUsAchievementMain[20]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[21]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[21]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[21]->id )}}" class="text-white">{!! $AboutUsAchievementMain[21]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[22]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[22]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[22]->id )}}" class="text-white">{!! $AboutUsAchievementMain[22]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[23]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[23]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[23]->id )}}" class="text-white">{!! $AboutUsAchievementMain[23]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @else
                                            @if(isset($AboutUsAchievementMain[0]))
                                            <div class="carousel-item active" data-delay="100">
                                                <div class="container">
                                                    <div class="row">
                                                        @if(isset($AboutUsAchievementMain[0]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[0]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[0]->id )}}" class="text-white">{!! $AboutUsAchievementMain[0]->tilte_en ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[1]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[1]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[1]->id )}}" class="text-white">{!! $AboutUsAchievementMain[1]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[2]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[2]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[2]->id )}}" class="text-white">{!! $AboutUsAchievementMain[2]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[3]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[3]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[3]->id )}}" class="text-white">{!! $AboutUsAchievementMain[3]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[4]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[4]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[4]->id )}}" class="text-white">{!! $AboutUsAchievementMain[4]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[5]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[5]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[5]->id )}}" class="text-white">{!! $AboutUsAchievementMain[5]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(isset($AboutUsAchievementMain[6]))
                                            <div class="carousel-item " data-delay="100">
                                                <div class="container">
                                                    <div class="row">
                                                        @if(isset($AboutUsAchievementMain[6]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[6]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[6]->id )}}" class="text-white">{!! $AboutUsAchievementMain[6]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[7]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[7]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[7]->id )}}" class="text-white">{!! $AboutUsAchievementMain[7]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[8]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[8]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[8]->id )}}" class="text-white">{!! $AboutUsAchievementMain[8]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[9]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[9]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[9]->id )}}" class="text-white">{!! $AboutUsAchievementMain[9]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[10]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[10]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[10]->id )}}" class="text-white">{!! $AboutUsAchievementMain[10]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[11]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[11]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[11]->id )}}" class="text-white">{!! $AboutUsAchievementMain[11]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(isset($AboutUsAchievementMain[12]))
                                            <div class="carousel-item " data-delay="100">
                                                <div class="container">
                                                    <div class="row">
                                                        @if(isset($AboutUsAchievementMain[12]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[12]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[12]->id )}}" class="text-white">{!! $AboutUsAchievementMain[12]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[13]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[13]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[13]->id )}}" class="text-white">{!! $AboutUsAchievementMain[13]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[14]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[14]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[14]->id )}}" class="text-white">{!! $AboutUsAchievementMain[14]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[15]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[15]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[15]->id )}}" class="text-white">{!! $AboutUsAchievementMain[15]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[16]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[16]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[16]->id )}}" class="text-white">{!! $AboutUsAchievementMain[16]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[17]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[17]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[17]->id )}}" class="text-white">{!! $AboutUsAchievementMain[17]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(isset($AboutUsAchievementMain[18]))
                                            <div class="carousel-item " data-delay="100">
                                                <div class="container">
                                                    <div class="row">
                                                        @if(isset($AboutUsAchievementMain[18]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[18]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[18]->id )}}" class="text-white">{!! $AboutUsAchievementMain[18]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[19]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[19]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[19]->id )}}" class="text-white">{!! $AboutUsAchievementMain[19]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[20]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[20]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[20]->id )}}" class="text-white">{!! $AboutUsAchievementMain[20]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[21]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[21]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[21]->id )}}" class="text-white">{!! $AboutUsAchievementMain[21]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[22]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[22]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[22]->id )}}" class="text-white">{!! $AboutUsAchievementMain[22]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($AboutUsAchievementMain[23]))
                                                        <div class="col-12 col-sm-6 col-xl-4">
                                                            <div class="card-Achievement">
                                                                <img src="{{ asset($AboutUsAchievementMain[23]->image_main) }}" alt="">
                                                                <div class="content">
                                                                    <a href="{{url('/about_achievement-detail' . '/' . $AboutUsAchievementMain[23]->id )}}" class="text-white">{!! $AboutUsAchievementMain[23]->tilte_th ?? '-' !!}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
{{-- policy --}}
<div class="tab-pane fade" id="v-pills-Policy" role="tabpanel" aria-labelledby="v-pills-Policy-tab">
    <div class="content-left">
        <div class="row">
            <div class="col-12">
                <h1 class="h1 color1 text-uppercase my-3">Policy</h1>
            </div>

            @php
                $policyItem = isset($AboutUsPolicyList) ? $AboutUsPolicyList->first() : null;
                $pTitleTh = ($policyItem && $policyItem->tilte_th) ? $policyItem->tilte_th : 'นโยบายความยั่งยืน';
                $pTitleEn = ($policyItem && $policyItem->tilte_en) ? $policyItem->tilte_en : 'Sustainability Policy';
                $pDetailTh = ($policyItem && $policyItem->detail_th) ? $policyItem->detail_th : '<p><strong style="color: #e46a25;">GIS Group</strong> เป็นองค์กรที่ให้ความสำคัญกับความยั่งยืนและความรับผิดชอบต่อสิ่งแวดล้อม โดยเฉพาะอย่างยิ่งในการบริหารจัดการพลังงานอย่างมีประสิทธิภาพภายในสำนักงานและโครงการต่างๆ เรามุ่งมั่นลดผลกระทบต่อสภาพภูมิอากาศด้วยการนำเทคโนโลยีอาคารอัจฉริยะและพลังงานสะอาดมาใช้ในกระบวนการดำเนินงาน ทั้งผู้บริหารและพนักงานทุกระดับให้ความสำคัญกับการปรับปรุงประสิทธิภาพการใช้พลังงานและลดการสูญเสียพลังงานไฟฟ้า ส่งผลให้สามารถลดการใช้ไฟฟ้าจากภายนอกและลดการปล่อยก๊าซคาร์บอนไดออกไซด์ลงอย่างต่อเนื่องในแต่ละปี GIS Group จึงขอแสดงเจตนารมณ์ในการดำเนินธุรกิจอย่างเป็นมิตรต่อสิ่งแวดล้อม คำนึงถึงกฎหมายและมาตรฐานที่เกี่ยวข้อง พร้อมทั้งมุ่งสร้างสรรค์อนาคตที่ยั่งยืนให้กับชุมชนและสิ่งแวดล้อมของเราต่อไป</p>';
                $pDetailEn = ($policyItem && $policyItem->detail_en) ? $policyItem->detail_en : '<p><strong style="color: #e46a25;">GIS Group</strong> is an organization that focuses on sustainability and environmental responsibility, especially for efficient energy management within offices and projects. We are committed to minimizing climate impact by implementing smart building technology and clean energy. Executives and employees of all levels focus on improving energy efficiency and reducing electricity consumption, reducing external power consumption and reducing CO2 emissions each year. GIS Group is committed to environmentally friendly business operations in consideration of relevant laws and standards. At the same time, we are committed to building a sustainable future for our communities and the environment.</p>';
            @endphp

            <!-- ฝั่งภาษาไทย (ซ้าย) -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="policy-card-custom">
                    <div class="policy-badge-banner">
                        <h3>{{ $pTitleTh }}</h3>
                    </div>
                    <div class="policy-body-content">
                        {!! $pDetailTh !!}
                    </div>
                </div>
            </div>

            <!-- ฝั่งภาษาอังกฤษ (ขวา) -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="policy-card-custom">
                    <div class="policy-badge-banner">
                        <h3>{{ $pTitleEn }}</h3>
                    </div>
                    <div class="policy-body-content">
                        {!! $pDetailEn !!}
                    </div>
                </div>
            </div>

        </div>
    </div>  
</div>

{{-- Carbon Footprint --}}
<div class="tab-pane fade" id="v-pills-Carbon" role="tabpanel" aria-labelledby="v-pills-Carbon-tab">
    <div class="content-left">
        <div class="row">
            <div class="col-12">
                <h1 class="h1 color1 text-uppercase my-3">Carbon Footprint</h1>
            </div>

            @php
                $carbonItem = isset($AboutUsCarbonList) ? $AboutUsCarbonList->first() : null;
                $cDetailTh = ($carbonItem && $carbonItem->detail_th) ? $carbonItem->detail_th : '<div class="policy-badge-banner"><h3>คาร์บอนฟุตพริ้นท์ขององค์กร (CFO)</h3></div><p>คือ การประเมินและคำนวณปริมาณการปล่อยก๊าซเรือนกระจกที่เกิดขึ้นจากกิจกรรมทั้งหมดขององค์กร เพื่อให้รู้แหล่งกำเนิดการปล่อย (Emission Sources) และใช้เป็นฐานข้อมูลสำคัญสำหรับการวางแผนสู่การลดและชดเชยคาร์บอน (Carbon Neutrality / Net Zero)</p><div class="policy-badge-banner mt-4"><h3>คาร์บอนฟุตพริ้นท์ของผลิตภัณฑ์ (CFP)</h3></div><p>คือ การประเมินและคำนวณปริมาณการปล่อยก๊าซเรือนกระจกตลอดวัฏจักรชีวิตของผลิตภัณฑ์ (ตั้งแต่การจัดหาวัตถุดิบ การผลิต การขนส่ง การใช้งาน ไปจนถึงการจัดการหลังหมดอายุการใช้งาน) เพื่อใช้เป็นดัชนีแสดงผลกระทบต่อสิ่งแวดล้อม และเป็นข้อมูลสำหรับการตัดสินใจของผู้บริโภคและคู่ค้า</p><p class="mt-4"><strong style="color: #e46a25;">GIS Group</strong> พร้อมให้บริการ ที่ปรึกษาด้านการจัดทำและขอการรับรองทั้ง CFO และ CFP อย่างครบวงจร ตั้งแต่การเก็บข้อมูล การวิเคราะห์ การจัดทำรายงาน ไปจนถึงการยื่นขอการรับรองกับองค์การบริหารจัดการก๊าซเรือนกระจก (องค์การ TGO)</p>';
                $cDetailEn = ($carbonItem && $carbonItem->detail_en) ? $carbonItem->detail_en : '<div class="policy-badge-banner"><h3>Carbon Footprint of Organization (CFO)</h3></div><p>This refers to the assessment and calculation of greenhouse gas emissions resulting from all organizational activities, in order to identify emission sources and provide essential data for planning towards carbon reduction and compensation (Carbon Neutrality / Net Zero).</p><div class="policy-badge-banner mt-4"><h3>Carbon Footprint of Product (CFP)</h3></div><p>This refers to the assessment and calculation of greenhouse gas emissions throughout the entire life cycle of a product (from raw material sourcing, production, transportation, usage, to end-of-life disposal). It serves as an index to demonstrate environmental impacts and as information for consumer and partner decision-making.</p><p class="mt-4"><strong style="color: #e46a25;">GIS Group</strong>, We provide comprehensive consulting services for both CFO and CFP, covering data collection, analysis, report preparation, and submission for certification with the Thailand Greenhouse Gas Management Organization (TGO).</p>';
            @endphp

            <!-- ฝั่งภาษาไทย (ซ้าย) -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="policy-card-custom">
                    <div class="policy-body-content">
                        {!! $cDetailTh !!}
                    </div>
                </div>
            </div>

            <!-- ฝั่งภาษาอังกฤษ (ขวา) -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="policy-card-custom">
                    <div class="policy-body-content">
                        {!! $cDetailEn !!}
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

                        {{-- 9001 --}}
                        <div class="tab-pane fade" id="v-pills-9001" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            <div class="content-left">
                                <h1 class="h1 color1 text-uppercase my-3">ISO 9001</h1>
                                <div class="iso-slider-wrapper" id="iso9001Slider">
                                    @if(count($AboutUs9001List) > 1)
                                    <button type="button" class="iso-nav-btn iso-btn-prev" onclick="changeIsoSlide('iso9001Slider', -1)">
                                        <img src="{{ asset('img/news-pv.png') }}" alt="Previous" />
                                    </button>
                                    @endif

                                    <div class="iso-slides-window">
                                        <div class="iso-slides-content">
                                            @foreach($AboutUs9001List as $key => $item)
                                            <div class="iso-slide-item {{ $key == 0 ? 'active' : '' }}" data-slide-index="{{ $key }}">
                                                <div class="row">
                                                    @if($item->image1 && $item->image1 != 'assets/backend/images/error/nopic.jpg')
                                                    <div class="col-12 col-lg-6 col-xl-5 mb-3">
                                                        <img class="w-100 shadow-sm border rounded" src="{{ asset($item->image1) }}" alt="ISO 9001" />
                                                    </div>
                                                    @endif
                                                    @if($item->image2 && $item->image2 != 'assets/backend/images/error/nopic.jpg')
                                                    <div class="col-12 col-lg-6 col-xl-5 mb-3">
                                                        <img class="w-100 shadow-sm border rounded" src="{{ asset($item->image2) }}" alt="ISO 9001 Page 2" />
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    @if(count($AboutUs9001List) > 1)
                                    <button type="button" class="iso-nav-btn iso-btn-next" onclick="changeIsoSlide('iso9001Slider', 1)">
                                        <img src="{{ asset('img/news-next.png') }}" alt="Next" />
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- 45001 --}}
                        <div class="tab-pane fade" id="v-pills-45001" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            <div class="content-left">
                                <h1 class="h1 color1 text-uppercase my-3">ISO 45001</h1>
                                <div class="iso-slider-wrapper" id="iso45001Slider">
                                    @if(count($AboutUs45001List) > 1)
                                    <button type="button" class="iso-nav-btn iso-btn-prev" onclick="changeIsoSlide('iso45001Slider', -1)">
                                        <img src="{{ asset('img/news-pv.png') }}" alt="Previous" />
                                    </button>
                                    @endif

                                    <div class="iso-slides-window">
                                        <div class="iso-slides-content">
                                            @foreach($AboutUs45001List as $key => $item)
                                            <div class="iso-slide-item {{ $key == 0 ? 'active' : '' }}" data-slide-index="{{ $key }}">
                                                <div class="row">
                                                    @if($item->image1 && $item->image1 != 'assets/backend/images/error/nopic.jpg')
                                                    <div class="col-12 col-lg-6 col-xl-5 mb-3">
                                                        <img class="w-100 shadow-sm border rounded" src="{{ asset($item->image1) }}" alt="ISO 45001" />
                                                    </div>
                                                    @endif
                                                    @if($item->image2 && $item->image2 != 'assets/backend/images/error/nopic.jpg')
                                                    <div class="col-12 col-lg-6 col-xl-5 mb-3">
                                                        <img class="w-100 shadow-sm border rounded" src="{{ asset($item->image2) }}" alt="ISO 45001 Page 2" />
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    @if(count($AboutUs45001List) > 1)
                                    <button type="button" class="iso-nav-btn iso-btn-next" onclick="changeIsoSlide('iso45001Slider', 1)">
                                        <img src="{{ asset('img/news-next.png') }}" alt="Next" />
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- why --}}
                        <div class="tab-pane fade" id="v-pills-why" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            <div class="content-left whychoose-main">
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="h1 color1 text-uppercase my-3">Why choose</h1>
                                    </div>
                                    <div class="col-12">
                                        <div class="content-WhyChoose-main">
                                            <ul>
                                                @foreach($AboutUsWhyChoose as $key => $data)
                                                @if(Config::get('app.locale') == 'en')
                                                <li>
                                                    <div class="d-flex">
                                                        <span>
                                                            <img src="img/why-icon.png" alt="" width="40">
                                                        </span>
                                                        <span>
                                                            <label for="">{!! $data->tilte_en ?? '-' !!}</label>
                                                            <p>{!! $data->detail_en ?? '-' !!}</p>
                                                        </span>
                                                    </div>
                                                </li>
                                                @else
                                                <li>
                                                    <div class="d-flex">
                                                        <span>
                                                            <img src="img/why-icon.png" alt="" width="40">
                                                        </span>
                                                        <span>
                                                            <label for="">{!! $data->tilte_th ?? '-' !!}</label>
                                                            <p>{!! $data->detail_th ?? '-' !!}</p>
                                                        </span>
                                                    </div>
                                                </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="content-left2 d-none d-lg-block">
                                            <img src="img/Engineer.png" alt=""style="max-width: 580px; height: auto;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- 27001 --}}
                        <div class="tab-pane fade" id="v-pills-27001" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            <div class="content-left">
                                <h1 class="h1 color1 text-uppercase my-3">ISO 27001</h1>
                                <div class="iso-slider-wrapper" id="iso27001Slider">
                                    @if(count($AboutUsIECList) > 1)
                                    <button type="button" class="iso-nav-btn iso-btn-prev" onclick="changeIsoSlide('iso27001Slider', -1)">
                                        <img src="{{ asset('img/news-pv.png') }}" alt="Previous" />
                                    </button>
                                    @endif

                                    <div class="iso-slides-window">
                                        <div class="iso-slides-content">
                                            @foreach($AboutUsIECList as $key => $item)
                                            <div class="iso-slide-item {{ $key == 0 ? 'active' : '' }}" data-slide-index="{{ $key }}">
                                                <div class="row">
                                                    @if($item->image1 && $item->image1 != 'assets/backend/images/error/nopic.jpg')
                                                    <div class="col-12 col-lg-6 col-xl-5 mb-3">
                                                        <img class="w-100 shadow-sm border rounded" src="{{ asset($item->image1) }}" alt="ISO 27001" />
                                                    </div>
                                                    @endif
                                                    @if($item->image2 && $item->image2 != 'assets/backend/images/error/nopic.jpg')
                                                    <div class="col-12 col-lg-6 col-xl-5 mb-3">
                                                        <img class="w-100 shadow-sm border rounded" src="{{ asset($item->image2) }}" alt="ISO 27001 Page 2" />
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    @if(count($AboutUsIECList) > 1)
                                    <button type="button" class="iso-nav-btn iso-btn-next" onclick="changeIsoSlide('iso27001Slider', 1)">
                                        <img src="{{ asset('img/news-next.png') }}" alt="Next" />
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- Values --}}
                        <div class="tab-pane fade" id="v-pills-Values" role="tabpanel" aria-labelledby="v-pills-Values-tab">
                            <div class="value-gis-main">
                                <div class="row">
                                    <div class="col-12 content-left">
                                        <h1 class="h1 color1 text-uppercase my-3">Value</h1>
                                    </div>
                                    @if(Config::get('app.locale') == 'en')
                                    <div class="col-12 col-sm-4">
                                        <div class="value-gis-main-card">
                                            <img src="{{ asset($AboutUsValues1->image_main) }}" class="w-100" alt="">
                                            <div class="topic topic1">
                                                <h2 class="h2">{!! $AboutUsValues1->tilte_en ?? '-' !!}</h2>
                                            </div>
                                            <p>{!! $AboutUsValues1->detail_en ?? '-' !!}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="value-gis-main-card">
                                            <img src="{{ asset($AboutUsValues2->image_main) }}" class="w-100" alt="">
                                            <div class="topic topic1">
                                                <h2 class="h2">{!! $AboutUsValues2->tilte_en ?? '-' !!}</h2>
                                            </div>
                                            <p>{!! $AboutUsValues2->detail_en ?? '-' !!}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="value-gis-main-card">
                                            <img src="{{ asset($AboutUsValues3->image_main) }}" class="w-100" alt="">
                                            <div class="topic topic1">
                                                <h2 class="h2">{!! $AboutUsValues3->tilte_en ?? '-' !!}</h2>
                                            </div>
                                            <p>{!! $AboutUsValues3->detail_en ?? '-' !!}</p>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-12 col-sm-4">
                                        <div class="value-gis-main-card">
                                            <img src="{{ asset($AboutUsValues1->image_main) }}" class="w-100" alt="">
                                            <div class="topic topic1">
                                                <h2 class="h2">{!! $AboutUsValues1->tilte_th ?? '-' !!}</h2>
                                            </div>
                                            <p>{!! $AboutUsValues1->detail_th ?? '-' !!}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="value-gis-main-card">
                                            <img src="{{ asset($AboutUsValues2->image_main) }}" class="w-100" alt="">
                                            <div class="topic topic1">
                                                <h2 class="h2">{!! $AboutUsValues2->tilte_th ?? '-' !!}</h2>
                                            </div>
                                            <p>{!! $AboutUsValues2->detail_th ?? '-' !!}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="value-gis-main-card">
                                            <img src="{{ asset($AboutUsValues3->image_main) }}" class="w-100" alt="">
                                            <div class="topic topic1">
                                                <h2 class="h2">{!! $AboutUsValues3->tilte_th ?? '-' !!}</h2>
                                            </div>
                                            <p>{!! $AboutUsValues3->detail_th ?? '-' !!}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 d-none d-lg-block">
                    <div class="nav flex-column nav-pills" id="about-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-About-Us-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><img src="img/about-icon-1.png" alt="" /> About Us</a>
                        <a class="nav-link" id="v-pills-Organiztional-Structure-tab" data-toggle="pill" href="#v-OrganiztionalStructure-tab" role="tab" aria-controls="v-OrganiztionalStructure-tab" aria-selected="false"><img src="img/Organiztional-Structure-icon-1.png" alt="" /> Organizational Structure</a>
                        <a class="nav-link" id="v-pills-Ethics-tab" data-toggle="pill" href="#v-pills-Ethics" role="tab" aria-controls="v-pills-Ethics" aria-selected="false"><img src="img/Ethics-icon-1.png" alt="" /> Ethics</a>
                        <a class="nav-link" id="v-pills-Values-tab" data-toggle="pill" href="#v-pills-Values" role="tab" aria-controls="v-pills-settings" aria-selected="false"><img src="img/Values-icon-1.png" alt="" /> Values</a>
                        <a class="nav-link" id="v-pills-9001-tab" data-toggle="pill" href="#v-pills-9001" role="tab" aria-controls="v-pills-settings" aria-selected="false"><img src="img/ISO9001-icon-1.png" alt="" /> ISO 9001:2015</a>
                        <a class="nav-link" id="v-pills-45001-tab" data-toggle="pill" href="#v-pills-45001" role="tab" aria-controls="v-pills-settings" aria-selected="false"><img src="img/ISO9001-icon-1.png" alt="" /> ISO45001:2018</a>
                        <a class="nav-link" id="v-pills-27001-tab" data-toggle="pill" href="#v-pills-27001" role="tab" aria-controls="v-pills-settings" aria-selected="false"><img src="img/ISO9001-icon-1.png" alt="" /> ISO / IEC 27001:2022
                        </a>
                        <a class="nav-link" id="v-pills-Achievement-tab" data-toggle="pill" href="#v-pills-Achievement" role="tab" aria-controls="v-pills-settings" aria-selected="false"><img src="img/Achievement-icon-1.png" alt="" /> Achievement
                        </a>
                        <a class="nav-link" id="v-pills-WhyChoose-tab" data-toggle="pill" href="#v-pills-why" role="tab" aria-controls="v-pills-why" aria-selected="false"><img src="img/WhyChoose-icon-1.png" alt="" /> Why Choose</a>
                        <a class="nav-link" id="v-pills-Policy-tab" data-toggle="pill"
                        href="#v-pills-Policy" role="tab" aria-controls="v-pills-Policy" aria-selected="false">
                            <img src="{{ asset('img/policy-icon.PNG') }}" alt="Policy" style="width: 28px; height: 28px; object-fit: contain; margin-right: 10px;" /> Policy
                        </a>
                        <a class="nav-link" id="v-pills-Carbon-tab" data-toggle="pill"
                        href="#v-pills-Carbon" role="tab" aria-controls="v-pills-Carbon" aria-selected="false">
                            <img src="{{ asset('img/Carbon-icon.PNG') }}" alt="Carbon Footprint" style="width: 28px; height: 28px; object-fit: contain; margin-right: 10px;" /> Carbon Footprint
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- our_business --}}
<section id="our_business" class="section home-our_business">
    <div class="container-fluid">
        <div class="text-center">
            <img src="img/biz-line-1.png" alt="" />
            <h1 class="h1 color1">OUR BUSSINESS</h1>
        </div>
    </div>
    <div class="content-ourbiz">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-6">
                    @if(Config::get('app.locale') == 'en')
                    <h1 class="h1">{{ $MainHome->tilte_en }}</h1>
                    <h2 class="h2">{{ $MainHome->sub_tilte_en }}</h2>
                    @else
                    <h1 class="h1">{{ $MainHome->tilte_th }}</h1>
                    <h2 class="h2">{{ $MainHome->sub_tilte_th }}</h2>
                    @endif
                    <div class="nav nav-pills justify-content-center justify-content-xl-start" id="v-our_business-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link nav-biz active" id="v-pills-epc-tab" data-toggle="pill" href="#v-pills-epc" role="tab" data-secondary="#v-pills-epc2" aria-controls="v-pills-epc" aria-selected="true">
                            {{-- <img src="{{ asset($EPC->image_icon) }}" alt="" /> --}}
                            <img src="img/biz-icon1.png" alt="" />
                            @if(Config::get('app.locale') == 'en')
                            <p>{{ $EPC->tilte_en }}</p>
                            @else
                            <p>{{ $EPC->tilte_th }}</p>
                            @endif
                        </a>
                        <a class="nav-link nav-biz" id="v-pills-ibt-tab" data-toggle="pill" href="#v-pills-ibt" role="tab" aria-controls="v-pills-ibt" data-secondary="#v-pills-ibt2" aria-selected="false">
                            {{-- <img src="{{ asset($IBT->image_icon) }}" alt="" /> --}}
                            <img src="img/biz-icon2.png" alt="" />
                            @if(Config::get('app.locale') == 'en')
                            <p>{{ $IBT->tilte_en }}</p>
                            @else
                            <p>{{ $IBT->tilte_th }}</p>
                            @endif
                        </a>
                        <a class="nav-link nav-biz" id="v-pills-enr-tab" data-toggle="pill" href="#v-pills-enr" role="tab" aria-controls="v-pills-enr" data-secondary="#v-pills-enr2" aria-selected="false">
                            {{-- <img src="{{ asset($ENR->image_icon) }}" alt="" /> --}}
                            <img src="img/biz-icon3.png" alt="" />
                            @if(Config::get('app.locale') == 'en')
                            <p>{{ $ENR->tilte_en }}</p>
                            @else
                            <p>{{ $ENR->tilte_th }}</p>
                            @endif
                        </a>
                    </div>
                    <div class="tab-content" id="v-our_business-tabContent2">
                        <div class="tab-pane fade  show active" id="v-pills-epc2" role="tabpanel" aria-labelledby="v-pills-epc2-tab">
                            <div class="card">
                                @if(Config::get('app.locale') == 'en')
                                <div class="text1">{{ $EPCHome->sub_tilte_en ?? '-'}}</div>
                                <h1 class="h1">{{ $EPCHome->tilte_en ?? '-'}}</h1>
                                <p>
                                    {!! $EPCHome->detail_en ?? '-' !!}
                                    <a href="/business-epc">Read More</a>
                                </p>
                                @else
                                <div class="text1">{{ $EPCHome->sub_tilte_th ?? '-'}}</div>
                                <h1 class="h1">{{ $EPCHome->tilte_th ?? '-'}}</h1>
                                <p>
                                    {!! $EPCHome->detail_th ?? '-' !!}
                                    <a href="/business-epc">Read More</a>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-ibt2" role="tabpanel" aria-labelledby="v-pills-ibt2-tab">
                            <div class="card">
                                @if(Config::get('app.locale') == 'en')
                                <div class="text1">{{ $IBTHome->sub_tilte_en }}</div>
                                <h1 class="h1">{{ $IBTHome->tilte_en }}</h1>
                                <p>
                                    {!! $IBTHome->detail_en ?? '-' !!}
                                    <a href="/business-ibt">Read More</a>
                                </p>
                                @else
                                <div class="text1">{{ $IBTHome->sub_tilte_th ?? '-'}}</div>
                                <h1 class="h1">{{ $IBTHome->tilte_th ?? '-'}}</h1>
                                <p>
                                    {!! $IBTHome->detail_th ?? '-' !!}
                                    <a href="/business-ibt">Read More</a>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-enr2" role="tabpanel" aria-labelledby="v-pills-enr2-tab">
                            <div class="card">
                                @if(Config::get('app.locale') == 'en')
                                <div class="text1">{{ $ENRHome->sub_tilte_en ?? '-'}}</div>
                                <h1 class="h1">{{ $ENRHome->tilte_en ?? '-'}}</h1>
                                <p>
                                    {!! $ENRHome->detail_en ?? '-' !!}
                                    <a href="/business-enr">Read More</a>
                                </p>
                                @else
                                <div class="text1">{{ $ENRHome->sub_tilte_th ?? '-'}}</div>
                                <h1 class="h1">{{ $ENRHome->tilte_th ?? '-'}}</h1>
                                <p>
                                    {!! $ENRHome->detail_th ?? '-' !!}
                                    <a href="/business-enr">Read More</a>
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    @php
                        $getYoutubeEmbed = function($link) {
                            if (empty($link)) return '';
                            $link = trim($link);
                            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link, $match)) {
                                return 'https://www.youtube.com/embed/' . $match[1] . '?rel=0&vq=hd1080';
                            }
                            return 'https://www.youtube.com/embed/' . $link . '?rel=0&vq=hd1080';
                        };
                    @endphp
                    <div class="tab-content" id="v-our_business-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-epc" role="tabpanel" aria-labelledby="v-pills-epc-tab">
                            <div class="content-about">
                                @if(empty($EPCHome->link_VDO))
                                <img class="w-100" style="aspect-ratio: 16/9; object-fit: cover; border-radius: 8px;" src="{{ asset($EPCHome->image_VDO) }}" alt="" />
                                @else
                                <iframe class="w-100" style="aspect-ratio: 16/9; height: auto; min-height: 315px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.25);" src="{{ $getYoutubeEmbed($EPCHome->link_VDO) }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-ibt" role="tabpanel" aria-labelledby="v-pills-ibt-tab">
                            <div class="content-about">
                                @if(empty($IBTHome->link_VDO))
                                <img class="w-100" style="aspect-ratio: 16/9; object-fit: cover; border-radius: 8px;" src="{{ asset($IBTHome->image_VDO) }}" alt="" />
                                @else
                                <iframe class="w-100 biz-lazy-iframe" style="aspect-ratio: 16/9; height: auto; min-height: 315px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.25);" data-src="{{ $getYoutubeEmbed($IBTHome->link_VDO) }}" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-enr" role="tabpanel" aria-labelledby="v-pills-enr-tab">
                            <div class="content-about">
                                @if(empty($ENRHome->link_VDO))
                                <img class="w-100" style="aspect-ratio: 16/9; object-fit: cover; border-radius: 8px;" src="{{ asset($ENRHome->image_VDO) }}" alt="" />
                                @else
                                <iframe class="w-100 biz-lazy-iframe" style="aspect-ratio: 16/9; height: auto; min-height: 315px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.25);" data-src="{{ $getYoutubeEmbed($ENRHome->link_VDO) }}" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
{{-- pdandservice --}}
<section id="pdandservice" class="section home-pdandservice">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6"></div>
            <div class="col-12 col-sm-6">
                <div class="card-projectref">
                    @if(Config::get('app.locale') == 'en')
                    <h1 class="h1">{{ $ProductServicesHome->tilte_en }}</h1>
                    @else
                    <h1 class="h1">{{ $ProductServicesHome->tilte_th }}</h1>
                    @endif
                    <div class="content">
                        @if(Config::get('app.locale') == 'en')
                        {!! $ProductServicesHome->detail_en !!}
                        @else
                        {!! $ProductServicesHome->detail_th !!}
                        @endif
                        <a class="btn btn-second" href="/product-and-service">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <img class="Helmet" src="img/Helmet.png" alt="" />
    </div>
</section>
{{-- projectref --}}
<section id="projectref" class="section home-projectref">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="slider-projectref">
                <div class="row align-items-center">
                    <div class="col-12 col-xl-3">
                        <div class="button-group filters-button-group">
                            <a class="button js-filter btn-slider1 active" data-filter=".HiglightProject">
                                <div>
                                    <span>
                                        @if(Config::get('app.locale') == 'en')
                                        {!! $HiglightProject->tilte_en !!}
                                        @else
                                        {!! $HiglightProject->tilte_th !!}
                                        @endif
                                    </span>
                                </div>
                            </a>
                            <a class="button js-filter website btn-slider2" data-filter=".category-Commercial">
                                <div>
                                    <span>@if(Config::get('app.locale') == 'en')
                                        {!! $Commercial->tilte_en !!}
                                        @else
                                        {!! $Commercial->tilte_th !!}
                                        @endif
                                    </span>
                                </div>
                            </a>
                            <a class="button js-filter btn-slider3" data-filter=".category-Residential">
                                <div>
                                    <span>@if(Config::get('app.locale') == 'en')
                                        {!! $Residential->tilte_en !!}
                                        @else
                                        {!! $Residential->tilte_th !!}
                                        @endif
                                    </span>
                                </div>
                            </a>
                            <a class="button js-filter btn-slider4" data-filter=".category-Health">
                                <div>
                                    <span>
                                        @if(Config::get('app.locale') == 'en')
                                        {!! $Health->tilte_en !!}
                                        @else
                                        {!! $Health->tilte_th !!}
                                        @endif
                                    </span>
                                </div>
                            </a>
                            <a class="button js-filter btn-slider5" data-filter=".category-Government">
                                <div>
                                    <span>
                                        @if(Config::get('app.locale') == 'en')
                                        {!! $Government->tilte_en !!}
                                        @else
                                        {!! $Government->tilte_th !!}
                                        @endif
                                    </span>
                                </div>
                            </a>
                            <a class="button js-filter btn-slider6" data-filter=".category-Industrial">
                                <div>
                                    <span>
                                        @if(Config::get('app.locale') == 'en')
                                        {!! $Industrial->tilte_en !!}
                                        @else
                                        {!! $Industrial->tilte_th !!}
                                        @endif
                                    </span>
                                </div>
                            </a>
                            <a class="button js-filter btn-slider7" data-filter=".category-CriticalSpace">
                                <div>
                                    <span>
                                        @if(Config::get('app.locale') == 'en')
                                        {!! $CriticalSpace->tilte_en !!}
                                        @else
                                        {!! $CriticalSpace->tilte_th !!}
                                        @endif
                                    </span>
                                </div>
                            </a>
                            <a class="button js-filter btn-slider8" data-filter=".category-Construction">
                                <div>
                                    <span>
                                        @if(Config::get('app.locale') == 'en')
                                        {!! $Construction->tilte_en !!}
                                        @else
                                        {!! $Construction->tilte_th !!}
                                        @endif
                                    </span>
                                </div>
                            </a>
                            <a class="button js-filter btn-slider9" data-filter=".category-Hotel">
                                <div>
                                    <span>
                                        @if(Config::get('app.locale') == 'en')
                                        {!! $Hotel->tilte_en !!}
                                        @else
                                        {!! $Hotel->tilte_th !!}
                                        @endif
                                    </span>
                                </div>
                            </a>
                            <a class="button js-filter btn-slider10" data-filter=".category-Others">
                                <div>
                                    <span>
                                        @if(Config::get('app.locale') == 'en')
                                        {!! $Others->tilte_en !!}
                                        @else
                                        {!! $Others->tilte_th !!}
                                        @endif
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-xl-2">
                        <div class="slick-nav">
                            <h1 class="h1 color1">
                                Projects <br /> Reference
                            </h1>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        <div class="slider2">
                            @foreach($HiglightProjectMain as $key => $data)
                            <div class="slick HiglightProject">
                                <div class="img__wrap">
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}"><img src="{{ asset($data->image_main) }}" /></a>
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}">
                                        <div class="img__description_layer">
                                            <p class="img__description">
                                                @if(Config::get('app.locale') == 'en')
                                                Project Name : {{$data->tilte_en}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @else
                                                Project Name : {{$data->tilte_th}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @foreach($CommercialMain as $key => $data)
                            <div class="slick category-Commercial">
                                <div class="img__wrap">
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}"><img src="{{ asset($data->image_main) }}" /></a>
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}">
                                        <div class="img__description_layer">
                                            <p class="img__description">
                                                @if(Config::get('app.locale') == 'en')
                                                Project Name : {{$data->tilte_en}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @else
                                                Project Name : {{$data->tilte_th}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @foreach($ResidentialMain as $key => $data)
                            <div class="slick category-Residential">
                                <div class="img__wrap">
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}"><img src="{{ asset($data->image_main) }}" /></a>
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}">
                                        <div class="img__description_layer">
                                            <p class="img__description">
                                                @if(Config::get('app.locale') == 'en')
                                                Project Name : {{$data->tilte_en}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @else
                                                Project Name : {{$data->tilte_th}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @foreach($HealthMain as $key => $data)
                            <div class="slick category-Health">
                                <div class="img__wrap">
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}"><img src="{{ asset($data->image_main) }}" /></a>
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}">
                                        <div class="img__description_layer">
                                            <p class="img__description">
                                                @if(Config::get('app.locale') == 'en')
                                                Project Name : {{$data->tilte_en}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @else
                                                Project Name : {{$data->tilte_th}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @foreach($GovernmentMain as $key => $data)
                            <div class="slick category-Government">
                                <div class="img__wrap">
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}"><img src="{{ asset($data->image_main) }}" /></a>
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}">
                                        <div class="img__description_layer">
                                            <p class="img__description">
                                                @if(Config::get('app.locale') == 'en')
                                                Project Name : {{$data->tilte_en}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @else
                                                Project Name : {{$data->tilte_th}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @foreach($IndustrialMain as $key => $data)
                            <div class="slick category-Industrial">
                                <div class="img__wrap">
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}"><img src="{{ asset($data->image_main) }}" /></a>
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}">
                                        <div class="img__description_layer">
                                            <p class="img__description">
                                                @if(Config::get('app.locale') == 'en')
                                                Project Name : {{$data->tilte_en}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @else
                                                Project Name : {{$data->tilte_th}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @foreach($CriticalSpaceMain as $key => $data)
                            <div class="slick category-CriticalSpace">
                                <div class="img__wrap">
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}"><img src="{{ asset($data->image_main) }}" /></a>
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}">
                                        <div class="img__description_layer">
                                            <p class="img__description">
                                                @if(Config::get('app.locale') == 'en')
                                                Project Name : {{$data->tilte_en}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @else
                                                Project Name : {{$data->tilte_th}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @foreach($ConstructionMain as $key => $data)
                            <div class="slick category-Construction">
                                <div class="img__wrap">
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}"><img src="{{ asset($data->image_main) }}" /></a>
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}">
                                        <div class="img__description_layer">
                                            <p class="img__description">
                                                @if(Config::get('app.locale') == 'en')
                                                Project Name : {{$data->tilte_en}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @else
                                                Project Name : {{$data->tilte_th}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @foreach($HotelMain as $key => $data)
                            <div class="slick category-Hotel">
                                <div class="img__wrap">
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}"><img src="{{ asset($data->image_main) }}" /></a>
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}">
                                        <div class="img__description_layer">
                                            <p class="img__description">
                                                @if(Config::get('app.locale') == 'en')
                                                Project Name : {{$data->tilte_en}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @else
                                                Project Name : {{$data->tilte_th}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @foreach($OthersMain as $key => $data)
                            <div class="slick category-Others">
                                <div class="img__wrap">
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}"><img src="{{ asset($data->image_main) }}" /></a>
                                    <a href="{{url('/project-detail' . '/' . $data->id )}}">
                                        <div class="img__description_layer">
                                            <p class="img__description">
                                                @if(Config::get('app.locale') == 'en')
                                                Project Name : {{$data->tilte_en}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @else
                                                Project Name : {{$data->tilte_th}} <br />
                                                Value : {{$data->project_value}} Million<br />
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- news --}}
<section id="news" class="section home-news">
    <div class="text-center">
        <img src="{{ asset('img/line-news.png') }}" alt="" />
        <h1 class="h1 mt-2 color1">NEWS & EVENT</h1>
    </div>
    @php
    $totalNews = (count($NewEventsMain) % 2 == 0) ? count($NewEventsMain) : (count($NewEventsMain) + 1);
    @endphp
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @if(isset($NewEventsMain[0]))
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            @endif
            @if(isset($NewEventsMain[2]))
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            @endif
            @if(isset($NewEventsMain[4]))
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            @endif
            @if(isset($NewEventsMain[6]))
            <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
            @endif
            @if(isset($NewEventsMain[8]))
            <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
            @endif
            @if(isset($NewEventsMain[10]))
            <li data-target="#carouselExampleCaptions" data-slide-to="5"></li>
            @endif
            @if(isset($NewEventsMain[12]))
            <li data-target="#carouselExampleCaptions" data-slide-to="6"></li>
            @endif
            @if(isset($NewEventsMain[14]))
            <li data-target="#carouselExampleCaptions" data-slide-to="7"></li>
            @endif
            @if(isset($NewEventsMain[16]))
            <li data-target="#carouselExampleCaptions" data-slide-to="8"></li>
            @endif
            @if(isset($NewEventsMain[18]))
            <li data-target="#carouselExampleCaptions" data-slide-to="9"></li>
            @endif
            @if(isset($NewEventsMain[20]))
            <li data-target="#carouselExampleCaptions" data-slide-to="10"></li>
            @endif
            @if(isset($NewEventsMain[22]))
            <li data-target="#carouselExampleCaptions" data-slide-to="11"></li>
            @endif
            @if(isset($NewEventsMain[24]))
            <li data-target="#carouselExampleCaptions" data-slide-to="12"></li>
            @endif
            @if(isset($NewEventsMain[26]))
            <li data-target="#carouselExampleCaptions" data-slide-to="13"></li>
            @endif
            @if(isset($NewEventsMain[28]))
            <li data-target="#carouselExampleCaptions" data-slide-to="14"></li>
            @endif
            @if(isset($NewEventsMain[30]))
            <li data-target="#carouselExampleCaptions" data-slide-to="15"></li>
            @endif
            @if(isset($NewEventsMain[32]))
            <li data-target="#carouselExampleCaptions" data-slide-to="16"></li>
            @endif
            @if(isset($NewEventsMain[34]))
            <li data-target="#carouselExampleCaptions" data-slide-to="17"></li>
            @endif
            @if(isset($NewEventsMain[36]))
            <li data-target="#carouselExampleCaptions" data-slide-to="18"></li>
            @endif
            @if(isset($NewEventsMain[38]))
            <li data-target="#carouselExampleCaptions" data-slide-to="19"></li>
            @endif
            @if(isset($NewEventsMain[40]))
            <li data-target="#carouselExampleCaptions" data-slide-to="20"></li>
            @endif
            @if(isset($NewEventsMain[42]))
            <li data-target="#carouselExampleCaptions" data-slide-to="21"></li>
            @endif
            @if(isset($NewEventsMain[44]))
            <li data-target="#carouselExampleCaptions" data-slide-to="22"></li>
            @endif
            @if(isset($NewEventsMain[46]))
            <li data-target="#carouselExampleCaptions" data-slide-to="23"></li>
            @endif
            @if(isset($NewEventsMain[48]))
            <li data-target="#carouselExampleCaptions" data-slide-to="24"></li>
            @endif
            @if(isset($NewEventsMain[50]))
            <li data-target="#carouselExampleCaptions" data-slide-to="25"></li>
            @endif
            @if(isset($NewEventsMain[52]))
            <li data-target="#carouselExampleCaptions" data-slide-to="26"></li>
            @endif
            @if(isset($NewEventsMain[54]))
            <li data-target="#carouselExampleCaptions" data-slide-to="27"></li>
            @endif
            @if(isset($NewEventsMain[56]))
            <li data-target="#carouselExampleCaptions" data-slide-to="28"></li>
            @endif
            @if(isset($NewEventsMain[58]))
            <li data-target="#carouselExampleCaptions" data-slide-to="29"></li>
            @endif
            @if(isset($NewEventsMain[60]))
            <li data-target="#carouselExampleCaptions" data-slide-to="30"></li>
            @endif
            @if(isset($NewEventsMain[62]))
            <li data-target="#carouselExampleCaptions" data-slide-to="31"></li>
            @endif
            @if(isset($NewEventsMain[64]))
            <li data-target="#carouselExampleCaptions" data-slide-to="32"></li>
            @endif
            @if(isset($NewEventsMain[66]))
            <li data-target="#carouselExampleCaptions" data-slide-to="33"></li>
            @endif
            @if(isset($NewEventsMain[68]))
            <li data-target="#carouselExampleCaptions" data-slide-to="34"></li>
            @endif
            @if(isset($NewEventsMain[70]))
            <li data-target="#carouselExampleCaptions" data-slide-to="35"></li>
            @endif
            @if(isset($NewEventsMain[72]))
            <li data-target="#carouselExampleCaptions" data-slide-to="36"></li>
            @endif
            @if(isset($NewEventsMain[74]))
            <li data-target="#carouselExampleCaptions" data-slide-to="37"></li>
            @endif
            @if(isset($NewEventsMain[76]))
            <li data-target="#carouselExampleCaptions" data-slide-to="38"></li>
            @endif
            @if(isset($NewEventsMain[78]))
            <li data-target="#carouselExampleCaptions" data-slide-to="39"></li>
            @endif
            @if(isset($NewEventsMain[80]))
            <li data-target="#carouselExampleCaptions" data-slide-to="40"></li>
            @endif
            @if(isset($NewEventsMain[82]))
            <li data-target="#carouselExampleCaptions" data-slide-to="41"></li>
            @endif
            @if(isset($NewEventsMain[84]))
            <li data-target="#carouselExampleCaptions" data-slide-to="42"></li>
            @endif
            @if(isset($NewEventsMain[86]))
            <li data-target="#carouselExampleCaptions" data-slide-to="43"></li>
            @endif
            @if(isset($NewEventsMain[88]))
            <li data-target="#carouselExampleCaptions" data-slide-to="44"></li>
            @endif
            @if(isset($NewEventsMain[90]))
            <li data-target="#carouselExampleCaptions" data-slide-to="45"></li>
            @endif
            @if(isset($NewEventsMain[92]))
            <li data-target="#carouselExampleCaptions" data-slide-to="46"></li>
            @endif
            @if(isset($NewEventsMain[94]))
            <li data-target="#carouselExampleCaptions" data-slide-to="47"></li>
            @endif
            @if(isset($NewEventsMain[96]))
            <li data-target="#carouselExampleCaptions" data-slide-to="48"></li>
            @endif
            @if(isset($NewEventsMain[98]))
            <li data-target="#carouselExampleCaptions" data-slide-to="49"></li>
            @endif
            @if(isset($NewEventsMain[100]))
            <li data-target="#carouselExampleCaptions" data-slide-to="50"></li>
            @endif
        </ol>
        <div class="carousel-inner">
            @if(isset($NewEventsMain[0]))
            <div class="carousel-item active">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[0]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[0]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[0]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[0]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[0]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[0]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[0]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[0]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[1]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[1]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[1]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[1]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[1]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[1]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[1]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[1]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[2]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[2]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[2]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[2]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[2]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[2]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[2]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[2]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[2]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[3]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[3]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[3]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[3]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[3]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[3]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[3]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[3]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[4]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[4]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[4]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[4]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[4]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[4]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[4]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[4]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[4]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[5]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[5]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[5]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[5]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[5]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[5]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[5]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[5]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[6]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[6]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[6]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[6]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[6]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[6]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[6]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[6]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[6]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[7]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[7]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[7]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[7]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[7]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[7]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[7]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[7]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[8]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[8]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[8]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[8]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[8]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[8]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[8]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[8]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[8]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[9]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[9]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[9]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[9]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[9]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[9]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[9]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[9]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[10]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[10]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[10]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[10]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[10]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[10]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[10]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[10]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[10]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[11]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[11]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[11]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[11]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[11]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[11]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[11]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[11]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[12]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[12]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[12]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[12]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[12]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[12]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[12]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[12]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[12]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[13]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[13]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[13]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[13]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[13]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[13]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[13]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[13]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[14]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[14]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[14]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[14]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[14]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[14]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[14]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[14]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[14]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[15]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[15]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[15]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[15]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[15]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[15]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[15]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[15]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[16]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[16]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[16]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[16]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[16]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[16]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[16]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[16]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[16]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[17]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[17]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[17]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[17]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[17]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[17]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[17]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[17]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[18]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[18]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[18]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[18]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[18]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[18]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[18]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[18]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[18]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[19]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[19]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[19]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[19]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[19]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[19]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[19]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[19]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[20]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[20]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[20]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[20]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[20]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[20]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[20]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[20]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[20]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[21]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[21]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[21]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[21]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[21]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[21]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[21]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[21]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[22]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[22]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[22]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[22]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[22]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[22]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[22]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[22]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[22]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[23]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[23]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[23]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[23]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[23]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[23]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[23]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[23]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[24]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[24]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[24]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[24]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[24]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[24]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[24]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[24]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[24]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[25]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[25]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[25]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[25]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[25]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[25]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[25]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[25]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[26]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[26]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[26]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[26]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[26]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[26]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[26]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[26]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[26]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[27]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[27]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[27]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[27]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[27]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[27]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[27]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[27]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[28]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[28]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[28]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[28]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[28]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[28]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[28]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[28]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[28]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[29]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[29]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[29]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[29]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[29]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[29]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[29]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[29]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[30]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[30]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[30]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[30]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[30]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[30]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[30]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[30]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[30]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[31]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[31]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[31]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[31]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[31]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[31]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[31]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[31]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[32]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[32]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[32]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[32]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[32]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[32]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[32]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[32]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[32]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[33]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[33]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[33]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[33]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[33]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[33]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[33]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[33]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[34]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[34]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[34]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[34]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[34]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[34]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[34]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[34]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[34]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[35]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[35]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[35]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[35]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[35]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[35]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[35]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[35]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[36]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[36]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[36]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[36]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[36]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[36]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[36]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[36]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[36]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[37]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[37]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[37]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[37]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[37]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[37]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[37]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[37]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[38]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[38]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[38]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[38]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[38]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[38]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[38]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[38]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[38]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[39]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[39]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[39]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[39]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[39]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[39]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[39]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[39]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[40]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[40]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[40]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[40]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[40]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[40]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[40]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[40]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[40]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[41]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[41]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[41]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[41]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[41]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[41]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[41]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[41]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[42]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[42]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[42]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[42]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[42]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[42]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[42]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[42]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[42]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[43]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[43]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[43]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[43]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[43]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[43]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[43]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[43]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[44]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[44]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[44]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[44]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[44]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[44]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[44]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[44]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[44]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[45]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[45]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[45]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[45]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[45]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[45]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[45]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[45]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[46]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[46]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[46]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[46]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[46]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[46]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[46]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[46]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[46]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[47]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[47]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[47]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[47]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[47]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[47]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[47]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[47]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[48]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[48]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[48]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[48]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[48]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[48]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[48]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[48]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[48]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[49]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[49]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[49]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[49]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[49]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[49]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[49]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[49]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[50]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[50]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[50]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[50]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[50]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[50]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[50]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[50]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[50]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[51]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[51]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[51]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[51]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[51]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[51]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[51]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[51]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[52]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[52]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[52]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[52]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[52]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[52]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[52]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[52]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[52]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[53]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[53]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[53]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[53]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[53]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[53]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[53]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[53]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[54]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[54]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[54]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[54]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[54]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[54]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[54]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[54]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[54]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[55]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[55]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[55]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[55]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[55]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[55]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[55]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[55]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[56]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[56]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[56]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[56]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[56]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[56]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[56]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[56]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[56]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[57]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[57]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[57]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[57]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[57]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[57]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[57]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[57]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[58]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[58]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[58]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[58]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[58]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[58]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[58]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[58]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[58]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[59]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[59]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[59]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[59]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[59]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[59]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[59]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[59]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[60]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[60]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[60]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[60]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[60]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[60]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[60]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[60]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[60]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[61]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[61]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[61]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[61]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[61]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[61]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[61]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[61]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[62]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[62]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[62]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[62]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[62]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[62]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[62]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[62]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[62]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[63]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[63]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[63]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[63]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[63]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[63]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[63]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[63]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[64]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[64]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[64]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[64]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[64]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[64]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[64]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[64]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[64]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[65]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[65]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[65]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[65]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[65]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[65]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[65]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[65]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[66]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[66]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[66]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[66]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[66]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[66]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[66]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[66]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[66]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[67]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[67]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[67]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[67]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[67]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[67]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[67]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[67]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[68]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[68]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[68]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[68]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[68]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[68]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[68]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[68]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[68]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[69]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[69]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[69]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[69]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[69]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[69]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[69]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[69]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[70]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[70]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[70]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[70]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[70]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[70]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[70]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[70]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[70]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[71]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[71]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[71]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[71]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[71]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[71]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[71]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[71]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[72]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[72]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[72]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[72]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[72]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[72]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[72]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[72]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[72]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[73]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[73]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[73]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[73]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[73]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[73]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[73]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[73]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[74]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[74]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[74]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[74]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[74]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[74]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[74]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[74]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[74]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[75]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[75]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[75]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[75]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[75]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[75]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[75]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[75]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[76]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[76]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[76]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[76]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[76]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[76]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[76]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[76]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[76]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[77]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[77]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[77]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[77]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[77]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[77]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[77]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[77]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[78]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[78]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[78]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[78]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[78]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[78]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[78]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[78]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[78]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[79]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[79]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[79]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[79]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[79]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[79]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[79]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[79]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[80]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[80]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[80]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[80]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[80]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[80]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[80]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[80]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[80]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[81]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[81]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[81]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[81]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[81]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[81]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[81]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[81]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[82]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[82]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[82]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[82]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[82]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[82]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[82]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[82]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[82]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[83]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[83]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[83]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[83]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[83]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[83]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[83]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[83]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[84]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[84]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[84]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[84]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[84]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[84]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[84]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[84]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[84]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[85]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[85]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[85]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[85]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[85]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[85]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[85]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[85]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[86]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[86]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[86]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[86]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[86]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[86]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[86]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[86]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[86]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[87]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[87]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[87]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[87]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[87]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[87]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[87]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[87]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[88]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[88]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[88]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[88]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[88]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[88]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[88]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[88]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[88]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[89]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[89]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[89]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[89]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[89]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[89]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[89]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[89]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[90]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[90]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[90]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[90]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[90]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[90]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[90]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[90]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[90]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[91]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[91]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[91]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[91]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[91]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[91]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[91]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[91]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[92]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[92]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[92]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[92]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[92]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[92]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[92]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[92]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[92]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[93]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[93]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[93]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[93]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[93]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[93]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[93]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[93]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[94]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[94]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[94]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[94]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[94]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[94]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[94]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[94]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[94]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[95]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[95]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[95]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[95]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[95]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[95]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[95]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[95]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[96]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[96]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[96]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[96]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[96]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[96]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[96]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[96]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[96]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[97]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[97]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[97]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[97]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[97]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[97]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[97]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[97]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(isset($NewEventsMain[98]))
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        @if(isset($NewEventsMain[98]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[98]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[98]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[98]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[98]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[98]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[98]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[98]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                        @if(isset($NewEventsMain[99]))
                        <div class="col-12 col-lg-6">
                            <div class="news-card">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="show-imgnews">
                                                <img src="{{ asset($NewEventsMain[99]->image_main) }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p>
                                                    <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp; {{ $NewEventsMain[99]->date }}
                                                </p>
                                                @if(Config::get('app.locale') == 'en')
                                                <h5 class="h5">{{ $NewEventsMain[99]->tilte_en }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[99]->detail_en  ?? '-' !!}</p>
                                                @else
                                                <h5 class="h5">{{ $NewEventsMain[99]->tilte_th }}</h5>
                                                <p class="card-text">{!! $NewEventsMain[99]->detail_th ?? '-' !!}</p>
                                                @endif
                                                <a href="{{url('/new-detail' . '/' . $NewEventsMain[99]->id )}}" class="btn btn-second">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardout"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <img src="img/news-pv.png" alt="" />
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <img src="img/news-next.png" alt="" />
            <span class="sr-only">Next</span>
        </a>
    </div>

</section>
{{-- career --}}
<section id="career" class="section home-career">
    <div class="text-center">
        <img src="{{ asset('img/line-career.png') }}" alt="" />
        <div class="justify-content-center head">
            @if(Config::get('app.locale') == 'en')
            <h1 class="h1 mt-2 color1">{{ $CAREER->tilte_en }}</h1>
            <div>
                <p class="mb-0">{!! $CAREER->detail_en !!}</p>
                <h5>{!! $CAREER->subdetail_en !!}</h5>
            </div>
            @else
            <h1 class="h1 mt-2 color1">{{ $CAREER->tilte_th }}</h1>
            <div>
                <p class="mb-0">{!! $CAREER->detail_th !!}</p>
                <h5>{!! $CAREER->subdetail_th !!}</h5>
            </div>
            @endif
        </div>
    </div>
    <div class="container-fluid">
        <div class="row  justify-content-center">
            <div class="col-12 col-lg-4">
                <div class="card-career card-career1">
                    @if(Config::get('app.locale') == 'en')
                    <h5 class="h5">{!! $COMPETITIVE_SALARY->tilte_en !!}</h5>
                    {!! $COMPETITIVE_SALARY->detail_en !!}
                    @else
                    <h5 class="h5">{!! $COMPETITIVE_SALARY->tilte_th !!}</h5>
                    {!! $COMPETITIVE_SALARY->detail_th !!}
                    @endif
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card-career2 card-career">
                    @if(Config::get('app.locale') == 'en')
                    <h5 class="h5">{!! $CASH_INCENTIVE->tilte_en !!}</h5>
                    {!! $CASH_INCENTIVE->detail_en !!}
                    @else
                    <h5 class="h5">{!! $CASH_INCENTIVE->tilte_th !!}</h5>
                    {!! $CASH_INCENTIVE->detail_th !!}
                    @endif
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card-career3 card-career">
                    @if(Config::get('app.locale') == 'en')
                    <h5 class="h5">{!! $BENEFITS->tilte_en !!}</h5>
                    {!! $BENEFITS->detail_en !!}
                    @else
                    <h5 class="h5">{!! $BENEFITS->tilte_th !!}</h5>
                    {!! $BENEFITS->detail_th !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="career-apply">
        <div class="text-center">
            <img src="{{ asset('img/line-career.png') }}" alt="" />
            <div class="justify-content-center head">
                @if(Config::get('app.locale') == 'en')
                <h1 class="h1 mt-2 color2">{{ $APPLY->tilte_en }}</h1>
                <div>
                    <p class="mb-0 text-white text-uppercase">{!! $APPLY->detail_en !!}</p>
                    {!! $APPLY->subdetail_en !!}
                </div>
                @else
                <h1 class="h1 mt-2 color2">{{ $APPLY->tilte_th }}</h1>
                <div>
                    <p class="mb-0 text-white text-uppercase">{!! $APPLY->detail_th !!}</p>
                    {!! $APPLY->subdetail_th !!}
                </div>
                @endif
            </div>
        </div>

        <div class="container-fluid">
            <div class="row  justify-content-center">
                <div class="col-12 col-lg-4">
                    <div class="card-career3 card-career">
                        @if(Config::get('app.locale') == 'en')
                        <h5 class="h5 text-white"> {!! $Business_Support->tilte_en !!}</h5>
                        <div class="d-flex">{!! $Business_Support->detail_en !!}</div>
                        @else
                        <h5 class="h5 text-white"> {!! $Business_Support->tilte_th !!}</h5>
                        <div class="d-flex">{!! $Business_Support->detail_th !!}</div>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card-career1 card-career">
                        @if(Config::get('app.locale') == 'en')
                        <h5 class="h5 text-white"> {!! $Mechanical_Electrical->tilte_en !!}</h5>
                        <div class="d-flex">{!! $Mechanical_Electrical->detail_en !!}</div>
                        @else
                        <h5 class="h5 text-white"> {!! $Mechanical_Electrical->tilte_th !!}</h5>
                        <div class="d-flex">{!! $Mechanical_Electrical->detail_th !!}</div>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card-career2 card-career">
                        @if(Config::get('app.locale') == 'en')
                        <h5 class="h5 text-white"> {!! $Building_Technologies_System->tilte_en !!}</h5>
                        <div class="d-flex">{!! $Building_Technologies_System->detail_en !!}</div>
                        @else
                        <h5 class="h5 text-white"> {!! $Building_Technologies_System->tilte_th !!}</h5>
                        <div class="d-flex">{!! $Building_Technologies_System->detail_th !!}</div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
{{-- contact --}}
<section id="map-contact" class="section home-map-contact">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="card">
                    <h1 class="h1 color1" style="margin-top: 15px;">CONTACT US</h1>
                    <form class="from-horizontal" method="post" enctype="multipart/form-data" action="{{ route('contactregister.index') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" name="full_name" id="fullname" placeholder="Full name" aria-describedby="">
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="col">
                                <input type="text" name="telephone" class="form-control" placeholder="Telephone">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="topic" class="form-control" id="" placeholder="Topic">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="details" id="" placeholder="Detail" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <center>
                                <div class="g-recaptcha" data-sitekey="6LegqiUdAAAAAKoGv3A5uc5M1bEvW5C-mB-73f8l" data-callback="enableBtn" required></div>
                                @error('g-recaptcha-response')
                                <span class="pb-1 text-danger d-inline-block"><small>* กรุณาเลือก Recaptcha</small></span>
                                @enderror
                                <span id="check_recapcha" class="pb-1 text-danger d-inline-block"></span>
                            </center>
                        </div>

                        <button type="submit" class="btn btn-second">SEND</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('components.frontend.footer-frontend')
</section>
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        $('.personModal').appendTo("body");
    });

    var isIsoSliding = false;

    function updateIsoDots(container, activeIndex) {
        var dots = container.querySelectorAll('.iso-dot');
        dots.forEach(function(dot, idx) {
            if (idx === activeIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }

    function goToIsoSlide(containerId, targetIndex) {
        if (isIsoSliding) return;
        var container = document.getElementById(containerId);
        if (!container) return;
        var slides = container.querySelectorAll('.iso-slide-item');
        if (slides.length <= 1) return;

        var currentIndex = 0;
        slides.forEach(function(slide, idx) {
            if (slide.classList.contains('active')) {
                currentIndex = idx;
            }
        });

        if (targetIndex === currentIndex || targetIndex < 0 || targetIndex >= slides.length) return;

        var direction = targetIndex > currentIndex ? 1 : -1;
        performSlide(container, slides, currentIndex, targetIndex, direction);
    }

    function changeIsoSlide(containerId, direction) {
        if (isIsoSliding) return;
        var container = document.getElementById(containerId);
        if (!container) return;
        var slides = container.querySelectorAll('.iso-slide-item');
        if (slides.length <= 1) return;
        
        var currentIndex = 0;
        slides.forEach(function(slide, idx) {
            if (slide.classList.contains('active')) {
                currentIndex = idx;
            }
        });
        
        var nextIndex = currentIndex + direction;
        if (nextIndex >= slides.length) nextIndex = 0;
        if (nextIndex < 0) nextIndex = slides.length - 1;
        if (nextIndex === currentIndex) return;
        
        performSlide(container, slides, currentIndex, nextIndex, direction);
    }

    function performSlide(container, slides, currentIndex, nextIndex, direction) {
        isIsoSliding = true;
        var currentSlide = slides[currentIndex];
        var nextSlide = slides[nextIndex];
        
        slides.forEach(function(s) {
            s.className = 'iso-slide-item';
        });
        
        if (direction > 0) {
            currentSlide.classList.add('iso-slide-next-out');
            nextSlide.classList.add('iso-slide-next-in');
        } else {
            currentSlide.classList.add('iso-slide-prev-out');
            nextSlide.classList.add('iso-slide-prev-in');
        }

        updateIsoDots(container, nextIndex);
        
        setTimeout(function() {
            slides.forEach(function(s) {
                s.className = 'iso-slide-item';
            });
            nextSlide.classList.add('active');
            isIsoSliding = false;
        }, 500);
    }

    $(document).ready(function() {
        $('#v-our_business-tab a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr('href');
            var iframe = $(target).find('iframe.biz-lazy-iframe');
            if (iframe.length && iframe.attr('data-src')) {
                iframe.attr('src', iframe.attr('data-src'));
                iframe.removeAttr('data-src');
            }
        });
    });
</script>
@endsection
