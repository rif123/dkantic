<div class="col-xs-12 col-sm-4 col-md-3">
    <div class="block block-sidebar">
        <div class="block-head">
            <h5 class="widget-title">Catalog</h5>
        </div>
        <form id="filterForm">
            <div class="block-inner">
                <div class="block-filter">
                    <div class="block-sub-title">Categories</div>
                    <div class="block-filter-inner">
                        <ul class="check-box-list">
                            @foreach($kategori  as $key => $val)
                                <li>
                                    <input type="checkbox" id="c{{$key}}" name="id_kategori[]" value="{{ $val['id_kategori'] }}" class="getProdItem">
                                    <label for="c{{$key}}">
                                    <span class="button"></span>
                                    {{ $val['nama_kategori'] }}
                                    </label>
                                </li>        
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="block-filter">
                    <div>
                    <form>
                        <div class="form-group">
                        <label for="email">Harga terendah</label>
                            <input type="text" class="form-control" id="email" name="hargaStart">
                        </div>
                        <div class="form-group">
                        <label for="pwd">Harga tertinggi</label>
                            <input type="text" class="form-control" id="pwd" name="hargaEnd">
                        </div>
                        <button type="button" class="btn btn-default filterPrice">Cari</button>
                    </form>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>