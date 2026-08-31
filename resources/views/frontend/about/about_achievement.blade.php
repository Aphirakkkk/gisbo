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

        <div id="aboutus-page">
            <div class="container-fulid">
                <div class="row">
                    <div class="col-12">
                        <img class="about-line" src="{{ asset('img/about-line-1.png') }}" alt="" />
                        <h1 class="h1 color1 text-uppercase my-3 pl-3 pt-sm-0">Achievement</h1>
                    </div>

                    <div class="col-12 col-xl-12">
                        <div class="row">
                            <div class="col-12 col-md-10 col-xl-8 pl-4 pr-0">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-Achievement" role="tabpanel" aria-labelledby="v-pills-Achievement-tab">
                                        <div class="px-0 px-xl-5">
                                            <div class="row">
                                                @foreach($AboutUsAchievementMain as $key => $data)
                                                @if(Config::get('app.locale') == 'en')
                                                <div class="col-12 col-sm-6 col-xl-4">
                                                    <div class="card-Achievement">
                                                        <img src="{{ asset($data->image_main) }}" alt="">
                                                        <div class="content">
                                                            <a href="{{url('/about_achievement-detail' . '/' . $data->id )}}" class="text-white">{!! $data->tilte_en ?? '-' !!}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="col-12 col-sm-6 col-xl-4">
                                                    <div class="card-Achievement">
                                                        <img src="{{ asset($data->image_main) }}" alt="">
                                                        <div class="content">
                                                            <a href="{{url('/about_achievement-detail' . '/' . $data->id )}}" class="text-white">{!! $data->tilte_th ?? '-' !!}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <div class="content-about">
                                            <img class="w-100" src="img/about-home.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-Ethics" role="tabpanel" aria-labelledby="v-pills-Ethics-tab">
                                        <div class="content-about">
                                            <img class="w-100" src="img/about-home.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                        <div class="content-about">
                                            <img class="w-100" src="img/about-home.png" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-1"></div>
                            <div class="col-12 col-xl-3 d-none d-xl-block">
                                <div class="nav flex-column nav-pills" id="about-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link " href="/about-detail"><img src="{{ asset('img/about-icon-1.png') }}" alt="" /> About Us</a>
                                    <a class="nav-link " href="/about_organiztional-detail"><img src="{{ asset('img/Organiztional-Structure-icon-1.png') }}" alt="" /> Organizational Structure</a>
                                    <a class="nav-link" href="/about_ethics-detail"><img src="{{ asset('img/Ethics-icon-1.png') }}" alt="" /> Ethics</a>
                                    <a class="nav-link" href="/about_values-detail"><img src="{{ asset('img/Values-icon-1.png') }}" alt="" /> Values</a>
                                    <a class="nav-link" href="/about_9001-detail"><img src="{{ asset('img/ISO9001-icon-1.png') }}" alt="" /> ISO 9001</a>
                                    <a class="nav-link" href="/about_45001-detail"><img src="{{ asset('img/ISO9001-icon-1.png') }}" alt="" /> ISO 45001</a>
                                    <a class="nav-link" href="/about_iec-detail"><img src="{{ asset('img/ISO9001-icon-1.png') }}" alt="" /> ISO / IEC 27001</a>
                                    <a class="nav-link active" href="/about_achievement-detail"><img src="{{ asset('img/Achievement-icon-1.pn') }}g" alt="" /> Achievement</a>
                                    <a class="nav-link" href="/about_why-detail"><img src="{{ asset('img/WhyChoose-icon-1.png') }}" alt="" /> Why Choose</a>

                                    <a class="nav-link" href="/about_policy"><img src="{{ asset('img/policy-icon.PNG') }}" alt="" style="width: 28px; height: 28px; object-fit: contain; margin-right: 10px;" /> Policy</a>

                                    <a class="nav-link" href="/about_carbon-detail"><img src="{{ asset('img/Carbon-icon.PNG') }}" alt="" style="width: 28px; height: 28px; object-fit: contain; margin-right: 10px;" /> Carbon Footprint</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <img class="Helmet" src="img/Helmet.png" alt="" /> -->
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
                },
                {
                    breakpoint: 480,
                    settings: {
                        rows: 4,
                        slidesPerRow: 1,
                        slidesToScroll: 1,
                        slidesToShow: 1,
                        dots: true,
                    },
                },
            ],
        };

        $(document).ready(function () {
            $(".slider2").slick(slickoptions);
            // $('.slider2').slick('slickFilter', function() {
            //     return $('.slider2').find('.slick-slide').attr("data-filter") == ".HiglightProject";
            // });
            var slider = $(".slider2");
            var allSlides = $(".slick-slide > div > *").clone();
            var trigger = $("js-filter");

            var ClassFilter = function (object, item) {
                this.object = object;
                this.item = item;

                this.filterFunc = function () {
                    $(".active").removeClass("active");
                    $('.js-filter[data-filter="' + this.item + '"]').addClass("active");
                    var filterSlides = allSlides.filter(this.item);

                    slider.css({
                        opacity: "0",
                        left: "50px",
                    });
                    setTimeout(function () {
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

            jQuery(".js-filter").on("click", function (e) {
                var attr = jQuery(this).attr("data-filter");
                var newFilter = new ClassFilter(this, attr);
                newFilter.filterFunc();
            });
        });
        </script>
    </body>

</html>
