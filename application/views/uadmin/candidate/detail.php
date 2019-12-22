<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark"><?php echo $block_header ?></h5>
        </div>
        <div class="col-sm-6 ">
          <div class="float-right">
            <?= $header_button ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <!-- grid -->
      <div class="row">
        <!-- civilization -->
        <!--  -->
        <div class="col-12">
          <!--  -->
          <div class="card">
            <div class="card-header  p-0">
              <!-- <h3 class="card-title p-3">Tabs</h3> -->
              <ul class="row nav nav-pills  p-2">
                <li class="col text-center nav-item">
                  <a class="nav-link active " href="#tab_1" data-toggle="tab">
                    Data</a>
                </li>
                <li class="col text-center nav-item">
                  <a class="nav-link " href="#tab_2" data-toggle="tab">
                    Riwayat
                  </a>
                </li>
                <li>
                </li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <?php echo (isset($form_data_civilization->content)) ? $form_data_civilization->content : '';  ?>
                </div>
                <div class="tab-pane" id="tab_2">
                  <?= $history ?>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!--  -->
        </div>
        <!--  -->
      </div>
      <!-- row -->
      <?php
      foreach ($HOUSE_ARR as $item) {
        echo $item;
      }
      ?>
      <?php
      // if (!empty($HOUSE_ARR) || !isset($map) ) :
      if ( isset($map) ) :
      ?>
        <div class="card" style="height: 570px">
          <div class="card-body">
            <?php if (isset($map))
                echo $map;
              ?>
          </div>
        </div>
      <?php
      endif;
      ?>

      <!-- grid -->
    </div>
  </section>
</div>