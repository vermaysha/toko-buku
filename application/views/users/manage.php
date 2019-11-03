    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Products</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Responsive Hover Table</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <?php if (! empty($success)):?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><?php echo $success;?></p>
              </div>
              <?php endif;?>
              <?php if (! empty($error)):?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><?php echo $error;?></p>
              </div>
              <?php endif;?>
              <table class="table table-bordered table-hover">
                <tr>
                  <th>#</th>
                  <th>Photos</th>
                  <th>Fullname</th>
                  <th>Role</th>
                  <th>Last Login</th>
                  <th>Action</th>
                </tr>
                <?php $i=1; foreach($users as $user):?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><img src="<?php echo base_url(get_pp($user['photos']));?>" alt="<?php echo $user['fullname'];?>"></td>
                  <td><?php echo $user['fullname'];?></td>
                  <td><?php echo $user['level'] == 'admin' ? 'Administrator' : 'User Biasa';?></td>
                  <td><?php echo date('l, W F Y', strtotime($user['last_login']));?></td>
                  <td><a href="<?php echo base_url('dashboard/users/delete/'.$user['id']);?>" title="Hapus user" class="btn btn-danger">Hapus</a> <a href="<?php echo base_url('dashboard/users/edit/'.$user['id']);?>" title="Ubah user" class="btn btn-primary">Ubah</a></td>
                </tr>
                <?php $i++; endforeach;?>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
