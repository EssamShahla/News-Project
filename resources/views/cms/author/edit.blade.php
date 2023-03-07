@extends('cms.parent')

@section('title' , 'Edit Author')

@section('main-title' , 'Edit Author')

@section('sub-title' , 'Edit Author')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit New Author</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>

                  <div class="row">

                    <div class="form-group col-md-6">
                      <label for="firstName">First Name of author</label>
                      <input type="text" class="form-control" id="firstName" name="firstName"
                      value="{{$authors->user->firstName}}" placeholder="Enter First Name of author">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="lastName">Last Name of author</label>
                      <input type="text" class="form-control" id="lastName" name="lastName"
                      value="{{$authors->user->lastName}}" placeholder="Enter Last Name of author">
                    </div>
                  </div>

                  <div class="row">

                    <div class="form-group col-md-6">
                      <label for="email"> Email</label>
                      <input type="email" class="form-control" id="email" name="email"
                      value="{{$authors->email}}" placeholder="Enter Your Email">
                    </div>

                    {{-- <div class="form-group col-md-6">
                      <label for="password"> Password</label>
                      <input type="password" class="form-control" id="password" name="password"
                      value="{{ $authors->password }}" placeholder="Enter Password">
                    </div> --}}
                  </div>

                  <div class="row">

                    <div class="form-group col-md-6">
                      <label for="mobile"> Mobile</label>
                      <input type="text" class="form-control" id="mobile" name="mobile"
                      value="{{$authors->user->mobile}}" placeholder="Enter Your Mobile">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="date"> Date of Birth</label>
                      <input type="date" class="form-control" id="date" name="date"
                      value="{{$authors->user->date}}" placeholder="Enter Your Date of Birth">
                    </div>
                  </div>

                  <div class="row">

                    <div class="form-group col-md-6">
                        <label for="gender"> Gender</label>
                        <select class="form-select form-select-sm" name="gender" style="width: 100%;"
                              id="gender" aria-label=".form-select-sm example">
                              <option selected> {{ $authors->user->gender }} </option>

                              <option value="male">Male</option>
                             <option value="female">FeMale </option>
                          </select>
                 </div>

                    <div class="form-group col-md-6">
                           <label for="status"> Status</label>
                           <select class="form-select form-select-sm" name="status" style="width: 100%;"
                                 id="status" aria-label=".form-select-sm example">
                                 <option selected> {{ $authors->user->status }} </option>
                                 <option value="active">Active </option>
                                <option value="inactive">InActive </option>
                             </select>
                    </div>
                </div>

                <div class="row">

                    <div class="form-group col-md-6">
                        <label>City Name</label>
                        <select class="form-control select2" id="city_id" name="city_id" style="width: 100%;">
                        @foreach($cities as $city)
                          {{-- <option value="{{ $city->id }}">{{ $city->name }}</option> --}}

                          <option @if ($city->id == $authors->user->city_id) selected @endif value="{{ $city->id }}">
                            {{ $city->name }}</option>
                        @endforeach
                        </select>
                      </div>

                    <div class="form-group col-md-6">
                      <label for="image"> Chosse Image</label>
                      <input type="file" class="form-control" id="image" name="image" placeholder="Choose Image">
                    </div>
                </div>

              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performUpdate({{$authors->id}})" class="btn btn-primary">Store</button>
                <a href="{{ route('authors.index') }}" type="submit" class="btn btn-success">Go Back</a>

            </div>
            </form>
          </div>
          <!-- /.card -->
        </div>

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection

@section('scripts')
<script>
  function performUpdate(id){
      let formData = new FormData();
      formData.append('firstName',document.getElementById('firstName').value);
      formData.append('lastName',document.getElementById('lastName').value);
      formData.append('email',document.getElementById('email').value);
    //   formData.append('password',document.getElementById('password').value);
      formData.append('mobile',document.getElementById('mobile').value);
      formData.append('date',document.getElementById('date').value);
      formData.append('gender',document.getElementById('gender').value);
      formData.append('status',document.getElementById('status').value);
      formData.append('city_id',document.getElementById('city_id').value);
      formData.append('image',document.getElementById('image').files[0]);
      storeRoute('/cms/admin/authors_update/'+id , formData)
  }
  </script>
@endsection
