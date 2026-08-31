@extends('layouts.frontend.sidenav-frontend')
@section('css')
<style>
    @media (min-width: 992px) and (max-width: 1199.98px) {
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    }

</style>
<style>
    #showsitemap {
        height: 580px;
    }

    @font-face {
        font-family: WorkSans-Medium;
        src: url(/assets/font/WorkSans-Medium.ttf) format("truetype");
    }

    @font-face {
        font-family: Anakotmai-Bold;
        src: url(/FontWeb/Anakotmai-Bold.ttf) format("truetype");
    }

    @font-face {
        font-family: Anakotmai-Light;
        src: url(/FontWeb/Anakotmai-Light.ttf) format("truetype");
    }

    @font-face {
        font-family: Anakotmai-Medium;
        src: url(/FontWeb/Anakotmai-Medium.ttf) format("truetype");
    }

    @font-face {
        font-family: Anuphan-Bold;
        src: url(/FontWeb/Anuphan-Bold.ttf) format("truetype");
    }

    @font-face {
        font-family: Anuphan-ExtraLight;
        src: url(/FontWeb/Anuphan-ExtraLight.ttf) format("truetype");
    }

    @font-face {
        font-family: Anuphan-Medium;
        src: url(/FontWeb/Anuphan-Medium.ttf) format("truetype");
    }

    @font-face {
        font-family: Athiti-Bold;
        src: url(/FontWeb/Athiti-Bold.ttf) format("truetype");
    }

    @font-face {
        font-family: Athiti-ExtraLight;
        src: url(/FontWeb/Athiti-ExtraLight.ttf) format("truetype");
    }

    @font-face {
        font-family: Athiti-Light;
        src: url(/FontWeb/Athiti-Light.ttf) format("truetype");
    }

    @font-face {
        font-family: Athiti-Medium;
        src: url(/FontWeb/Athiti-Medium.ttf) format("truetype");
    }

    @font-face {
        font-family: Athiti-Regular;
        src: url(/FontWeb/Athiti-Regular.ttf) format("truetype");
    }

    @font-face {
        font-family: Athiti-SemiBold;
        src: url(/FontWeb/Athiti-SemiBold.ttf) format("truetype");
    }

    @font-face {
        font-family: BalsamiqSans-Bold;
        src: url(/FontWeb/BalsamiqSans-Bold.ttf) format("truetype");
    }

    @font-face {
        font-family: BalsamiqSans-BoldItalic;
        src: url(/FontWeb/BalsamiqSans-BoldItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: BalsamiqSans-Italic;
        src: url(/FontWeb/BalsamiqSans-Italic.ttf) format("truetype");
    }

    @font-face {
        font-family: BalsamiqSans-Regular;
        src: url(/FontWeb/BalsamiqSans-Regular.ttf) format("truetype");
    }

    @font-face {
        font-family: IstokWeb-Bold;
        src: url(/FontWeb/IstokWeb-Bold.ttf) format("truetype");
    }

    @font-face {
        font-family: IstokWeb-BoldItalic;
        src: url(/FontWeb/IstokWeb-BoldItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: IstokWeb-Italic;
        src: url(/FontWeb/IstokWeb-Italic.ttf) format("truetype");
    }

    @font-face {
        font-family: IstokWeb-Regular;
        src: url(/FontWeb/IstokWeb-Regular.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-Black;
        src: url(/FontWeb/Kanit-Black.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-BlackItalic;
        src: url(/FontWeb/Kanit-BlackItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-Bold;
        src: url(/FontWeb/Kanit-Bold.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-BoldItalic;
        src: url(/FontWeb/Kanit-BoldItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-ExtraBold;
        src: url(/FontWeb/Kanit-ExtraBold.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-ExtraBoldItalic;
        src: url(/FontWeb/Kanit-ExtraBoldItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-ExtraLight;
        src: url(/FontWeb/Kanit-ExtraLight.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-ExtraLightItalic;
        src: url(/FontWeb/Kanit-ExtraLightItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-Italic;
        src: url(/FontWeb/Kanit-Italic.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-Light;
        src: url(/FontWeb/Kanit-Light.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-LightItalic;
        src: url(/FontWeb/Kanit-LightItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-Medium;
        src: url(/FontWeb/Kanit-Medium.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-MediumItalic;
        src: url(/FontWeb/Kanit-MediumItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-Regular;
        src: url(/FontWeb/Kanit-Regular.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-SemiBold;
        src: url(/FontWeb/Kanit-SemiBold.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-SemiBoldItalic;
        src: url(/FontWeb/Kanit-SemiBoldItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-Thin;
        src: url(/FontWeb/Kanit-Thin.ttf) format("truetype");
    }

    @font-face {
        font-family: Kanit-ThinItalic;
        src: url(/FontWeb/Kanit-ThinItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Mitr-Bold;
        src: url(/FontWeb/Mitr-Bold.ttf) format("truetype");
    }

    @font-face {
        font-family: Mitr-ExtraLight;
        src: url(/FontWeb/Mitr-ExtraLight.ttf) format("truetype");
    }

    @font-face {
        font-family: Mitr-Light;
        src: url(/FontWeb/Mitr-Light.ttf) format("truetype");
    }

    @font-face {
        font-family: Mitr-Medium;
        src: url(/FontWeb/Mitr-Medium.ttf) format("truetype");
    }

    @font-face {
        font-family: Mitr-Regular;
        src: url(/FontWeb/Mitr-Regular.ttf) format("truetype");
    }

    @font-face {
        font-family: Mitr-SemiBold;
        src: url(/FontWeb/Mitr-SemiBold.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-Black;
        src: url(/FontWeb/Prompt-Black.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-BlackItalic;
        src: url(/FontWeb/Prompt-BlackItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-Bold;
        src: url(/FontWeb/Prompt-Bold.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-BoldItalic;
        src: url(/FontWeb/Prompt-BoldItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-ExtraBold;
        src: url(/FontWeb/Prompt-ExtraBold.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-ExtraBoldItalic;
        src: url(/FontWeb/Prompt-ExtraBoldItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-ExtraLight;
        src: url(/FontWeb/Prompt-ExtraLight.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-ExtraLightItalic;
        src: url(/FontWeb/Prompt-ExtraLightItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-Italic;
        src: url(/FontWeb/Prompt-Italic.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-Light;
        src: url(/FontWeb/Prompt-Light.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-LightItalic;
        src: url(/FontWeb/Prompt-LightItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-Medium;
        src: url(/FontWeb/Prompt-Medium.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-MediumItalic;
        src: url(/FontWeb/Prompt-MediumItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-Regular;
        src: url(/FontWeb/Prompt-Regular.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-SemiBold;
        src: url(/FontWeb/Prompt-SemiBold.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-SemiBoldItalic;
        src: url(/FontWeb/Prompt-SemiBoldItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-Thin;
        src: url(/FontWeb/Prompt-Thin.ttf) format("truetype");
    }

    @font-face {
        font-family: Prompt-ThinItalic;
        src: url(/FontWeb/Prompt-ThinItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: PSL-Omyim;
        src: url(/FontWeb/PSL-Omyim.ttf) format("truetype");
    }

    @font-face {
        font-family: PSL-OmyimBold;
        src: url(/FontWeb/PSL-OmyimBold.ttf) format("truetype");
    }

    @font-face {
        font-family: PSL-OmyimBoldItalic;
        src: url(/FontWeb/PSL-OmyimBoldItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: PSL-OmyimItalic;
        src: url(/FontWeb/PSL-OmyimItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: RacingSansOne-Regular;
        src: url(/FontWeb/RacingSansOne-Regular.ttf) format("truetype");
    }

    @font-face {
        font-family: RobotoCondensed-Bold;
        src: url(/FontWeb/RobotoCondensed-Bold.ttf) format("truetype");
    }

    @font-face {
        font-family: RobotoCondensed-Light;
        src: url(/FontWeb/RobotoCondensed-Light.ttf) format("truetype");
    }

    @font-face {
        font-family: RobotoCondensed-BoldItalic;
        src: url(/FontWeb/RobotoCondensed-BoldItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: RobotoCondensed-Italic;
        src: url(/FontWeb/RobotoCondensed-Italic.ttf) format("truetype");
    }

    @font-face {
        font-family: RobotoCondensed-LightItalic;
        src: url(/FontWeb/RobotoCondensed-LightItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: RobotoCondensed-Regular;
        src: url(/FontWeb/RobotoCondensed-Regular.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-Black;
        src: url(/FontWeb/Rubik-Black.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-BlackItalic;
        src: url(/FontWeb/Rubik-BlackItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-Bold;
        src: url(/FontWeb/Rubik-Bold.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-BoldItalic;
        src: url(/FontWeb/Rubik-BoldItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-ExtraBold;
        src: url(/FontWeb/Rubik-ExtraBold.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-ExtraBoldItalic;
        src: url(/FontWeb/Rubik-ExtraBoldItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-Italic;
        src: url(/FontWeb/Rubik-Italic.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-Italic-VariableFont_wght;
        src: url(/FontWeb/Rubik-Italic-VariableFont_wght.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-Light;
        src: url(/FontWeb/Rubik-Light.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-LightItalic;
        src: url(/FontWeb/Rubik-LightItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-Medium;
        src: url(/FontWeb/Rubik-Medium.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-MediumItalic;
        src: url(/FontWeb/Rubik-MediumItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-Regular;
        src: url(/FontWeb/Rubik-Regular.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-SemiBold;
        src: url(/FontWeb/Rubik-SemiBold.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-SemiBoldItalic;
        src: url(/FontWeb/Rubik-SemiBoldItalic.ttf) format("truetype");
    }

    @font-face {
        font-family: Rubik-VariableFont_wght;
        src: url(/FontWeb/Rubik-VariableFont_wght.ttf) format("truetype");
    }

    @font-face {
        font-family: Shrikhand-Regular;
        src: url(/FontWeb/Shrikhand-Regular.ttf) format("truetype");
    }

    @font-face {
        font-family: Sriracha-Regular;
        src: url(/FontWeb/Sriracha-Regular.ttf) format("truetype");
    }

    @font-face {
        font-family: VarelaRound-Regular;
        src: url(/FontWeb/VarelaRound-Regular.ttf) format("truetype");
    }

    html, body {
        overflow-x: hidden;
        overflow-y: auto !important;
        height: auto !important;
    }

    .productandservicepage {
        min-height: 100vh;
        height: auto !important;
        background: #f8fafc url('{{ asset("assets/frontend/img/about-bg.png") }}') no-repeat center top / cover !important;
        background-color: #fafbfc !important;
        padding-top: 15px;
        padding-bottom: 70px !important;
        overflow-y: visible !important;
    }
    .productandservicepage .text-center.mb-4 {
        margin-bottom: 8px !important;
    }
    .productandservicepage .productandservicepage-group .slick-slide {
        padding: 5px 18px;
    }
    .productandservicepage .productandservicepage-group img {
        border: 3.5px solid #f69420 !important;
        border-radius: 14px !important;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3) !important;
        aspect-ratio: 16 / 9.5;
        object-fit: cover;
        background-color: #fff;
        max-height: min(310px, 32vh) !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .productandservicepage .productandservicepage-group img:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(246, 148, 32, 0.4) !important;
    }
    .productandservicepage .productandservicepage-img .content-productandservice {
        padding: 10px 40px 20px 40px !important;
        max-width: 1350px !important;
        margin: 0 auto !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
    }
    .productandservicepage .productandservicepage-img .content-productandservice table {
        width: 100% !important;
        margin: 0 auto !important;
    }
    .productandservicepage .productandservicepage-img .content-productandservice,
    .productandservicepage .productandservicepage-img .content-productandservice p,
    .productandservicepage .productandservicepage-img .content-productandservice span,
    .productandservicepage .productandservicepage-img .content-productandservice li,
    .productandservicepage .productandservicepage-img .content-productandservice td {
        font-size: 14.5px !important;
        line-height: 1.5 !important;
        color: #2b2b2b !important;
        margin-bottom: 3px !important;
    }
    .productandservicepage .productandservicepage-img .content-productandservice strong,
    .productandservicepage .productandservicepage-img .content-productandservice b {
        color: #e26d23 !important;
        font-weight: 700 !important;
    }
    .tab-pane.fade {
        transition: opacity 0.25s ease-in-out;
    }
    .productandservicepage-group:not(.slick-initialized) {
        display: flex;
        overflow: hidden;
        gap: 20px;
        opacity: 0;
    }
    .productandservicepage-group.slick-initialized {
        opacity: 1;
        transition: opacity 0.3s ease;
    }

    @media (max-height: 850px) {
        .productandservicepage .productandservicepage-group img {
            max-height: 250px !important;
        }
        .productandservicepage .text-center.mb-4 {
            margin-bottom: 4px !important;
        }
        .productandservicepage .productandservicepage-img .content-productandservice {
            padding: 6px 30px 15px 30px !important;
        }
    }
    @media (max-height: 720px) {
        .productandservicepage .productandservicepage-group img {
            max-height: 200px !important;
        }
    }
</style>
@endsection
@section('content')
@php
    $isServicesInitial = request()->is('*product-and-service2*');
@endphp

<div class="our_business-page productandservicepage">
    <div class="container-fulid">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/frontend/img/biz-line-1.png') }}" alt="" />
            <div class="nav flex-row nav-pills justify-content-center" id="v-productandservicepage-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link {{ !$isServicesInitial ? 'active' : '' }}" id="v-pills-products-tab" data-toggle="pill" href="#v-pills-products" role="tab" aria-controls="v-pills-products" aria-selected="{{ !$isServicesInitial ? 'true' : 'false' }}">
                    <img src="{{ asset('assets/frontend/img/product-3-btn.png') }}" class="mr-3 img-normal" alt="">
                    <img src="{{ asset('assets/frontend/img/product-1-btn.png') }}" class="mr-3 img-active" alt="">
                </a>
                <a class="nav-link {{ $isServicesInitial ? 'active' : '' }}" id="v-pills-services-tab" data-toggle="pill" href="#v-pills-services" role="tab" aria-controls="v-pills-services" aria-selected="{{ $isServicesInitial ? 'true' : 'false' }}">
                    <img src="{{ asset('assets/frontend/img/product-2-btn.png') }}" class="img-normal" alt="">
                    <img src="{{ asset('assets/frontend/img/product-4-btn.png') }}" class="img-active" alt="">
                </a>
            </div>
        </div>

        <div class="tab-content" id="v-pills-tabContentMain">
            <!-- TAB 1: PRODUCTS -->
            <div class="tab-pane fade {{ !$isServicesInitial ? 'show active' : '' }}" id="v-pills-products" role="tabpanel" aria-labelledby="v-pills-products-tab">
                <div class="productandservicepage-img">
                    <div class="productandservicepage-group">
                        @if(!empty($product->image_1))
                        <div><img src="{{ asset($product->image_1) }}" class="w-100 img-productandservice-1" alt=""></div>
                        @endif
                        @if(!empty($product->image_2))
                        <div><img src="{{ asset($product->image_2) }}" class="w-100 img-productandservice-2" alt=""></div>
                        @endif
                        @if(!empty($product->image_3))
                        <div><img src="{{ asset($product->image_3) }}" class="w-100 img-productandservice-2" alt=""></div>
                        @endif
                        @if(!empty($product->image_4))
                        <div><img src="{{ asset($product->image_4) }}" class="w-100 img-productandservice-2" alt=""></div>
                        @endif
                    </div>
                    <div class="row align-items-end">
                        <div class="col-12">
                            <div class="content-productandservice">
                                @if(Config::get('app.locale') == 'en')
                                    {!! $product->detail_en ?? '' !!}
                                @else
                                    {!! $product->detail_th ?? '' !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: SERVICES -->
            <div class="tab-pane fade {{ $isServicesInitial ? 'show active' : '' }}" id="v-pills-services" role="tabpanel" aria-labelledby="v-pills-services-tab">
                <div class="productandservicepage-img">
                    <div class="productandservicepage-group">
                        @if(!empty($service->image_1))
                        <div><img src="{{ asset($service->image_1) }}" class="w-100 img-productandservice-1" alt=""></div>
                        @endif
                        @if(!empty($service->image_2))
                        <div><img src="{{ asset($service->image_2) }}" class="w-100 img-productandservice-2" alt=""></div>
                        @endif
                        @if(!empty($service->image_3))
                        <div><img src="{{ asset($service->image_3) }}" class="w-100 img-productandservice-2" alt=""></div>
                        @endif
                        @if(!empty($service->image_4))
                        <div><img src="{{ asset($service->image_4) }}" class="w-100 img-productandservice-2" alt=""></div>
                        @endif
                    </div>
                    <div class="row align-items-end">
                        <div class="col-12">
                            <div class="content-productandservice">
                                @if(Config::get('app.locale') == 'en')
                                    {!! $service->detail_en ?? '' !!}
                                @else
                                    {!! $service->detail_th ?? '' !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.frontend.footer-frontend')

@endsection
@section('javascript')
<script>
    $(document).ready(function() {
        $('.productandservicepage-group').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            arrows: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr('href');
            $(target).find('.productandservicepage-group').slick('setPosition');
        });
    });
</script>
@endsection
