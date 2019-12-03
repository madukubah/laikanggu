<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark"><?php echo $block_header ?></h5>
        </div>
        <div class="col-sm-6">
          <h5 class="float-right"><?php echo $edit_button ?></h5>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <!-- grid -->
      <!-- row -->
      <div class="row">
        <!--  -->
        <div class="col-5">
          <div class="card">
            <div class="card-header">
              <div class="col-12">
                <?php
                echo $alert;
                ?>
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
              <?php echo form_open_multipart();  ?>
              <?php echo (isset($contents)) ? $contents : '';  ?>

              <button class="btn btn-bold btn-success btn-sm " style="margin-left: 5px;" type="submit">
                Simpan
              </button>
              <?php echo form_close()  ?>
              <!--  -->
            </div>
          </div>
        </div>
        <!-- col -->
        <div class="col-7">
          <div class="row">
            <!--  -->
            <!-- IMAGE -->
            <?php
            $title = ["Tampak Depan", "Tampak Belakang", "Tampak Kiri", "Tampak Kanan"];
            $images = explode(";", $house->images);
            foreach ($images as $i => $image) :
              ?>
              <div class="col-6">
                <div class="card" style="height:90%">
                  <div class="card-body">
                    <label for=""> <?= $title[$i] ?> </label>
                    <div style="overflow: hidden">
                      <img class=" img-fluid" src="<?php echo $image_url . $image  ?>" alt="" height="auto" width="500">
                    </div>
                    <?= $images_arr[$i]->edit_photo_html ?>
                    <!--  -->
                  </div>
                </div>
              </div>
            <?php
            endforeach;
            ?>
          </div>
        </div>

      </div>
      <script>
        var kendari = [<?= (float) ($longitude)  ?>, <?= (float) ($latitude) ?>];
      </script>
      <div class="card" style="height: 570px">
        <div class="card-body">
          <?php
          if (isset($map))
            echo $map;
          ?>
        </div>
      </div>
      <!-- grid -->
    </div>
  </section>
</div>