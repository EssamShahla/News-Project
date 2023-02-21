@extends('cms.parent')

@section('title' , 'Country')
@section('main-title' , 'Index country')
@section('sub-title' , 'Index country')

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
                <a href="{{route('countries.create') }}" type="button" class="btn btn-info">Create new country</a>

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
                    <th>Country Name</th>
                    <th>Country Code</th>
                    <th>Settings</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                    <tr>
                        <td>{{$country->id}}</td>
                        <td>{{$country->name}}</td>
                        <td>{{$country->code}}</td>
                        {{-- <td><span class="tag tag-success">Approved</span></td> --}}
                        <td><div class="btn-group">
                            <a href="{{route('countries.edit' , $country->id) }}" type="button" class="btn btn-info">Edit</a>
                            <button type="button" class="btn btn-danger">Delete</button>
                            <a href="{{route('countries.show' , $country->id) }}" type="button" class="btn btn-success">Show</a>
                          </div></td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              {{ $countries->links() }}
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

@section('title')

@endsection
