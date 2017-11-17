<!DOCTYPE html>
<html lang="en">
    @include('partials._admin_head')
    <body>
        @include('partials._nav')
        <br /><br />
        @include('partials._adminNav')
        <div class="container">
            @include('partials._messages')
            @yield('content')
            @include('partials._footer')
        </div><!-- end of .container -->
        @include('partials._javascript')
        @yield('scripts')
    </body>
</html>
