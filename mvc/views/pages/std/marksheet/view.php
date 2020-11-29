<div class="row well">
  <span style="font-size:16px;"><i class="glyphicon glyphicon-list-alt"></i> &nbsp;&nbsp; Marksheet</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Back</span></a>
</div>

</br>

<!-- waiver subject infermation  -->
<?php if(isset($get_waiver_display_id)) {
  if(count($get_waiver_display_id->std_display_id)){?>
  <div class="row">
    <div class="col-md-8 col-sm-10 col-xs-12 col-center">
      <h4>Waiver Subject</h4>
      <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Credit</th>
          </tr>
        </thead>
        <tbody>
          <?php  foreach($get_waiver_sub as $row) {?>
          <tr>
            <td class="uppercase"><?=$row->sub_code?></td>
            <td class="capitalize"><?=$row->sub_name?></td>
            <td ><?=$row->sub_credit?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php }}?>

  <div class="row">
    <div class="col-md-8 col-sm-10 col-xs-12 col-center">
     <?php foreach($point_table as $mks) { ?>
     <h4>Semester Code: <?= $mks->semester_code; ?></h4>
     <p>
      <b>Get Credit:</b> <?=$mks->credit;?> ;

      <?php if (($mks->action)!=0) { ?>

      <b>Earn Credit:</b>
      <?php
      foreach ($get_earn_point as $ec) {
        if($mks->semester_code == $ec->semester_code){
          echo $ec->credit;
        }
      }
      ?> ;

      <b>GPA Point: </b> <?php $get_gpa =($mks->point)/($mks->credit); echo $gpa = number_format($get_gpa, 3);?>
      <?php } ?>
    </p>
    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Code</th>
          <th>Name</th>
          <th>Credit</th>
          <th>Point</th>
          <th>GPA</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($per_sub_point as $sub_point) {
          if($mks->semester_code === $sub_point->semester_code){?>
          <tr>
            <td class="uppercase"><?=$sub_point->sub_code;?></td>
            <td class="capitalize"><?=$sub_point->sub_name;?></td>
            <td class="uppercase"><?=$sub_point->sub_credit;?></td>
            <?php if (($sub_point->action) != 0) {?>
            <td class="uppercase"><?=$sub_point->gpa_point;?></td>
            <td class="uppercase"><?=$sub_point->grade_point;?></td>
            <?php } else { ?>
            <td class="uppercase"></td>
            <td class="uppercase"></td>
            <?php }?>
          </tr>
          <?php } } ?>
        </tbody>
      </table>
      <?php }  ?>
    </div>
  </div>
