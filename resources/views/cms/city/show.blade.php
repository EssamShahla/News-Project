@extends('cms.parent')

@section('title' , 'Show')
@section('main-title' , 'Show city data')
@section('sub-title' , 'Show')

@section('style')
    <style>
        #name{
            cursor: no-drop;
        }
        #street{
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
              <h3 class="card-title">city data</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                    <label>Country Name</label>
                    <select id="country_id" name="country_id" class="form-control select2 select2-danger" disabled id="country_id" name="country_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value="" >{{$cities->Country->name}}</option>
                    </select>
                  </div>
                <div class="form-group">
                  <label for="name">City Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$cities->name}}" disabled>
                </div>
                <div class="form-group">
                  <label for="street">Street Name</label>
                  <input type="text" class="form-control" id="street" name="street" value="{{$cities->street}}" disabled>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <a href="{{route('cities.index')}}" type="submit" class="btn btn-success">Go Back</a>
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
