<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Trầm Hương Tiên Phước</title>
    
    <!-- CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body class="fixed-sidebar">
    <div id="wrapper">
        @include('backend.partials.sidebar')
        
        <div id="page-wrapper" class="gray-bg">
            @include('backend.partials.topnav')
            
            @yield('content')
            
            <div class="footer">
                <div class="pull-right">
                    &copy; {{ date('Y') }} Trầm Hương Tiên Phước
                </div>
                <div>
                    <strong>Copyright</strong> Trầm Hương Tiên Phước Company &copy; {{ date('Y') }}
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    
    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
