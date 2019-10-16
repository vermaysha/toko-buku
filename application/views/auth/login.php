<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    
    <?php if ( ! empty($error)):?>
      <div class="alert alert-danger">
        <p>
          <?php echo $error;?>
        </p>
      </div>
    <?php endif;?>
    <?php if ( ! empty($success)):?>
      <div class="alert alert-success">
        <p>
          <?php echo $success;?>
        </p>
      </div>
    <?php endif;?>
    <form action="<?php echo base_url('login');?>" method="post">
      <div class="form-group has-feedback <?php echo empty(form_error('username')) ?  null : 'has-error';?>">
        <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo set_value('username'); ?>" />
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <?php echo form_error('username', '<span class="help-block">', '</span>');?>
      </div>
      <div class="form-group has-feedback <?php echo empty(form_error('password')) ?  null : 'has-error';?>">
        <input type="password" class="form-control" placeholder="Password" name="password" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('password', '<span class="help-block">', '</span>');?>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember-me" value="true" /> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="login">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="<?php echo base_url('auth/forgot-password');?>">I forgot my password</a><br>
    <a href="<?php echo base_url('auth/register')?>" class="text-center">Register a new membership</a>

  </div>
