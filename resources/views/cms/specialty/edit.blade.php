@extends('cms.parent')

@section('title' , 'edit')
@section('main-title' , 'edit specialties')
@section('sub-title' , 'edit')

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
              <h3 class="card-title">Add specialties</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">specialties Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$specialties->name}}" placeholder="Enter new specialty name">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performUpdate({{$specialties->id}})" class="btn btn-primary">Update</button>
                <a href="{{route('specialties.index')}}" type="submit" class="btn btn-success">Go Back</a>
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
        storeRoute('/cms/admin/specialties_update/' + id , formData);
    }
</script>
@endsection
