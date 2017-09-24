<div class="col-sm-3 col-md-2">
    <!-- Block vertical-menu -->
    <div class="block block-vertical-menu">
        <div class="vertical-head">
            <h5 class="vertical-title">Categories</h5>
        </div>
        <div class="vertical-menu-content">
            <ul class="vertical-menu-list">
                    @foreach(listKota() as $key => $val)
                    @php 
                        $explodeData = explode('||',$key);
                        $kota = !empty($explodeData[1]) ? $explodeData[1] : "";
                        $idKota = !empty($explodeData[0]) ? $explodeData[0] : "";
                    @endphp
                    <li class="ef4896">
                        <a href="#">
                        <img class="icon-menu" alt="Funky roots" src="{{ asset('/frontend/data/') }}/8.png">{{ $kota }}</a>
                        <div class="vertical-dropdown-menu">
                            <div class="vertical-groups col-sm-12">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="row mega-products">
                                            @foreach($val as $k => $v) 
                                                @if (!empty($v['nama_kampus']))
                                                    <div class="col-sm-4 mega-product">
                                                        <div class="product-avatar">
                                                            <a href="{{ url('/kampus/') }}/{{ toSlug($v['nama_kampus']) }}/{{ $v['id_kampus'] }}"><img src="{{ asset('/frontend/images/') }}/kampus.png" alt="product1" style="width:40%;"></a>
                                                        </div>
                                                    <br>
                                                        <div class="product-name" style="padding-left:7%">
                                                        <a href="{{ url('/kampus') }}/{{ toSlug($v['nama_kampus']) }}/{{ $v['id_kampus'] }}">{{ $v['nama_kampus'] }}</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
                
            </ul>
        </div>
    </div>
    <!-- ./Block vertical-menu -->
</div>