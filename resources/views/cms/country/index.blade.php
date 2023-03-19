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

                <form action="" method="get" style="margin-bottom:2%;">
                    <div class="row">
                        <div class="input-icon col-md-2">
                            <input type="text" class="form-control" placeholder="Search ..."
                               name='name' @if( request()->name) value={{request()->name}} @endif/>
                              <span>
                                  <i class="flaticon2-search-1 text-muted"></i>
                              </span>
                            </div>

                            {{-- <div class="input-icon col-md-2">
                                <input type="text" class="form-control" placeholder="Search By Code"
                                   name='code' @if( request()->code) value={{request()->code}} @endif/>
                                  <span>
                                      <i class="flaticon2-search-1 text-muted"></i>
                                  </span>
                                </div> --}}

                    <div class="col-md-4">
                          <button class="btn btn-success btn-md" type="submit"> Filter</button>
                          <a href="{{route('countries.index')}}"  class="btn btn-danger">End Filter</a>
                          {{-- @can('Create-City') --}}

                          <a href="{{route('countries.create')}}"><button type="button" class="btn btn-md btn-primary"> Add New Country </button></a>
                          {{-- @endcan --}}
                    </div>

                         </div>
                </form>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Country Name</th>
                    <th>Country Code</th>
                    <th>Cities number</th>
                    <th>Settings</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                    <tr>
                        <td>{{$country->id}}</td>
                        <td>{{$country->name}}</td>
                        <td>{{$country->code}}</td>
                        <td>{{$country->city_count}}</td>
                        {{-- <td><span class="tag tag-success">Approved</span></td> --}}
                        <td><div class="btn-group">
                            <a href="{{route('countries.edit' , $country->id) }}" type="button" class="btn btn-info">Edit</a>
                            <button type="button" onclick="performDestroy({{$country->id}} , this)" class="btn btn-danger">Delete</button>
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

@section('script')
  <script>
        function performDestroy(id , reference){
            confirmDestroy('/cms/admin/countries/' + id , reference);
        }
    </script>
@endsection
