    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Categories</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Manage all categories</h3>

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
                  <th>Nama</th>
                  <th>Tajuk</th>
                  <th>Jumlah Buku</th>
                  <th class="text-center">Action</th>
                </tr>
                <?php $i=1; foreach ($category as $cat):?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $cat->name;?></td>
                  <td><?php echo $cat->permalink;?></td>
                  <td><?php echo $cat->total_books;?> buku</td>
                  <td class="text-center"><a href="<?php echo base_url('dashboard/category/delete/' . $cat->id);?>" title="Hapus buku" class="btn btn-danger">Hapus</a> <a href="<?php echo base_url('dashboard/category/edit/' . $cat->id);?>" title="Ubah buku" class="btn btn-primary">Ubah</a></td>
                </tr>
                <?php $i++; endforeach;?>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
               <?php echo $pagination;?>
              <!-- <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul> -->
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
