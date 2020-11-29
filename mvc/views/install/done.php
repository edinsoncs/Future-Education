<br>

<div class="row setup-content" >
	<div class=" col-md-6 col-sm-8 col-xs-11 col-center">
		
		<!-- <h4>Site Information</h4> -->
		<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
			<h4 class="text-success">Congratulations! Installation Completed.</h4>
			<h5 class="text-primary">Please click Finish Button and login Your Site . </h5>
			<br>
			<div class="middie-position">
				<label for="host" class="col-sm-4 col-md-offset-1 control-label">
					<p>username : </p>
				</label>
				<div class="col-sm-6">
					<?php echo $this->session->userdata('username'); ?>
				</div>
			</div>
			<div class="middie-position">
				<label for="host" class="col-sm-4 col-md-offset-1 control-label">
					<p>password : </p>
				</label>
				<div class="col-sm-6">
					<?php echo $this->session->userdata('password'); ?>
				</div>
			</div>
			<br><br>

			<div class="row"  style="padding-bottom:20px;">
				<div  class="col-sm-6 col-xs-6" style="padding:5px; padding-left:20px;">
					<a href="<?=base_url('install/database')?>" class="btn btn-default"><i class="fa fa-long-arrow-left"></i> PREVIOUS</a>
				</div>
				<div class="col-sm-6 col-xs-6" style="padding:5px; padding-right:20px;">
					<button type="submit" class="btn btn-success pull-right" name="submit" > Finish </button>
				</div>
			</div>

		</form>
	</div>
</div>

</div>
