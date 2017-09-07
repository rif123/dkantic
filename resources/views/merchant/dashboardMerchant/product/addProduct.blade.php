<form class="form-add-product" action="{{ route('productMerchant.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Nama Produk</label>
                <input type="text" class="form-control nama_produk" name="nama_produk" value="{{ !empty($dataProd['nama_produk']) ? $dataProd['nama_produk'] : '' }}" data-error=".nama_produkTxt">
                <div class="nama_produkTxt"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Harga</label>
                <input type="text" class="form-control harga_produk" name="harga_produk"  data-error=".harga_produkTxt" value="{{ !empty($dataProd['harga_produk']) ? $dataProd['harga_produk'] : '' }}" >
                <div class="harga_produkTxt"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label>Keterangan</label>
            <div class="form-group label-floating">
                <label class="control-label">Keterangan Produk </label>
                <textarea class="form-control ket_produk" rows="5" name="ket_produk" data-error=".ketprodTxt">{{ !empty($dataConfig['ket_produk']) ? $dataConfig['ket_produk'] : '' }}</textarea>
                <div class="ketprodTxt"></div>
            </div>
        </div>
    </div>
    <div class="row listFileImage hidden">
        <div class="col-md-12 col-sm-12">
            <div class="bodyList">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 browse-file">
        <span class="btn btn-danger btn-sm addFile"> + </span>
           
                <div class="form-group literal loop" data-key="1">
                    <div class="col-md-2 col-sm-12">
                        <label class="input-group-btn">
                            <span class="btn btn-info btn-sm">
                                Browse&hellip; <input type="file" name="name_image_prod[]" style="display: none;"> 
                            </span>
                        </label>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <input type="text" class="form-control"  name="nameFIle" readonly>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <span class="btn btn-info btn-sm removeInputFile"> - </span>
                    </div>
                </div>
        </div>
    </div>
    
    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
    <button type="submit" class="btn btn-primary pull-right buttonActionProduct" >Simpan</button>
    <div class="clearfix"></div>
    <div id="status"></div>
    <style>
        #myProgress {
        width: 100%;
        background-color: #ddd;
        }

        #myBar {
        width: 1%;
        height: 30px;
        background-color: #4CAF50;
        }
    </style>
</form>