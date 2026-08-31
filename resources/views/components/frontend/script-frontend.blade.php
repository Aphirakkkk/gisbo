<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="{{ asset('assets/frontend/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="{{ asset('assets/frontend/js/slick.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.js"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

@include('sweetalert::alert')

<script>
    $(document).ready(function() {


                $(window).resize(function() {
                    console.log('resize called');
                    var width = $(window).width();
                    if (width < 1200) {
                        $('#rmfullview').removeClass('fullpage').addClass('width6');
                    } else {
                        $('#rmfullview').removeClass('width6').addClass('fullpage');
                    }
                }).resize();

                $(function() {
                    $('.fullpage').fullpage({
                        menu: '#headMenu',
                        anchors: ['firstPage', 'secondPage', '3Page', '4Page', '5Page', '6Page',
                            '7Page', '8Page'
                        ],
                        navigation: false,
                        slidesNavigation: true,
                        // scrollBar: true,
                        css3: true,
                    });
                    $('.fullpage').fullpage({
                        menu: '.headsub-foot3',
                        anchors: ['firstPage', 'secondPage', '3Page', '4Page', '5Page', '6Page',
                            '7Page', '8Page'
                        ],
                        navigation: false,
                        slidesNavigation: true,
                        // scrollBar: true,
                        css3: true,
                    });
                });
            });

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
                    nav.append('<li class="nav-item"><a href="#" data-toggle="tab" data-target="' + otherTabs[i] +
                        '">nav</a></li>"');
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
                var slider = $(".slider2");
                var allSlides = $(".slick-slide > div > *").clone();
                var trigger = $("js-filter");

                var ClassFilter = function(object, item) {
                    this.object = object;
                    this.item = item;

                    this.filterFunc = function() {
                        $(".js-filter.active").removeClass("active");
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
            });
</script>


<script type="text/javascript">
    //check recapcha for frontend
    $("#btn-submit").click(function(){
    if (!$(".g-recaptcha").length) {
    Swal.fire({
    type: "warning",
    text: "Recaptcha is not exist"
    })
    return false;
    }
    var response = grecaptcha.getResponse();
    if (response.length == 0 || response == null) {
    $("#check_recapcha").html("*กรุณาตรวจสอบข้อมูลให้ครบถ้วน");
    return false;
    }
    });
    //end check recapcha
</script>


<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script src="https://www.google.com/recaptcha/api.js?render={{env('GOOGLE_RECAPTCHA_KEY')}}"></script>
@yield('javascript')
<!-- sweetalert2 -->
