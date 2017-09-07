
<!-- Modal -->
<div class="modal fade" id="myLoading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Loading</h4>
      </div>
      <div class="modal-body">
        <div id="myProgress">
            <div id="myBar" class="text-center">0%</div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="myConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myConfirmLabel">Title</h4>
      </div>
      <div class="modal-body" id="myConfirmBody">
      
      </div>
      <div class ="modal-footer">
          <button type="button" class ="btn btn-warning" id="confirmOK">OK</button>
          <button type="button" class ="btn btn-primary" data-dismiss="modal" >Batal</button>
      </div>
    </div>
  </div>
</div>
  

<!-- Modal -->
<div id="myPreviewimage" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Preview Produk</h4>
      </div>
      <div class="modal-body" id="listImageProd">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner myPreviewImageList">
              <div class="item active">
                <img src="la.jpg" alt="Los Angeles">
              </div>

              <div class="item">
                <img src="chicago.jpg" alt="Chicago">
              </div>

              <div class="item">
                <img src="ny.jpg" alt="New York">
              </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="icon-prev fa-stack fa-lg">
                  <i class="fa fa-angle-left fa-stack-1x"></i>
              </span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="icon-next fa-stack fa-lg">
                  <i class="fa fa-angle-right fa-stack-1x"></i>
              </span>
            </a>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>