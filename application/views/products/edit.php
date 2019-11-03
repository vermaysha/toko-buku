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
            <form action="" method="post" enctype="multipart/form-data">
              <div class="box-header with-border">
                <h3 class="box-title">Edit book</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group <?php echo empty(form_error('title')) ? null : 'has-feedback has-error'?>">
                  <label class="control-label"></i> Judul Buku</label>
                  <input type="text" class="form-control"  placeholder="Enter  ..." name="title" value="<?php echo $product->title;?>">
                  <?php echo form_error('title', '<span class="help-block">', '</span>');?>
                </div>
                <div class="form-group <?php echo empty(form_error('publisher')) ? null : 'has-feedback has-error'?>">
                  <label class="control-label"></i> Penerbit</label>
                  <input type="text" class="form-control"  placeholder="Enter ..." name="publisher" value="<?php echo $product->publisher;?>">
                  <?php echo form_error('publisher', '<span class="help-block">', '</span>');?>
                </div>
                <div class="form-group <?php echo empty(form_error('author')) ? null : 'has-feedback has-error'?>">
                  <label class="control-label"></i> Pengarang</label>
                  <input type="text" class="form-control"  placeholder="Enter ..." name="author" value="<?php echo $product->author;?>">
                  <?php echo form_error('author', '<span class="help-block">', '</span>');?>
                </div>
                <div class="form-group <?php echo empty(form_error('category')) ? null : 'has-feedback has-error'?>">
                  <label class="control-label"></i> Kategori Buku</label>
                  <select class="form-control" name="category">
                    <option value="">-- Select one --</option>
                    <?php foreach ($category as $cat):?>
                      <option value="<?php echo $cat->id;?>" <?php echo ($cat->id == $product->category) ? 'selected=""' : null;?>><?php echo $cat->name;?></option>
                    <?php endforeach;;?>
                  </select>
                  <?php echo form_error('category', '<span class="help-block">', '</span>');?>
                </div>
                <div class="form-group <?php echo empty(form_error('photos')) ? null : 'has-feedback has-error'?>">
                  <label class="control-label"></i> Foto buku</label>
                  <input type="file" class="control-box" name="photos">
                  <?php echo form_error('photos', '<span class="help-block">', '</span>');?>
                </div>
                <div class="form-group <?php echo empty(form_error('price')) ? null : 'has-feedback has-error'?>">
                  <label class="control-label"></i> Harga</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="number" class="form-control"  placeholder="Enter ..." name="price" value="<?php echo $product->price;?>">
                  </div>
                  <?php echo form_error('price', '<span class="help-block">', '</span>');?>
                </div>
                <div class="form-group <?php echo empty(form_error('synopsis')) ? null : 'has-feedback has-error'?>">
                  <label class="control-label"></i> Sinopsis</label>
                  <textarea cols="30" rows="5" class="form-control" name="synopsis"><?php echo $product->synopsis;?></textarea>
                  <?php echo form_error('synopsis', '<span class="help-block">', '</span>');?>
                </div>
                <div class="form-group <?php echo empty(form_error('details')) ? null : 'has-feedback has-error'?>">
                  <label class="control-label"></i> Detail</label>
                  <textarea cols="30" rows="5" class="form-control" name="details"><?php echo $product->details;?></textarea>
                  <?php echo form_error('details', '<span class="help-block">', '</span>');?>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                <button type="submit" class="btn btn-info pull-right" name="edit" value="edit">Edit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
