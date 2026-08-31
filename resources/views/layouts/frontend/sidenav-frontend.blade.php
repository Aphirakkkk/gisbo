@php
if(Session::has('locale'))
{
$locale = Session::get('locale');
App::setLocale($locale);
}else{
App::setLocale('en');
$locale = 'en';
}
@endphp
<!DOCTYPE html>
<html lang="en">
    @include('components.frontend.linkcss-frontend')

    <body>

        @include('components.frontend.header-frontend')
        <!-- Page content -->
        <div id="rmfullview" class="fullpage">
            @yield('content')
        </div>
        @include('components.frontend.script-frontend')

    </body>


</html>
