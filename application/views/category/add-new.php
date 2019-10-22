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
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create new Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo current_url();?>">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>');?>
                    <div class="form-group">
                      <label for="nameCategory">Nama</label>
                      <input type="text" class="form-control" id="nameCategory" placeholder="Masukkan nama " name="category" />
                    </div>
                    <div class="form-group">
                      <label for="permalinkCategory">Tajuk</label>
                      <input type="text" class="form-control" id="permalinkCategory" placeholder="Masukkan tajuk" name="permalink" />
                      <span class="help-block">*Tajuk adalah alamat (link) pada kategori</span>
                      <span class="help-block text-red">*Kosongkan agar sistem yang mengisi otomatis</span>
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
