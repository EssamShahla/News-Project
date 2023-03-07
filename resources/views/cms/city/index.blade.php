@extends('cms.parent')

@section('title' , 'City')
@section('main-title' , 'Index City')
@section('sub-title' , 'Index City')

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
                <a href="{{route('cities.create') }}" type="button" class="btn btn-info">Create new City</a>

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
                    <th>City Name</th>
                    <th>City street</th>
                    <th>Country Name</th>
                    <th>Settings</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $City)
                    <tr>
                        <td>{{$City->id}}</td>
                        <td>{{$City->name}}</td>
                        <td>{{$City->street}}</td>
                        <td>{{$City->Country->name}}</td>
                        {{-- <td><span class="tag tag-success">Approved</span></td> --}}
                        <td><div class="btn-group">
                            <a href="{{route('cities.edit' , $City->id) }}" type="button" class="btn btn-info">Edit</a>
                            <button type="button" onclick="performDestroy({{$City->id}} , this)" class="btn btn-danger">Delete</button>
                            <a href="{{route('cities.show' , $City->id) }}" type="button" class="btn btn-success">Show</a>
                          </div></td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              {{ $cities->links() }}
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
            confirmDestroy('/cms/admin/cities/' + id , reference);
        }
    </script>
@endsection
