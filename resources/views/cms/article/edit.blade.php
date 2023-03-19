@extends('cms.parent')

@section('title' , 'Edit')
@section('main-title' , 'Edit article')
@section('sub-title' , 'Edit')

@section('style')

@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <!-- left column -->
        <div class="col-md-12 ">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add article</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
                <div class="card-body row-col-12">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="author_id">choose an author</label>
                            <select class="form-control" id="author_id" name="author_id">
                                @foreach ($authors as $author)
                                <option @if ($author->user->id == $articles->author_id) selected @endif value="{{$author->user->id}}">{{$author->user->firstName}} {{$author->user->lastName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="category_id">choose a category</label>
                            <select class="form-control" id="category_id" name="category_id">
                                @foreach ($categories as $category)
                                <option @if ($category->id == $articles->category_id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="title">Add a title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter a title"
                            value="{{$articles->title}}">
                          </div>
                        <div class="col-md-6 form-group">
                            <label for="short_description">short description</label>
                            <input type="text" class="form-control" id="short_description" name="short_description"
                            placeholder="Enter a short description for your article" value="{{$articles->short_description}}">
                          </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="full_description">category description</label>
                            <textarea class="form-control" style="resize: none;" id="full_description" name="full_description"
                            placeholder="Enter a full description" rows="3" cols="50" value="{{$articles->full_description}}">
                            </textarea>
                          </div>
                    </div>
                    <div class="row">
                          <div class="col-md-6 form-group m-auto">
                            <label for="image">choose an image</label>
                            <input type="file" class="form-control" id="image" name="image" placeholder="Enter a title">
                          </div>
                    </div>
                </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performUpdate({{$articles->id}})" class="btn btn-primary">Update</button>
                <a href="{{route('articles.index')}}" type="submit" class="btn btn-success">Go Back</a>
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
        formData.append('author_id' , document.getElementById('author_id').value);
        formData.append('category_id' , document.getElementById('category_id').value);
        formData.append('title' , document.getElementById('title').value);
        formData.append('short_description' , document.getElementById('short_description').value);
        formData.append('full_description' , document.getElementById('full_description').value);
        formData.append('image' , document.getElementById('image').files[0]);
        storeRoute('/cms/admin/articles_update/' + id , formData);
    }

</script>
@endsection
