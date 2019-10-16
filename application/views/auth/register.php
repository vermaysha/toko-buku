<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="<?php echo base_url('register');?>" method="post">
      <div class="form-group has-feedback <?php echo empty(form_error('fullname')) ? null : 'has-error'?>">
        <input type="text" class="form-control" placeholder="Full name" name="fullname" value="<?php echo set_value('fullname');?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <?php echo form_error('fullname', '<span class="help-block">', '</span>');?>
      </div>
      <div class="form-group has-feedback <?php echo empty(form_error('username')) ? null : 'has-error'?>">
        <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo set_value('username');?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php echo form_error('username', '<span class="help-block">', '</span>');?>
      </div>
      <div class="form-group has-feedback <?php echo empty(form_error('password')) ? null : 'has-error'?>">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('password', '<span class="help-block">', '</span>');?>
      </div>
      <div class="form-group has-feedback <?php echo empty(form_error('retype_password')) ? null : 'has-error'?>">
        <input type="password" class="form-control" placeholder="Retype password" name="retype_password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        <?php echo form_error('retype_password', '<span class="help-block">', '</span>');?>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck <?php echo empty(form_error('term')) ? null : 'has-error'?>">
            <label>
              <input type="checkbox" name="term" value="true" <?php echo set_checkbox('term', 'true')?>> I agree to the <a href="#">terms</a>
            </label>
            <?php echo form_error('term', '<span class="help-block">', '</span>');?>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="register" value="register">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="<?php echo base_url('login');?>" class="text-center">I already have a membership</a>
  </div>
