<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark"><?php echo $block_header ?></h5>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <?php echo form_open_multipart( $current_page."add/"."?no_kk=".$no_kk );  ?>
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="col-12">
                    <?php
                    echo $alert;
                    ?>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <h5>
                        <?php echo strtoupper($header) ?>
                        <p class="text-secondary"><small><?php echo $sub_header ?></small></p>
                      </h5>
                    </div>
                    <div class="col-6">
                      <div class="row">
                        <div class="col-2"></div>
                        <div class="col-10">
                          <div class="float-right">
                            <?php echo (isset($header_button)) ? $header_button : '';  ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <!--  -->
                  <?php echo (isset($contents)) ? $contents : '';  ?>
              

                  <!--  -->
                </div>
              </div>
            </div>
          </div>
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
                      <a class="nav-link" href="#tab_1" data-toggle="tab" id="house" >
                        Data Rumah</a>
                    </li>
                    <!-- <li class="col text-center nav-item">
                      <a class="nav-link " href="#tab_2" data-toggle="tab" id="no_house" >
                        Tidak Punya Rumah
                      </a>
                    </li> -->
                    <li>
                    </li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                      <?php echo (isset($house_contents)) ? $house_contents : '';  ?>
                    </div>
                    <div class="tab-pane" id="tab_2">
                    </div>
                    <!-- /.tab-pane -->
                      <button class="btn btn-bold btn-success btn-sm " style="margin-left: 5px;" type="submit">
                        Simpan
                      </button>
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!--  -->
            </div>
            <!--  -->
          </div>
          <!-- row -->
        </div>
    <?php echo form_close()  ?>

  </section>
</div>

<script>
    $(document).ready(function() {
        $("#house").click(function(){
            console.log( 'house' );
            // $("#has_house").val( 1 );
            $( 'input[name="has_house"]' ).val( 1 );

        });
        $("#no_house").click(function(){
            console.log( 'no_house' );
            // $("#has_house").val( 0 );
            $( 'input[name="has_house"]' ).val( 0 );

        });
    });
</script>