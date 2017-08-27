<form class="form-config" action="{{ route('setting.doSaveConfig') }}" method="POST">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Nama Produk</label>
                <input type="text" class="form-control" name="nama_outlate" value="{{ !empty($dataConfig['nama_outlate']) ? $dataConfig['nama_outlate'] : '' }}" data-error=".nama_outlateTxt">
                <div class="nama_outlateTxt"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Harga</label>
                <input type="text" class="form-control" name="nama_pemilik"  data-error=".nama_pemilikTxt" value="{{ !empty($dataConfig['nama_pemilik_outlate']) ? $dataConfig['nama_pemilik_outlate'] : '' }}" >
                <div class="nama_pemilikTxt"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label>Keterangan</label>
            <div class="form-group label-floating">
                <label class="control-label">Masukan Alamat Outlate lengkat d& detail </label>
                <textarea class="form-control" rows="5" name="alamat_outlate" data-error=".alamat_outlateTxt">{{ !empty($dataConfig['alamat_outlate']) ? $dataConfig['alamat_outlate'] : '' }}</textarea>
                <div class="alamat_outlateTxt"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <span class="btn btn-danger btn-sm" style="margin-left:20px"> + </span>

            <div class="input-group literal-1" style="margin-top:-40px">
                <label class="input-group-btn">
                    <span class="btn btn-info btn-sm" style="margin-top:37px">
                        Browse&hellip; <input type="file" name="imageProd[]" style="display: none;"> 
                    </span>
                </label>
                <div class="col-md-7 col-sm-5">
                    <input type="text" class="form-control" readonly>
                </div>
                <div class="col-md-5 col-sm-5">
                    <span class="btn btn-info btn-sm" style="margin-top:37px"> - </span>
                </div>
            </div>

            <div class="input-group literal-1" style="margin-top:-40px">
                <label class="input-group-btn">
                    <span class="btn btn-info btn-sm" style="margin-top:37px">
                        Browse&hellip; <input type="file" name="imageProd[]" style="display: none;"> 
                    </span>
                </label>
                <div class="col-md-7 col-sm-5">
                    <input type="text" class="form-control" readonly>
                </div>
                <div class="col-md-5 col-sm-5">
                    <span class="btn btn-info btn-sm" style="margin-top:37px"> - </span>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
    <div class="clearfix"></div>
</form>