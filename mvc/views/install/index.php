<br>
<div class="row setup-content">
  <div class=" col-md-6 col-sm-8 col-xs-11 col-center">
    <div class="row" style="padding-left:20px; padding-right:20px;">
      <h4>Pre-Install Checklist</h4>
      <?php
      foreach ($success as $succ) {
        echo "<div class=\"alert alert-success\"><span class=\"fa fa-check-circle\"></span> ". $succ ."</div>";
      }

      foreach ($errors as $er) {
        echo "<div class=\"alert alert-danger\"><span class=\"fa fa-exclamation-circle\"></span> ". $er ."</div>";
      }
      ?>
    </div>
    <div class="row" style="margin-bottom:20px; padding-right:20px;"><a href="<?=base_url('install/purchasekey')?>" class="btn btn-success pull-right">NEXT <i class="fa fa-long-arrow-right"></i></a></div>
  </div>
</div>
<br>
