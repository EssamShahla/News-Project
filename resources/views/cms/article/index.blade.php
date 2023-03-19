@extends('cms.parent')

@section('title' , 'article')

@section('main-title')
<div class="AuthorName">
        {{$authors->user->firstName . " " . $authors->user->lastName}} Articles page
</div>
@endsection


@section('sub-title' , 'Index article')

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
                <a href="{{route('createArticle' , $id) }}" type="button" class="btn btn-info">Create new article</a>

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
                    <th>article image</th>
                    <th>title</th>
                    <th>short description</th>
                    <th>category</th>
                    <th>Settings</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td>{{$article->id}}</td>
                        <td class="image">
                            <img class="img-circle img-bordered-sm elevation-2" src="{{asset('storage/images/article/' . $article->image)}}" width="60" height="60" alt="article Image">
                        </td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->short_description}}</td>
                        <td>{{$article->category->name}}</td>
                        {{-- <td><span class="tag tag-success">Approved</span></td> --}}
                        <td><div class="btn-group">
                            <a href="{{route('articles.edit' , $article->id) }}" type="button" class="btn btn-info">Edit</a>
                            <button type="button" onclick="performDestroy({{$article->id}} , this)" class="btn btn-danger">Delete</button>
                          </div></td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              {{ $articles->links() }}
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
            confirmDestroy('/cms/admin/articles/' + id , reference);
        }
    </script>
@endsection
