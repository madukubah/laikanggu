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
    <div class="container-fluid">
        <div class="row ">
            <!-- header -->
            <div class=" col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <!-- alert  -->
                                <?php
                                    echo $alert;
                                ?>
                                <!-- alert  -->
                            </div>
                        </div>
                        <!--  -->
                        <div class="row clearfix" >
                            <div class="col-md-6">
                                <h2>
                                    <?php echo strtoupper($header)?>
                                </h2>
                            </div>
                            <div class="col-md-6 ">
                                <div class="float-right" >
                                    <?= $header_button?>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                </div>
            </div>
            <!--  -->
            <div class=" col-md-12 ">
                <div class="card">
                    <div class="card-body">
                        <!--  -->
                        <?php echo ( isset( $contents )  ) ? $contents : '' ;  ?>
                        <!--  -->
                        <!--  -->
                        <?php echo ( isset( $pagination_links )  ) ? $pagination_links : '' ;  ?>
                        <!--  -->
                    </div>
                </div>
            </div>
            <!-- photo -->
           
            <!--  -->
        </div>
    </div>
  </section>
</div>