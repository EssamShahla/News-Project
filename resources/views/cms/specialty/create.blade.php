@extends('cms.parent')

@section('title' , 'Create')
@section('main-title' , 'Create specialty')
@section('sub-title' , 'Create')

@section('style')

@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <!-- left column -->
        <div class="col-md-7 ">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add specialty</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">specialty Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter specialty name">
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
            store('/cms/admin/specialties' , formData);
        }
    </script>
@endsection
