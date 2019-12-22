<div class="card">
  <div class="card-header">
    <div class="col-12">
      <?php
      echo $alert;
      ?>
    </div>
    <div class="row">
      <!--  -->
      <div class="col-6">
        <h5>
          <?php echo strtoupper($form_data_civilization->block_header) ?>
        </h5>
      </div>
      <!--  -->
      <div class="col-6">
        <div class="float-right" >
          <?= $header_button?>
        </div>
      </div>
      <!--  -->
    </div>
  </div>
  <div class="card-body">
    <!--  -->
    <?php echo (isset($form_data_civilization->content)) ? $form_data_civilization->content : '';  ?>
    <!--  -->
    <?php echo (isset($pagination_links)) ? $pagination_links : '';  ?>
    <!--  -->
  </div>
</div>