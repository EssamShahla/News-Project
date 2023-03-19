@extends('cms.parent')

@section('title' , 'home page')

@section('style')
<style>
    a{
        color:black;
        font-weight: bold ;
    }
    a:hover{
        text-decoration: none ;
    }
</style>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <h5 class="mb-2">website statistics</h5>
      <div class="row">

        @php
        use App\Models\Admin;
        $adminsCount = Admin::count('id');
        @endphp

        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="nav-icon far fa-user"></i></span>
            <div class="info-box-content">
              <a href="{{route('admins.index')}}" class="info-box-text">Admins</a>
              <a href="{{route('admins.index')}}" class="info-box-number">{{$adminsCount}}</a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


        @php
        use App\Models\Author;
        $authorsCount = Author::count('id');
        @endphp

        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="nav-icon far fa-user"></i></span>
            <div class="info-box-content">
              <a href="{{route('authors.index')}}" class="info-box-text">Authors</a>
              <a href="{{route('authors.index')}}" class="info-box-number">{{$authorsCount}}</a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        @php
        use App\Models\Article;
        $articlesCount = Article::count('id');
        @endphp

        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-success"><i class="nav-icon fas fa-newspaper"></i></span>
            <div class="info-box-content">
              <a href="{{route('articles.index')}}" class="info-box-text">Articles</a>
              <a href="{{route('articles.index')}}" class="info-box-number">{{$articlesCount}}</a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        @php
        use App\Models\Category;
        $categoriesCount = Category::count('id');
        @endphp

        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="nav-icon fas fa-folder-open"></i></span>
            <div class="info-box-content">
              <a href="{{route('categories.index')}}" class="info-box-text">Categories</a>
              <a href="{{route('categories.index')}}" class="info-box-number">{{$categoriesCount}}</a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
    </div>
</section>
      <!-- /.row -->
  <!-- /.content -->
@endsection
