@extends('cms.parent')

@section('title' , 'Create')
@section('main-title' , 'Create country')
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
              <h3 class="card-title">Add country</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Country Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$countries->name}}" placeholder="Enter new country name">
                </div>
                <div class="form-group">
                  <label for="code">Country Code</label>
                  <input type="text" class="form-control" id="code" name="code" value="{{$countries->code}}" placeholder="Enter new country code">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performUpdate({{$countries->id}})" class="btn btn-primary">Update</button>
                <a href="{{route('countries.index')}}" type="submit" class="btn btn-success">Go Back</a>
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
    function performUpdate(id){
        let formData = new FormData();
        formData.append('name' , document.getElementById('name').value);
        formData.append('code' , document.getElementById('code').value);
        storeRoute('/cms/admin/countries_update/' + id , formData);
    }

</script>
@endsection
