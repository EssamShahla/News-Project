@extends('cms.parent')

@section('title' , 'Index Author')

@section('main-title' , 'Index Author')

@section('sub-title' , 'index author')

@section('styles')

@endsection

@section('content')

<section class="content">
    <div class="container-fluid">

      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a href="{{ route('authors.create') }}" type="submit" class="btn btn-success">Add New author</a>

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
                    <th>Image</th>
                    <th>Full Name</th>
                    <th>email</th>
                    <th>Gender</th>
                    <th>status</th>
                    <th>city</th>
                    <th>Setting</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($authors as $author)
                <tr>
                    <td>{{$author->id}}</td>
                    <td>
                      <img class="img-circle img-bordered-sm" src="{{asset('storage/images/author/'.$author->user->image ?? "")}}" width="60" height="60" alt="User Image">
                   </td>
                    <td>{{$author->user->firstName .' '. $author->user->lastName  }}</td>
                    <td>{{$author->email}}</td>
                    <td>{{$author->user->gender ?? ""}}</td>
                    <td>{{$author->user->status ?? ""}}</td>
                    {{-- <td>{{$author->user->city->name ?? ""}}</td> --}}
                    <td><span class="badge bg-info">({{$author->user->city->name ?? ""}})</td>

                    <td>

                    <div class="btn-group">
                        <a href="{{ route('authors.edit' , $author->id ) }}" type="button" class="btn btn-info">Edit</a>
                        <button type="button" onclick="performDestroy({{$author->id}} , this)" class="btn btn-danger">Delete</button>
                        {{-- <a href="{{ route('cities.show' , $author->id) }}" type="button" class="btn btn-success">Show</a> --}}
                      </div></td>
                </tr>
                    @endforeach

                </tbody>
              </table>
            </div>

            {{ $authors->links() }}
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>
@endsection


@section('scripts')

<script>
  function performDestroy(id , reference){

    confirmDestroy('/cms/admin/authors/'+id , reference);
  }
  </script>
@endsection
