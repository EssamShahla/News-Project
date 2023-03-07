@extends('cms.parent')

@section('title' , 'Show')
@section('main-title' , 'specialty data')
@section('sub-title' , 'Show')

@section('style')
    <style>
        #name{
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
              <h3 class="card-title">specialty data</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">specialty Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$specialties->name}}" disabled>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <a href="{{route('specialties.index')}}" type="submit" class="btn btn-success">Go Back</a>
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
