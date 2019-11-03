    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create new Users</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="" enctype="multipart/form-data">
              <div class="box-body">
                <?php if (! empty($error)):?>
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <p><?php echo $error;?></p>
                </div>
                <?php endif;?>
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>');?>
                    <div class="form-group">
                      <label>Nama lengkap</label>
                      <input type="text" class="form-control" placeholder="Nama pengguna" name="fullname" />
                    </div>
                    <div class="form-group">
                      <label>Nama Pengguna</label>
                      <input type="text" class="form-control" placeholder="Nama pengguna" name="username" />
                    </div>
                    <div class="form-group">
                      <label>Foto Profile</label>
                      <input type="file" class="form-control" name="photos" />
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" class="form-control" placeholder="Email" name="email" />
                    </div>
                    <div class="form-group">
                      <label>Kata sandi</label>
                      <input type="text" class="form-control" placeholder="Kata sandi" name="password" />
                    </div>
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <input type="date" class="form-control" placeholder="Tanggal Lahir" name="born_date" />
                    </div>
                    <div class="form-group">
                      <label>Gender</label>
                      <select name="gender" class="form-control">
                        <option value="">--Select gender--</option>
                        <option value="male">Laki-laki</option>
                        <option value="female">Perempuan</option>
                        <option value="other">Lainnya</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Role</label>
                      <select name="role" class="form-control">
                        <option value="">--Select role--</option>
                        <option value="admin">Administrator</option>
                        <option value="user">User Biasa</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="create" value="create">Create new</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
