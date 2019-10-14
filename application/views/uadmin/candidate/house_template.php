
<!-- row -->
<div class="row">
  <!--  -->
  <div class="col-5">
    <div class="card">
      <div class="card-header">
        <div class="col-12">
        </div>
        <div class="row">
          <div class="col-12">
            <h5>
              <?php echo strtoupper($header) ?>
            </h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <!--  -->
        <?php echo ( isset( $contents )  ) ? $contents : '' ;  ?>
        <label for="">Sertifikat</label>
        <br>
        <!-- modal -->
        <a href="" data-toggle="modal" data-target="#file_scan"><?php echo $file_scan->name;?></a>
        <br>
        <div class="modal fade" id="file_scan" role="dialog" >
            <div class="modal-dialog modal-xl ">
                  <img class=" img-fluid" src="<?php echo $file_scan->url  ?>" alt="" height="auto" width="1500" >
            </div>
        </div>
        <!--  -->
        <!--  -->
      </div>
    </div>
  </div>
  <!-- col -->
  <div class="col-7">
    <div class="row" >
        <!--  -->
          <!-- IMAGE -->
          <?php
          $title = [ "Tampak Depan", "Tampak Belakang", "Tampak Kiri", "Tampak Kanan" ];
            $images = explode(";", $house->images );
            foreach( $images as $i => $image ):
        ?>
            <div class="col-6" >
                <div class="card" style="height:90%">
                  <div class="card-body">
                      <label for=""> <?= $title[$i]?> </label>
                      <img class=" img-fluid" src="<?php echo $image_url. $image  ?>" alt="" height="auto" width="500" >
                      <a href="" data-toggle="modal" data-target="#image<?php echo  $house->id.$i  ;?>">Lihat</a>
                      <div class="modal fade" id="image<?php echo  $house->id.$i  ;?>" role="dialog">
                          <div class="modal-dialog modal-xl ">
                                <img class=" img-fluid" src="<?php echo $image_url. $image  ?>" alt="" height="auto" width="1500" >
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        <?php 
            endforeach;
        ?>
    </div>
  </div>

</div>
<!-- grid -->