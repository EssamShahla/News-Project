@extends('cms.parent')

@section('title' , 'Create')
@section('main-title' , 'Create category')
@section('sub-title' , 'Create')

@section('style')

@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <!-- left column -->
        <div class="col-md-7">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">category Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name">
                </div>
                <div class="form-group">
                    <label for="status">status</label>
                    <select class="form-control select2 select2-danger" id="status" name="status" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value="active">active</option>
                        <option value="inactive">inactive</option>
                    </select>
                  </div>
                <div class="form-group">
                  <label for="description">category description</label>
                  <textarea class="form-control" style="resize: none;" id="description" name="description"
                  placeholder="Enter description of category" cols="80">
                  </textarea>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection

@section('script')
    <script>
        function performStore(){
            let formData = new FormData();
            formData.append('name' , document.getElementById('name').value);
            formData.append('status' , document.getElementById('status').value);
            formData.append('description' , document.getElementById('description').value);
            store('/cms/admin/categories' , formData);
        }

    </script>
@endsection
