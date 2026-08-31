<!DOCTYPE html>

<html lang="en">



    <head>

        <meta charset="UTF-8" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>GIS GROUP</title>

        <meta name="description" content="GIS Group is ISO 9001:2015 and OHSAS/TIS 18001 certified engineering contractor of Construction, Mechanical & Electrical (M&E) Systems and Intelligent" />

        <link rel="icon" href="{{ asset('assets/frontend/img/logo.png') }}" type="image/png">

        <link href="{{ asset('assets/frontend/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/frontend/css/site.css') }}" />



        <link rel="stylesheet" href="{{ asset('assets/frontend/font/stylesheet.css') }}" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" />

        <style>

            #showsitemap {
                height: 580px;
            }

            .iso-slider-wrapper {
                position: relative;
                width: 100%;
                padding: 0 15px;
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
                animation: isoSlideNextIn 0.5s ease-in-out forwards;
            }

            .iso-slide-item.iso-slide-next-out {
                display: block;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                animation: isoSlideNextOut 0.5s ease-in-out forwards;
            }

            .iso-slide-item.iso-slide-prev-in {
                display: block;
                animation: isoSlidePrevIn 0.5s ease-in-out forwards;
            }

            .iso-slide-item.iso-slide-prev-out {
                display: block;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                animation: isoSlidePrevOut 0.5s ease-in-out forwards;
            }

            @keyframes isoSlideNextIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }

            @keyframes isoSlideNextOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(-100%); opacity: 0; }
            }

            @keyframes isoSlidePrevIn {
                from { transform: translateX(-100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }

            @keyframes isoSlidePrevOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
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

            /* Policy Card (1 Section - Spacious & Centered) */
            .policy-card-custom {
                background: transparent;
                padding: 0 10px;
                max-width: 500px;
                margin: 0 auto;
                width: 100%;
            }

            .policy-badge-banner {
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

            .policy-badge-banner h3 {
                margin: 0;
                transform: skewX(20deg);
                font-size: 28px !important;
                font-weight: 900 !important;
                font-style: italic;
                color: #000000 !important;
                letter-spacing: 0.5px;
                font-family: 'fc_minimalbold', 'Prompt', sans-serif;
            }

            .policy-body-content {
                font-size: 22px !important;
                line-height: 1.55 !important;
                color: #000000 !important;
                text-align: left;
                font-family: 'fc_minimalregular', 'Prompt', sans-serif;
            }

            .policy-body-content p {
                margin-bottom: 1rem;
                font-size: 22px !important;
                line-height: 1.55 !important;
                color: #000000 !important;
            }

            .policy-body-content strong, 
            .policy-body-content b {
                font-size: 23px !important;
                font-weight: 800 !important;
                color: #e46a25 !important;
            }

            .policy-body-content font, 
            .policy-body-content font[size],
            .policy-body-content span {
                font-size: inherit !important;
                line-height: inherit !important;
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

        </style>

    </head>



    <body>

        @include('components.frontend.header-frontend')



        <div id="aboutus-page" class="whychoose">

            <div class="container-fulid">

                <div class="row">

                    <div class="col-12 pl-5 pl-lg-0">

                        <img src="{{ asset('assets/frontend/img/about-line-1.png') }}" alt="" />

                        <h1 class="h1 color1 text-uppercase my-3">POLICY</h1>

                    </div>

                    <div class="col-12 col-xl-12">

                        <div class="row">

                            <div class="col-12 col-xl-9 pl-4 pr-0">
                                @php
                                    $policyItem = isset($AboutUsPolicyList) ? $AboutUsPolicyList->first() : null;
                                    $pTitleTh = ($policyItem && $policyItem->tilte_th) ? $policyItem->tilte_th : 'นโยบายความยั่งยืน';
                                    $pTitleEn = ($policyItem && $policyItem->tilte_en) ? $policyItem->tilte_en : 'Sustainability Policy';
                                    $pDetailTh = ($policyItem && $policyItem->detail_th) ? $policyItem->detail_th : '<p><strong style="color: #e46a25;">GIS Group</strong> เป็นองค์กรที่ให้ความสำคัญกับความยั่งยืนและความรับผิดชอบต่อสิ่งแวดล้อม โดยเฉพาะอย่างยิ่งในการบริหารจัดการพลังงานอย่างมีประสิทธิภาพภายในสำนักงานและโครงการต่างๆ เรามุ่งมั่นลดผลกระทบต่อสภาพภูมิอากาศด้วยการนำเทคโนโลยีอาคารอัจฉริยะและพลังงานสะอาดมาใช้ในกระบวนการดำเนินงาน ทั้งผู้บริหารและพนักงานทุกระดับให้ความสำคัญกับการปรับปรุงประสิทธิภาพการใช้พลังงานและลดการสูญเสียพลังงานไฟฟ้า ส่งผลให้สามารถลดการใช้ไฟฟ้าจากภายนอกและลดการปล่อยก๊าซคาร์บอนไดออกไซด์ลงอย่างต่อเนื่องในแต่ละปี GIS Group จึงขอแสดงเจตนารมณ์ในการดำเนินธุรกิจอย่างเป็นมิตรต่อสิ่งแวดล้อม คำนึงถึงกฎหมายและมาตรฐานที่เกี่ยวข้อง พร้อมทั้งมุ่งสร้างสรรค์อนาคตที่ยั่งยืนให้กับชุมชนและสิ่งแวดล้อมของเราต่อไป</p>';
                                    $pDetailEn = ($policyItem && $policyItem->detail_en) ? $policyItem->detail_en : '<p><strong style="color: #e46a25;">GIS Group</strong> is an organization that focuses on sustainability and environmental responsibility, especially for efficient energy management within offices and projects. We are committed to minimizing climate impact by implementing smart building technology and clean energy. Executives and employees of all levels focus on improving energy efficiency and reducing electricity consumption, reducing external power consumption and reducing CO2 emissions each year. GIS Group is committed to environmentally friendly business operations in consideration of relevant laws and standards. At the same time, we are committed to building a sustainable future for our communities and the environment.</p>';
                                @endphp

                                <div class="row">
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

                            <div class="col-12 col-xl-3 d-none d-xl-block">

                                <div class="nav flex-column nav-pills" id="about-pills-tab" role="tablist" aria-orientation="vertical">

                                    <a class="nav-link" href="/about-detail"><img src="{{ asset('img/about-icon-1.png') }}" alt="" /> About Us</a>

                                    <a class="nav-link" href="/about_organiztional-detail"><img src="{{ asset('img/Organiztional-Structure-icon-1.png') }}" alt="" /> Organizational Structure</a>

                                    <a class="nav-link" href="/about_ethics-detail"><img src="{{ asset('img/Ethics-icon-1.png') }}" alt="" /> Ethics</a>

                                    <a class="nav-link" href="/about_values-detail"><img src="{{ asset('img/Values-icon-1.png') }}" alt="" /> Values</a>

                                    <a class="nav-link" href="/about_9001-detail"><img src="{{ asset('img/ISO9001-icon-1.png') }}" alt="" /> ISO 9001</a>

                                    <a class="nav-link" href="/about_45001-detail"><img src="{{ asset('img/ISO9001-icon-1.png') }}" alt="" /> ISO 45001</a>

                                    <a class="nav-link" href="/about_iec-detail"><img src="{{ asset('img/ISO9001-icon-1.png') }}" alt="" /> ISO / IEC 27001</a>

                                    <a class="nav-link" href="/about_achievement-detail"><img src="{{ asset('img/Achievement-icon-1.png') }}" alt="" /> Achievement</a>

                                    <a class="nav-link" href="/about_why-detail"><img src="{{ asset('img/WhyChoose-icon-1.png') }}" alt="" /> Why Choose</a>

                                    <a class="nav-link active" href="/about_policy"><img src="{{ asset('img/policy-icon.PNG') }}" alt="" style="width: 28px; height: 28px; object-fit: contain; margin-right: 10px;" /> Policy</a>

                                    <a class="nav-link" href="/about_carbon-detail"><img src="{{ asset('img/Carbon-icon.PNG') }}" alt="" style="width: 28px; height: 28px; object-fit: contain; margin-right: 10px;" /> Carbon Footprint</a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        @include('components.frontend.footer-frontend')



        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">

        </script>

        <script src="{{ asset('assets/frontend/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

        <script src="{{ asset('assets/frontend/js/slick.js') }}"></script>



        <script>

            function myFunction() {

            var x = document.getElementById("showsitemap");

            if (x.style.display === "block") {

                x.style.display = "none";

            } else {

                x.style.display = "block";

            }

        }

        </script>

        <script>

            $(document).on('click', '.nav-pills a', function(e) {

            otherTabs = $(this).attr('data-secondary').split(',');

            for (i = 0; i < otherTabs.length; i++) {

                nav = $('<ul class="nav d-none" id="tmpNav"></ul>');

                nav.append('<li class="nav-item"><a href="#" data-toggle="tab" data-target="' + otherTabs[i] + '">nav</a></li>"');

                nav.find('a').tab('show');

            }

        });

        $(".slick-nav").slick({

            prevArrow: "<span> < </span>",

            nextArrow: "<span> > </span>",

        });

        // Add active class to the current button (highlight it)

        var header = document.getElementById("headMenu");

        var btns = header.getElementsByClassName("ani300");

        for (var i = 0; i < btns.length; i++) {

            btns[i].addEventListener("click", function() {

                var current = document.getElementsByClassName("active");

                current[0].className = current[0].className.replace(" active", "");

                this.className += " active";

            });

        }

        </script>



        <script>

            var slickoptions = {

            rows: 3,

            dots: true,

            appendDots: $(".slick-nav"),

            appendArrows: $(".slick-nav"),

            accessibility: true,

            speed: 300,

            slidesToShow: 3,

            slidesToScroll: 3,

            infinite: false,

            responsive: [{

                breakpoint: 768,

                settings: {

                    rows: 2,

                    slidesToScroll: 1,

                    slidesToShow: 2,

                    dots: true,

                },

            }, {

                breakpoint: 480,

                settings: {

                    rows: 4,

                    slidesPerRow: 1,

                    slidesToScroll: 1,

                    slidesToShow: 1,

                    dots: true,

                },

            }, ],

        };



        $(document).ready(function() {

            $(".slider2").slick(slickoptions);

            // $('.slider2').slick('slickFilter', function() {

            //     return $('.slider2').find('.slick-slide').attr("data-filter") == ".HiglightProject";

            // });

            var slider = $(".slider2");

            var allSlides = $(".slick-slide > div > *").clone();

            var trigger = $("js-filter");



            var ClassFilter = function(object, item) {

                this.object = object;

                this.item = item;



                this.filterFunc = function() {

                    $(".active").removeClass("active");

                    $('.js-filter[data-filter="' + this.item + '"]').addClass("active");

                    var filterSlides = allSlides.filter(this.item);



                    slider.css({

                        opacity: "0",

                        left: "50px",

                    });

                    setTimeout(function() {

                        slider

                            .slick("unslick")

                            .empty()

                            .append(filterSlides)

                            .slick(slickoptions)

                            .css({

                                opacity: "100",

                                left: "0px",

                            });

                    }, 600);

                };

            };



            jQuery(".js-filter").on("click", function(e) {

                var attr = jQuery(this).attr("data-filter");

                var newFilter = new ClassFilter(this, attr);

                newFilter.filterFunc();

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
        </script>

    </body>

</html>

