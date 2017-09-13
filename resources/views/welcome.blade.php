@include('_partFe/header')
<body class="option2">
    @include('FeComponent/headerNav')
    
    <div class="container">
        <div class="row">
            <div class="row">
                @include('FeComponent/menuVertical')
                
                @include('FeComponent/slide')
                
                
                @include('FeComponent/bestSelling')


                @include('FeComponent/hotDeal')


                @include('FeComponent/tester')

            </div>
        </div>
    </div>
    @include('FeComponent/categori')

    @include('FeComponent/footerSocial')

@include('_partFe/footer')