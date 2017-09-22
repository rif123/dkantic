<form class="form-config-website" action="{{ route('setting.wsebsite.save') }}" method="POST" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-4 col-sm-12">
                <label class="input-group-btn">
                    <span class="btn btn-info btn-sm">
                        Logo<input type="file" name="logo_config" style="display: none;"> 
                    </span>
                </label>
            </div>
            <div class="col-md-8 col-sm-12">
                <input type="text" class="form-control"  value="{{ !empty($dataConfig['logo_config']) ? $dataConfig['logo_config'] : '' }}"  readonly placeholder="logo config">
            </div>
        </div>
    </div>
</div>
<div class="row">
         <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Copy Right</label>
                <input type="text" class="form-control" name="copy_right" value="{{ !empty($dataConfig['copy_right']) ? $dataConfig['copy_right'] : '' }}" data-error=".telp_configTxt">
                <div class="telp_configTxt"></div>
            </div>
        </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group label-floating">
            <label class="control-label">Telepon</label>
            <input type="text" class="form-control" name="telp_config" value="{{ !empty($dataConfig['telp_config']) ? $dataConfig['telp_config'] : '' }}" data-error=".telp_configTxt">
            <div class="telp_configTxt"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-4 col-sm-12">
                <label class="input-group-btn">
                    <span class="btn btn-info btn-sm">
                        Favicon<input type="file" name="favicon_config" style="display: none;"> 
                    </span>
                </label>
            </div>
            <div class="col-md-8 col-sm-12">
                <input type="text" class="form-control"  value="{{ !empty($dataConfig['favicon_config']) ? $dataConfig['favicon_config'] : '' }}"  readonly placeholder="Favicon">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group label-floating">
            <label class="control-label">Facebook</label>
            <input type="text" class="form-control" name="fb_config"  data-error=".fb_configTxt" value="{{ !empty($dataConfig['fb_config']) ? $dataConfig['fb_config'] : '' }}" >
            <div class="fb_configTxt"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-4 col-sm-12">
                <label class="input-group-btn">
                    <span class="btn btn-info btn-sm">
                        Fb Icon<input type="file" name="logo_fb_config" style="display: none;"> 
                    </span>
                </label>
            </div>
            <div class="col-md-8 col-sm-12">
                <input type="text" class="form-control"   value="{{ !empty($dataConfig['logo_fb_config']) ? $dataConfig['logo_fb_config'] : '' }}" readonly placeholder="Logo Facebook">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group label-floating">
            <label class="control-label">Twiiter</label>
            <input type="text" class="form-control" name="twit_config"  data-error=".twit_configxt" value="{{ !empty($dataConfig['twit_config']) ? $dataConfig['twit_config'] : '' }}" >
            <div class="fb_configTxt"></div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-4 col-sm-12">
                <label class="input-group-btn">
                    <span class="btn btn-info btn-sm">
                        Twiiter<input type="file" name="logo_twit_config" style="display: none;"> 
                    </span>
                </label>
            </div>
            <div class="col-md-8 col-sm-12">
                <input type="text" class="form-control" value="{{ !empty($dataConfig['logo_twit_config']) ? $dataConfig['logo_twit_config'] : '' }}" readonly placeholder="Logo Twiiter">
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group label-floating">
            <label class="control-label">Google +</label>
            <input type="text" class="form-control" name="gp_config"  data-error=".gp_config" value="{{ !empty($dataConfig['gp_config']) ? $dataConfig['gp_config'] : '' }}" >
            <div class="gp_config"></div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-4 col-sm-12">
                <label class="input-group-btn">
                    <span class="btn btn-info btn-sm">
                        Google<input type="file" name="logo_gp_config" style="display: none;"> 
                    </span>
                </label>
            </div>
            <div class="col-md-8 col-sm-12">
                <input type="text" class="form-control"  value="{{ !empty($dataConfig['logo_gp_config']) ? $dataConfig['logo_gp_config'] : '' }}" readonly placeholder="Logo google + ">
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}" >
<button type="submit" class="btn btn-primary pull-right">Simpan</button>
<div class="clearfix"></div>
</form>