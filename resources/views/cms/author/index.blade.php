@extends('cms.parent')

@section('title' , 'author')
@section('main-title' , 'Index author')
@section('sub-title' , 'Index author')

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
                <a href="{{route('authors.create') }}" type="button" class="btn btn-info">Create new author</a>

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
                    <th>profile photo</th>
                    <th>Full Name</th>
                    <th>email</th>
                    <th>articles</th>
                    <th>gender</th>
                    <th>Status</th>
                    <th>location</th>
                    <th>Settings</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                    <tr>
                        <td>{{$author->id}}</td>
                        <td class="image">
                            <img class="img-circle img-bordered-sm elevation-2" src="{{asset('storage/images/author/' . $author->user->image)}}" width="60" height="60" alt="author Image">
                        </td>
                        <td>{{$author->user->firstName . " " . $author->user->lastName ?? ""}}</td>
                        <td>{{$author->email ?? ""}}</td>
                        <td><a href="{{route('indexArticle' , ['id'=>$author->id])}}" class="btn btn-success">{{$author->articles_count}} article/s</a></td>
                        <td>{{$author->user->gender ?? ""}}</td>
                        <td>{{$author->user->status ?? ""}}</td>
                        <td>{{$author->user->City->name ?? ""}}</td>
                        {{-- <td><span class="tag tag-success">Approved</span></td> --}}
                        <td><div class="btn-group">
                            <a href="{{route('authors.edit' , $author->id) }}" type="button" class="btn btn-info">Edit</a>
                            <button type="button" onclick="performDestroy({{$author->id}} , this)" class="btn btn-danger">Delete</button>
                          </div></td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              {{ $authors->links() }}
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
            confirmDestroy('/cms/admin/authors/' + id , reference);
        }
    </script>
@endsection

