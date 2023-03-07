@extends('cms.parent')

@section('title' , 'Specialty')
@section('main-title' , 'Index Specialty')
@section('sub-title' , 'Index Specialty')

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
                <a href="{{route('specialties.create')}}" type="button" class="btn btn-info">Create new Specialty</a>

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
                    <th>Specialty Name</th>
                    <th>Settings</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($specialties as $Specialty)
                    <tr>
                        <td>{{$Specialty->id}}</td>
                        <td>{{$Specialty->name}}</td>
                        {{-- <td><span class="tag tag-success">Approved</span></td> --}}
                        <td><div class="btn-group">
                            <a href="{{route('specialties.edit' , $Specialty->id) }}" type="button" class="btn btn-info">Edit</a>
                            <button type="button" onclick="performDestroy({{$Specialty->id}} , this)" class="btn btn-danger">Delete</button>
                            <a href="{{route('specialties.show' , $Specialty->id) }}" type="button" class="btn btn-success">Show</a>
                          </div></td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              {{ $specialties->links() }}
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
            confirmDestroy('/cms/admin/specialties/' + id , reference);
        }
    </script>
@endsection
