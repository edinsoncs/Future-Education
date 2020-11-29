
<br>
<div class="row setup-content">
	<div class=" col-md-6 col-sm-8 col-xs-11 col-center">
		<div class="row" style="padding-left:20px; padding-right:20px;">
			<h4>Database Config</h4><br>
			<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
				<?php
				if(form_error('host'))
					echo "<div class='form-group has-error' >";
				else
					echo "<div class='form-group' >";
				?>
				<label for="host" class="col-sm-2 col-md-offset-2 col-sm-offset-2 control-label">
					<p>Hostname</p>
				</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="host" name="host" value="<?=set_value('host')?>" >
					<span class=" control-label"><?php echo form_error('host'); ?></span>
				</div>	
			</div>

			<?php
			if(form_error('database'))
				echo "<div class='form-group has-error'>";
			else
				echo "<div class='form-group'>";
			?>
			<label for="database" class="col-sm-2 col-md-offset-2 col-sm-offset-2 control-label">
				<p>Database</p>
			</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" id="database" name="database" value="<?=set_value('database')?>" >
				<span class=" control-label"><?php echo form_error('database'); ?></span>
			</div>			
		</div>

		<?php
		if(form_error('user'))
			echo "<div class='form-group has-error' >";
		else
			echo "<div class='form-group' >";
		?>
		<label for="user" class="col-sm-2 col-md-offset-2 col-sm-offset-2 control-label">
			<p>Username</p>
		</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="user" name="user" value="<?=set_value('user')?>" >
			<span class="control-label"><?php echo form_error('user'); ?></span>
		</div>
	</div>

	<?php
	if(form_error('password'))
		echo "<div class='form-group has-error' >";
	else
		echo "<div class='form-group' >";
	?>
	<label for="password" class="col-sm-2 col-md-offset-2 col-sm-offset-2 control-label">
		<p>Password</p>
	</label>
	<div class="col-sm-6">
		<input type="password" class="form-control" id="password" name="password" value="<?=set_value('password')?>" >
	</div>
	<span class="col-sm-4 control-label">
		<?php echo form_error('password'); ?>
	</span>
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
