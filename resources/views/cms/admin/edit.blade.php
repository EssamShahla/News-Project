@extends('cms.parent')

@section('title' , 'Edit')
@section('main-title' , 'Edit Admin')
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
              <h3 class="card-title">Add admin</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
                <div class="card-body row-col-12">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="firstName">First name</label>
                            <input class="form-control" id="firstName" name="firstName" value="{{$admins->user->firstName}}" placeholder="Enter your first name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="{{$admins->user->lastName}}" placeholder="Enter your last name">
                          </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option @if ($admins->user->gender == 'male') selected @endif value="male">Male</option>
                                <option  @if ($admins->user->gender == 'female') selected @endif value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="date">Date Of Birth</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{$admins->user->date}}" placeholder="Enter your Date of birth">
                          </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" name="email" value="{{$admins->email}}" placeholder="Enter email">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                          </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="mobile">your mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="{{$admins->user->mobile}}" placeholder="Enter your mobile">
                          </div>
                          <div class="col-md-6 form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option @if ($admins->user->status == 'active') selected @endif value="active">Active</option>
                                <option @if ($admins->user->status == 'inactive') selected @endif value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="image">choose profile photo</label>
                            <input type="file" class="form-control" id="image" name="image" value="{{$admins->user->image}}">
                          </div>
                          <div class="col-md-6 form-group">
                            <label for="city_id">your City</label>
                            <select class="form-control" id="city_id" name="city_id">
                                @foreach ($cities as $city)
                                <option @if ($city->id == $admins->user->city_id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performUpdate({{$admins->id}})" class="btn btn-primary">Update</button>
                <a href="{{route('admins.index')}}" type="submit" class="btn btn-success">Go Back</a>
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
        formData.append('firstName' , document.getElementById('firstName').value);
        formData.append('lastName' , document.getElementById('lastName').value);
        formData.append('gender' , document.getElementById('gender').value);
        formData.append('date' , document.getElementById('date').value);
        // formData.append('email' , document.getElementById('email').value);
        // formData.append('password' , document.getElementById('password').value);
        formData.append('mobile' , document.getElementById('mobile').value);
        formData.append('status' , document.getElementById('status').value);
        formData.append('city_id' , document.getElementById('city_id').value);
        formData.append('image' , document.getElementById('image').files[0]);
        storeRoute('/cms/admin/admins_update/' + id , formData);
    }

</script>
@endsection
