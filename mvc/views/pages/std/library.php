
<div class="col-sm-12 well">
  <span style="font-size:16px;"><i class="fa fa-book"></i> &nbsp;&nbsp; Library</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Back</span></a>
</div>

<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
    <div class="well" style="min-height:134px;">
      <h3 align="center">Issue</h3>
      <h3 align="center">
        <b>
          <?php $total_sum=0; foreach ($issue_book as $count_issue) { $total_sum+=count($count_issue); } echo $total_sum; ?>
        </b>
      </h3>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
    <div class="well" style="min-height:134px;">
      <h3 align="center">Due</h3>
      <h3 align="center">
        <b>
          <?php 
          $total_sum=0; 
          foreach ($issue_book as $count_due) {
            if (($count_due->return_type)!= 1) {
             $total_sum+=count($count_due);
           }
         }  
         echo $total_sum;
         ?>
       </b>
     </h3>
   </div>
 </div>
 <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
  <div class="well" style="min-height:134px;">
    <h3 align="center">Fine</h3>
    <h3 align="center">
      <b>
        <?php 
        $total_sum=0; 
        foreach ($issue_book as $count_fine) {
          if (($count_fine->fine_paid)!= 1) {
           $total_sum+= $count_fine->library_fine;
         }
       }  
       echo $total_sum;
       ?>
     </b>
   </h3>
 </div>
</div>
</div>


<div class="col-sm-12 well">
  <p class="well" style="padding:10px;">
    <span> <i class="fa fa-exchange"></i>&nbsp;&nbsp; Issue Book List </span>
  </p>

  <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>student ID</th>
        <th>book</th>
        <th>Issue Date</th>
        <th>Due Date</th>
        <th>Status</th>
        <th>Fine</th>
        <th>Return</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; foreach($issue_book as $row){  ?>
      <tr>
        <td><?php echo $i; $i++; ?></td>
        <td><?php echo $row->std_id; ?></td>
        <td class="characterlimitation"><?php echo $row->book_name; ?></td>
        <td><?php echo $row->issue_date; ?></td>
        <td><?php echo $row->due_date;?></td>
        <td>
          <?php
          $last_date=strtotime(date($row->due_date));
          $current_date = strtotime(date("d-m-Y"));
          if ($last_date < $current_date) {
            echo "<span class='sm-due'>OVER DUE</span>";
          }
          ?>
        </td>
        <td><?php if ($row->fine_paid == 1) { ?>
          <strike><?php echo $row->library_fine; ?></strike>
          <?php }else {
            echo $row->library_fine;} ?> 
        </td>

        <td><?php if ($row->return_type == 1) {?>
          <p class="btn btn-xs btn-success">YES</p>
          <?php }else { ?>
          <p class="btn btn-xs btn-danger">NO</p>
          <?php } ?>
        </td>


        </tr>
        <?php } ?>

      </tbody>
    </table>
  </div>