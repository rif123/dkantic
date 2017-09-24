<div class="sortPagiBar">
    <ul class="display-product-option">
        <li class="view-as-grid selected">
            <span>grid</span>
        </li>
    </ul>
    <div class="sortPagiBar-inner">
        <div class="sort-product">
            <select class="eventOrderBy">
                <option value="">Relevant</option>
                <option value="priceAsc" {{ !empty($input['orderBY'])  ? $input['orderBY'] == 'priceAsc' ? "selected='selected" : '' : '' }} >Harga Produk Terendah</option>
                <option value="priceDesc" {{ !empty($input['orderBY'])  ? $input['orderBY'] == 'priceDesc' ? "selected='selected" : '' : '' }} >Harga Produk Tertinggi</option>
            </select>
            <div class="icon"><i class="fa fa-sort-alpha-asc"></i></div>
        </div>
    </div>
</div>
<div class="category-products">
    <ul class="products row">
        @foreach($listItems as $key => $val)
            @php 
                $getImage = listGetImage($val['id_produk']);
                $getRating = listGetRatting($val['id_produk']);
            @endphp
            <li class="product col-xs-12 col-sm-6 col-md-4">
                <div class="product-container">
                    <div class="inner">
                        <div class="product-left">
                            <div class="product-thumb">
                                <a class="product-img" href="#">
                                    <img onerror="this.onerror=null;this.src='{{ asset('/img/placeholder.png') }}';" src="{{ asset('/images/').'/'.$getImage[0]['name_image_produk'] }}" alt="Product" style="height:20vh">
                                </a>
                                <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                            </div>
                        </div>
                        <div class="product-right">
                            <div class="product-name">
                                <a href="#">{{ $val['nama_produk'] }}</a>
                            </div>
                            <div class="price-box">
                                <span class="product-price">{{ numToRp($val['harga_produk']) }}</span>
                            </div>
                            <div class="product-star">
                                @php $rat = round($getRating[0]['rating_average']) @endphp
                                @for($i=1; $i <= $rat; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </div>
                            <div class="product-button">
                                <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
<div class="sortPagiBar">
    <ul class="display-product-option">
        <li class="view-as-grid selected">
            <span>grid</span>
        </li>
    </ul>
    <div class="sortPagiBar-inner">
        <nav>
            @php 
                if($page<=0) $page = 1;
                echo paginate_one("javascript:void(0)", $page, $pageNumber)
            @endphp
        </nav>
    </div>
</div>