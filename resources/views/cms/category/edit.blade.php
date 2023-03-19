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
        <div class="col-md-7 ">
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
                  <input type="text" class="form-control" id="name" name="name" value="{{$categories->name}}" placeholder="Enter new category name">
                </div>
                <div class="form-group">
                    <label for="status">status</label>
                    <select class="form-control select2 select2-danger" id="status" name="status" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option @if ($categories->status == 'active') selected @endif value="active">active</option>
                        <option @if ($categories->status == 'inactive') selected @endif value="inactive">inactive</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="description">category description</label>
                    <textarea class="form-control" style="resize: none;" id="description" name="description"
                    placeholder="Enter description of category" value="" cols="80">{{$categories->description}}</textarea>
                  </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performUpdate({{$categories->id}})" class="btn btn-primary">Update</button>
                <a href="{{route('categories.index')}}" type="submit" class="btn btn-success">Go Back</a>
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
        formData.append('status' , document.getElementById('status').value);
        formData.append('description' , document.getElementById('description').value);
        storeRoute('/cms/admin/categories_update/' + id , formData);
    }

</script>
@endsection
