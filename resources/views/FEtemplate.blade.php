@include('_partFe/header')
<body class="option2">
    @include('FeComponent/headerNav')
    <div class="container">
        <div class="row">
            <div class="row">
              @yield('content')
            </div>
        </div>
    </div>
    @include('FeComponent/footerSocial')
@include('_partFe/footer')