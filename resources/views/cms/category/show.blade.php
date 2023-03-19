@extends('cms.parent')

@section('title' , 'Show')
@section('main-title' , 'Show category data')
@section('sub-title' , 'Show')

@section('style')
    <style>
        #name{
            cursor: no-drop;
        }
        #description{
            cursor: no-drop;
        }
    </style>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <!-- left column -->
        <div class="col-md-7 ">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">category data</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">category Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$categories->name}}" disabled>
                </div>
                <div class="form-group">
                    <label for="status">status</label>
                    <select class="form-control select2 select2-danger" id="status" name="status" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value="{{$categories->status}}">{{$categories->status}}</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="description">category description</label>
                    <textarea type="text" class="form-control" style="resize: none;" id="description" name="description"
                    placeholder="Enter description of category" value="{{$categories->description}}" cols="80" disabled>
                    </textarea>
                  </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <a href="{{route('categories.index')}}" type="submit" class="btn btn-success">Go Back</a>
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

@section('title')

@endsection
