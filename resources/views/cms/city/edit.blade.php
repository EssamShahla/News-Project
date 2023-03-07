@extends('cms.parent')

@section('title' , 'Create')
@section('main-title' , 'Create City')
@section('sub-title' , 'Create')

@section('style')

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
              <h3 class="card-title">Add City</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                    <label>country name</label>
                    <select class="form-control select2 select2-danger" id="country_id" name="country_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        @foreach ($countries as $country)
                        <option @if ($country->id == $cities->country_id) selected @endif value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                  </div>
                <div class="form-group">
                  <label for="name">City name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$cities->name}}" placeholder="Enter new City code">
                </div>
                <div class="form-group">
                    <label for="street">Street name</label>
                    <input type="text" class="form-control" id="street" name="street" value="{{$cities->street}}" placeholder="Enter new City code">
                  </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performUpdate({{$cities->id}})" class="btn btn-primary">Update</button>
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

@section('script')
<script>
    function performUpdate(id){
        let formData = new FormData();
        formData.append('country_id' , document.getElementById('country_id').value);
        formData.append('name' , document.getElementById('name').value);
        formData.append('street' , document.getElementById('street').value);
        storeRoute('/cms/admin/cities_update/' + id , formData);
    }

</script>
@endsection
