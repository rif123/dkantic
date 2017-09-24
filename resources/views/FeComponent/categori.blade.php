<div class="container">
        <div class="row">
            <div class="block-popular-cat2">
                <h3 class="title">Popular Categories</h3>
                @foreach($listFavorite as $key => $val)
                    @php $listProd = listProdByKategori($val['id_kategori']);  @endphp
                    <div class="block block-popular-cat2-item">
                        <div class="block-inner">
                            <div class="cat-name">{{ $val['nama_kategori'] }}</div>
                            <div class="box-subcat">
                                <ul class="list-subcat kt-owl-carousel" data-margin="0" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":7}}'>
                                    @foreach($listProd as $key => $val)
                                        @php 
                                            $getImage = listGetImage($val['id_produk']);  
                                            $image = !empty($getImage[0]['name_image_produk']) ? $getImage[0]['name_image_produk'] : "" ;
                                        @endphp
                                        @if (!empty($image))
                                            <li class="item"><a href="#">
                                                <img onerror="this.onerror=null;this.src='{{ asset('/img/placeholder.png') }}';" src="{{ asset('/images/') }}/{{ $image }}" alt="Cat" style="height:10vh">
                                            </a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>