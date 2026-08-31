<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xl-3 foot1">
                <div class="">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                </div>
                <div class="d-flex mt-3">
                    <img width="26" height="26" src="{{ asset('img/location-icon.png') }}" alt="">
                    <p class="text-white">
                        @if(Config::get('app.locale') == 'en')
                        {!! $Footer1->tilte_en !!}
                        @else
                        {!! $Footer1->tilte_th !!}
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-12 col-xl-9 foot2">
                <div class="sub-foot2">
                    <h4><span class="color1">Call Center :</span>
                        <span class="text-white">
                            @if(Config::get('app.locale') == 'en')
                            {!! $Footer2->tilte_en !!}
                            @else
                            {!! $Footer2->tilte_th !!}
                            @endif
                        </span>
                    </h4>
                    <div class="d-flex">
                        <ul>
                            <li>
                                <span class=" text-white">
                                    <img src="{{ asset('img/tel-icon.png') }}" alt="">
                                    @if(Config::get('app.locale') == 'en')
                                    {!! $Footer3->tilte_en !!}
                                    @else
                                    {!! $Footer3->tilte_th !!}
                                    @endif
                                </span>

                            </li>
                            <li>
                                <span>
                                    <img src="{{ asset('img/email-icon.png') }}" alt="">
                                    @if(Config::get('app.locale') == 'en')
                                    {!! $Footer4->tilte_en !!}
                                    @else
                                    {!! $Footer4->tilte_th !!}
                                    @endif
                                </span>

                            </li>
                        </ul>
                        <ul>
                            <li>

                                <span>
                                    <img src="{{ asset('img/fax-icon.png') }}" alt="">
                                    @if(Config::get('app.locale') == 'en')
                                    {!! $Footer5->tilte_en !!}
                                    @else
                                    {!! $Footer5->tilte_th !!}
                                    @endif
                                </span>
                            </li>
                            <li>

                                <span>
                                    <img src="{{ asset('img/line-icon.png') }}" alt="">
                                    @if(Config::get('app.locale') == 'en')
                                    {!! $Footer6->tilte_en !!}
                                    @else
                                    {!! $Footer6->tilte_th !!}
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="sub-foot3" id="sub-foot3">
                    <div class="d-flex headsub-foot3">
                        <ul>
                            <li class="d-none">
                                <a data-menuanchor="firstPage" class="a-banner" href="/#banner">
                                    About GIS Group
                                </a>

                            </li>
                            <li>
                                <a data-menuanchor="secondPage" class="a-about" href="/#about">
                                    About GIS Group
                                </a>

                            </li>
                            <li>
                                <a data-menuanchor="3Page" class="home-pdandservice" href="/#pdandservice">Products & Services</a>
                            </li>
                            <li>
                                <a data-menuanchor="4Page" class="home-projectref" href="/#projectref">Projects Reference</a>

                            </li>

                        </ul>
                        <ul>
                            <li>

                                <a data-menuanchor="5Page" class="home-our_business" href="/#our_business">Our Business</a>
                            </li>
                            <li>

                                <a data-menuanchor="6Page" class="home-news" href="/#news">News & Events</a>
                            </li>
                            <li>

                                <a data-menuanchor="7Page" class="home-map-contact" href="/#map-contact">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="sub-foot4">
                    <div class="follow">
                        <h5 class="text-white h5 mr-2 mb-0">FOLLOW US</h5>
                        <a href="@if(Config::get('app.locale') == 'en')
                        {!! $Footer7->tilte_en !!}
                        @else
                        {!! $Footer7->tilte_th !!}
                        @endif" class=" mr-2">
                            <img src="{{ asset('img/fb-icon-sq.png') }}" alt="">
                        </a>

                        <a href="@if(Config::get('app.locale') == 'en')
                        {!! $Footer8->tilte_en !!}
                        @else
                        {!! $Footer8->tilte_th !!}
                        @endif" class=" mr-2">
                            <img src="{{ asset('img/line-icon-sq.png') }}" alt="">
                        </a>
                    </div>

                    <div class="copyright">
                        <small>© Copyright {{ date('Y') }} GIS Group Co.,Ltd. All Rights Reserved.</small>
                    </div>
                </div>

            </div>

        </div>

    </div>
</footer>
