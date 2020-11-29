<!-- purchasekey.php -->

<br>
<div class="row setup-content">
	<div class=" col-md-6 col-sm-8 col-xs-11 col-center">
		<div class="row" style="padding-left:20px; padding-right:20px;">
			<h4>Purchase Key</h4><br>
			<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
				<?php
				if(form_error('purchasekey'))
					echo "<div class='form-group has-error' >";
				else
					echo "<div class='form-group' >";
				?>
				<label for="purchasekey" class="col-sm-4 control-label">
					<p>Purchase key</p>
				</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="purchasekey" name="purchasekey" value="<?=set_value('purchasekey')?>" >
					<span class=" control-label"><?php echo form_error('purchasekey'); ?></span>
				</div>	
			</div>

			<br>

			<div class="row">
				<div class="col-sm-6 col-xs-6" style="padding:5px; padding-left:20px;">
					<a href="<?=base_url('install/index')?>" class="btn btn-default"><i class="fa fa-long-arrow-left"></i> PREVIOUS</a>
				</div>
				<div class="col-sm-6 col-xs-6" style="padding:5px; padding-right:20px;">
					<button type="submit" class="btn btn-success pull-right">NEXT <i class="fa fa-long-arrow-right"></i></button>
				</div>
			</div>

		</form>
	</div>
</div>
</div>