<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark"><?php echo $block_header ?></h5>
        </div>
        <div class="col-sm-6">
          <h5 class="float-right"><?php //echo $edit_button ?></h5>
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
                      <?php echo strtoupper($form_data_civilization->block_header) ?>
                    </h5>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <!--  -->
                <?php echo ( isset( $form_data_civilization->content )  ) ? $form_data_civilization->content : '' ;  ?>
                <!--  -->
                <?php echo ( isset( $pagination_links )  ) ? $pagination_links : '' ;  ?>
                <!--  -->
              </div>
            </div>
          </div>
          <!--  -->
      </div>
      <!-- row -->
      <?php 
        foreach( $HOUSE_ARR as $item )
        {
          echo $item ;
        }
      ?>
      <!-- grid -->
    </div>
  </section>
</div>
