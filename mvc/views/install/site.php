<br>
<div class="row setup-content">
	<div class=" col-md-6 col-sm-8 col-xs-11 col-center">
		<div class="row" style="padding-left:20px; padding-right:20px;">
			<h4>Site Information</h4>
			<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="Site Loro" class="col-sm-3 col-sm-offset-1 control-label">
						<p>Site Logo</p>
					</label>
					<div class="col-sm-6">
						<?php echo form_upload('logo_pic'); ?>
					</div>
				</div>
				<div class="form-group">
					<label for="Site Name" class="col-sm-3 col-sm-offset-1 col-sm-offset-1 control-label">
						<p>Site Name</p>
					</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="site_name" name="site_name" value="<?=set_value('site_name')?>">
						<span class="control-label red-color"><?php echo form_error('site_name'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="Tag Line" class="col-sm-3 col-sm-offset-1 control-label">
						<p>Tag Line</p>
					</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="tag_line" name="tag_line" value="<?=set_value('tag_line')?>">
						<span class=" control-label red-color"><?php echo form_error('tag_line'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="Greading Scale" class="col-sm-3 col-sm-offset-1 control-label">
						<p>Grading Scale</p>
					</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="grading_scale" name="grading_scale" value="<?=set_value('grading_scale')?>">
						<span class=" control-label red-color"><?php echo form_error('grading_scale'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="Contact No" class="col-sm-3 col-sm-offset-1 control-label">
						<p>Contact No</p>
					</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="contact_no" name="contact_no" value="<?=set_value('contact_no')?>">
						<span class=" control-label red-color"><?php echo form_error('contact_no'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="Email" class="col-sm-3 col-sm-offset-1 control-label">
						<p>Email</p>
					</label>
					<div class="col-sm-6">
						<input type="email" class="form-control" id="email_address" name="email_address" value="<?=set_value('email_address')?>">
						<span class=" control-label red-color"><?php echo form_error('email_address'); ?></span>
					</div>
				</div>
				<div class="form-group" style="padding-bottom:20px;">
					<label for="Location" class="col-sm-3 col-sm-offset-1 control-label">
						<p>Location</p>
					</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="location_address" name="location_address" value="<?=set_value('location_address')?>">
						<span class=" control-label red-color"><?php echo form_error('location_address'); ?></span>
					</div>
				</div>

				<h4>Login Information</h4>

				<div class="form-group">
					<label for="Display ID" class="col-sm-3 col-sm-offset-1 control-label">
						<p>Display ID</p>
					</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="display_id" name="display_id" value="<?=set_value('display_id')?>">
						<span class=" control-label red-color"><?php echo form_error('display_id'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="User ID" class="col-sm-3 col-sm-offset-1 control-label">
						<p>user Name</p>
					</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="user_name" name="user_name" value="<?=set_value('user_name')?>">
						<span class=" control-label red-color"><?php echo form_error('user_name'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="Password" class="col-sm-3 col-sm-offset-1 control-label">
						<p>Password</p>
					</label>
					<div class="col-sm-6">
						<input type="password" class="form-control" id="password" name="password" value="<?=set_value('password')?>">
						<span class=" control-label red-color"><?php echo form_error('password'); ?></span>
					</div>
				</div>
				<div class="form-group" style="padding-bottom:20px;">
					<label for="Confirm Password" class="col-sm-3 col-sm-offset-1 control-label">
						<p> Confirm Password</p>
					</label>
					<div class="col-sm-6">
						<input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?=set_value('confirm_password')?>">
						<span class=" control-label red-color"><?php echo form_error('confirm_password'); ?></span>
					</div>
				</div>

				<div class="row"  style="padding-bottom:30px;">
					<div class="col-sm-6 col-xs-6" style="padding:5px; padding-left:20px;">
						<a href="<?=base_url('install/database')?>" class="btn btn-default"><i class="fa fa-long-arrow-left"></i> PREVIOUS</a>
					</div>
					<div class="col-sm-6 col-xs-6" style="padding:5px; padding-right:20px;">
						<button type="submit" class="btn btn-success pull-right">NEXT <i class="fa fa-long-arrow-right"></i></button>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
</div>