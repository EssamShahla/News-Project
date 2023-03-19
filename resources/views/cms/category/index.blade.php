@extends('cms.parent')

@section('title' , 'category')
@section('main-title' , 'Index category')
@section('sub-title' , 'Index category')

@section('style')

@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <a href="{{route('categories.create') }}" type="button" class="btn btn-info">Create new category</a>
                <button type="button" onclick="performDestroy_All()"  class="btn btn-danger">Delete All</button>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>category Name</th>
                    <th>status</th>
                    <th>Settings</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td><span @if ($category->status=='active') class="badge bg-success" @endif class="badge bg-danger">{{$category->status}}</td>
                        <td><div class="btn-group">
                            <a href="{{route('categories.edit' , $category->id) }}" type="button" class="btn btn-info">Edit</a>
                            <button type="button" onclick="performDestroy({{$category->id}} , this)" class="btn btn-danger">Delete</button>
                            <a href="{{route('categories.show' , $category->id) }}" type="button" class="btn btn-success">Show</a>
                          </div></td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              {{ $categories->links() }}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection

@section('script')
  <script>
        function performDestroy(id , reference){
            confirmDestroy('/cms/admin/categories/' + id , reference);
        }
        function performDestroy_All(){
            // Find all rows in the table
            let rows = document.querySelectorAll('tbody tr');

            // Check if there are any rows in the table
            if (rows.length === 0) {
            // Show a message dialog
            const message = "There are no elements in the database.";
            alert(message);

            }
            else{
            confirmDestroy('/cms/admin/categories_deleteAll');
            }
        }
    </script>
@endsection
