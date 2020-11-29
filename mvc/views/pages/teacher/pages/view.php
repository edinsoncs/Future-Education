<div class="row well">
    <span style="font-size:16px;"><i class="fa fa-eye"></i> &nbsp;&nbsp; Overview</span>
    <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Back</span></a>
</div>


</br>

<form role="form" action="" method="post">
  <div class="row well">
    <div class="col-md-12 col-sm-10 col-xs-12 col-center">
        <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        	<thead>
                <tr>
                    <th>ID</th>
                    <th>Semester Code</th>
                    <th>Batch</th>
                    <th>Section</th>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Credit</th>
                    <th>Action</th>
                </tr>
            </thead>

                <tbody>
                  <?php foreach($get_assign_sub_list as $row) { ?>
                  <tr>
                      <td><?=$row->id;?></td>
                      <td><?=$row->semester_code;?></td>
                      <td><?=$row->std_batch;?></td>
                      <td><?=$row->std_section;?></td>
                      <td class="uppercase"><?=$row->sub_code;?></td>
                      <td class="capitalize"><?=$row->sub_name;?></td>
                      <td ><?=$row->sub_credit;?></td>
                      <td>
                        <?php view(base_url('teachers_overview/viewdetails/'.$row-> id));?>
                      </td>
                  </tr>
                  <?php } ?>
                 </tbody>
        </table>
        <!-- <button class="btn btn-primary nextBtn btn-sm pull-right" id="get_subjectList_button" type="button" >Save</button> -->
    </div>
  </div>
</form>
