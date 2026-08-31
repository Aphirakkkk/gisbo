@extends('layouts.frontend.sidenav-frontend')
@section('css')
@endsection
@section('content')
@if(Config::get('app.locale') == 'en')
<div class="our_business-page">
    <!-- <img src="img/banner.jpg" alt=""> -->
    <div class="container-fulid">
        <div class="text-center">
            <img src="img/biz-line-1.png" alt="" />
            <h1 class="h1 color1 mt-3 text-uppercase">Engineering Technology Contractor</h1>
        </div>
        <div class="row align-items-end">
            <div class="col-12 col-sm-4 text-center">
                <a class="biz-pv" href="/business-epc">
                    <img src="img/biz-pv.png" alt="">
                    <span class="color2 h3">EPC</span>
                </a>
                <img src="img/epc-stop.png" class="w-100" alt="">
            </div>
            <div class="col-12 col-sm-4">
                <a href="{{ $ENR->link_VDO }}" target="_blank"> <img src="{{ asset($ENR->image_VDO) }}" class="w-100 mt-5" alt=""></a>

            </div>
            <div class="col-12 col-sm-4 text-center">
                <a class="biz-next" href="/business-ibt">
                    <span class="color2 h3">IBT</span>
                    <img src="img/biz-next.png" alt="">

                </a>
                <img src="img/product-content1-2.png" class="w-100" alt="">

            </div>
        </div>

        <div class="content-ourbiz">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 text-center">
                        <img src="{{ asset($ENRHome->image_icon) }}" alt="">
                        </a>


                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="card">
                            <div class="text1">{!!$ENR->sub_tilte_en !!}</div>
                            <h1 class="h1">{!! $ENR->tilte_en !!}</h1>
                            <p>{!! $ENR->detail_en !!}</p>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="w-100"></div>
                    {!! $ENR->sub_detail_en !!}
                    <div class="w-100"></div>
                    <div class="col-12">
                        <div class="text-vision text-center">
                            <h2 class="h2">{!! $ENR->slogan_en !!}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="our_business-page">
    <!-- <img src="img/banner.jpg" alt=""> -->
    <div class="container-fulid">
        <div class="text-center">
            <img src="img/biz-line-1.png" alt="" />
            <h1 class="h1 color1 mt-3 text-uppercase">Engineering Technology Contractor</h1>
        </div>
        <div class="row align-items-end">
            <div class="col-12 col-sm-4 text-center">
                <a class="biz-pv" href="/business-epc">
                    <img src="img/biz-pv.png" alt="">
                    <span class="color2 h3">EPC</span>
                </a>
                <img src="img/epc-stop.png" class="w-100" alt="">
            </div>
            <div class="col-12 col-sm-4">
                <a href="{{ $ENR->link_VDO }}" target="_blank"> <img src="{{ asset($ENR->image_VDO) }}" class="w-100 mt-5" alt=""></a>

            </div>
            <div class="col-12 col-sm-4 text-center">
                <a class="biz-next" href="/business-ibt">
                    <span class="color2 h3">IBT</span>
                    <img src="img/biz-next.png" alt="">

                </a>
                <img src="img/product-content1-2.png" class="w-100" alt="">

            </div>
        </div>

        <div class="content-ourbiz">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 text-center">
                        <img src="{{ asset($ENRHome->image_icon) }}" alt="">
                        </a>


                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="card">
                            <div class="text1">{!!$ENR->sub_tilte_th !!}</div>
                            <h1 class="h1">{!! $ENR->tilte_th !!}</h1>
                            <p>{!! $ENR->detail_th !!}</p>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="w-100"></div>
                    {!! $ENR->sub_detail_th !!}
                    <div class="w-100"></div>
                    <div class="col-12">
                        <div class="text-vision text-center">
                            <h2 class="h2">{!! $ENR->slogan_th !!}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@include('components.frontend.footer-frontend')


@endsection

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
