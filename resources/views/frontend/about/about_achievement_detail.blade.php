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
        @if(Config::get('app.locale') == 'en')
        <div class="newsDetail">
            <!-- <img src="img/banner.jpg" alt=""> -->
            <div class="">
                <div class="text-center mt-5 mb-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/#secondPage">Achievement</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $AboutUsAchievementDetail->tilte_en }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="newsDetail-content">
                    <div class="row">
                        <div class="col-12 col-xl-6 text-center">
                            <div class="slider-for">
                                @foreach ($Images as $key => $Image)
                                <div> <img src="{{ asset($Image->image) }}" class="w-100 img-productandservice-1" alt=""></div>
                                @endforeach
                            </div>
                            <div class="line-newsdetail"></div>
                            <div class="slider-nav">
                                @foreach ($Images as $key => $Image)
                                <div> <img src="{{ asset($Image->image) }}" class="w-100 img-productandservice-1" alt=""></div>
                                @endforeach
                            </div>

                        </div>

                        <div class="col-12 col-xl-6">

                            <h5 class="h5">
                                {{ $AboutUsAchievementDetail->tilte_en }}
                            </h5>
                            <p>
                                <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp;
                                {{ $AboutUsAchievementDetail->date }}
                            </p>
                            {!! $AboutUsAchievementDetail->detail_en !!}
                            <a href="/#secondPage" class="btn btn-second"><img src="{{ asset('img/pv-newxdetail.png') }}" alt=""> &nbsp; Back</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        @else
        <div class="newsDetail">
            <!-- <img src="img/banner.jpg" alt=""> -->
            <div class="">
                <div class="text-center mt-5 mb-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/#secondPage">Achievement </a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $AboutUsAchievementDetail->tilte_th }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="newsDetail-content">
                    <div class="row">
                        <div class="col-12 col-xl-6 text-center">
                            <div class="slider-for">
                                @foreach ($Images as $key => $Image)
                                <div> <img src="{{ asset($Image->image) }}" class="w-100 img-productandservice-1" alt=""></div>
                                @endforeach
                            </div>
                            <div class="line-newsdetail"></div>
                            <div class="slider-nav">
                                @foreach ($Images as $key => $Image)
                                <div> <img src="{{ asset($Image->image) }}" class="w-100 img-productandservice-1" alt=""></div>
                                @endforeach
                            </div>

                        </div>

                        <div class="col-12 col-xl-6">

                            <h5 class="h5">
                                {{ $AboutUsAchievementDetail->tilte_th }}
                            </h5>
                            <p>
                                <img src="{{ asset('img/calendar.png') }}" alt="" />&nbsp;&nbsp;
                                {{ $AboutUsAchievementDetail->date }}
                            </p>
                            <p class="card-text">
                                {!! $AboutUsAchievementDetail->detail_th !!}
                            </p>

                            <a href="/#secondPage" class="btn btn-second"><img src="{{ asset('img/pv-newxdetail.png') }}" alt=""> &nbsp; Back</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        @endif

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
          for(i= 0; i<otherTabs.length;i++) {
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
            btns[i].addEventListener("click", function () {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }
        </script>

        <script>
            $(document).ready(function () {
            $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav',
            prevArrow: "<span></span>",
            nextArrow: "<span></span>",
            });
            $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            asNavFor: '.slider-for',
            dots: true,
            // centerMode: true,
            focusOnSelect: true,
            prevArrow: "<span></span>",
            nextArrow: "<span></span>",
            });
        });
        </script>
    </body>

</html>
