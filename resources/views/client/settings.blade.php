@extends('client.master')
@section('title','Client | Settings')


@section('content')

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Account Setting</h4>
        </div>
    </div>

</div>

<section class="content">
    <div class="row justify-content-center">
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile"
                            role="tab">Profile</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Change
                            Password</a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">

                    <!--second tab-->
                    <div class="tab-pane active" id="profile" role="tabpanel">
                        <div class="card-body">
                            <br>
                            <form action="{{Route('client.update.profile')}}" method="POST"
                                class="form-horizontal form-material">
                                @csrf
                                @method('PUT')
                                @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="col-md-6 offset-md-3">
                                    <div class="form-group">
                                        <label class="col-md-12">First Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="first_name" class="form-control form-control-line"
                                                value="{{old('first_name',$account_profile->first_name)}}">
                                            @if($errors->has('first_name'))
                                            <div class="text-danger">{{ $errors->first('first_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Last Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="last_name" class="form-control form-control-line"
                                                value="{{old('last_name',$account_profile->last_name)}}">
                                            @if($errors->has('last_name'))
                                            <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="col-md-12">UserName</label>
                                        <div class="col-md-12">
                                            <input type="text" name="username" class="form-control form-control-line"
                                                value="{{old('username',$account_profile->username)}}">
                                            @if($errors->has('username'))
                                            <div class="text-danger">{{ $errors->first('username') }}</div>
                                            @endif
                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" class="form-control form-control-line" name="email"
                                                value="{{old('email',$account_profile->email)}}">
                                            @if($errors->has('email'))
                                            <div class="text-danger">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-info">Update Profile</button>
                                        </div>
                                    </div>

                                </div>
                            </form>


                        </div>
                    </div>
                    <div class="tab-pane" id="settings" role="tabpanel">
                        <div class="card-body">
                            <br>
                            <form action="{{Route('client.update.password')}}" method="POST"
                                class="form-horizontal form-material">
                                @csrf
                                @method('PUT')
                                @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="col-md-6 offset-md-3">
                                    <div class="form-group">
                                        <label class="col-md-12">Current Password</label>
                                        <div class="col-md-12">
                                            <input type="password" placeholder="Current Password"
                                                name="current_password" class="form-control form-control-line"
                                                value="{{old('current_password')}}">
                                            @if($errors->has('current_password'))
                                            <div class="text-danger">{{ $errors->first('current_password') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">New Password</label>
                                        <div class="col-md-12">
                                            <input type="password" placeholder="New Password"
                                                class="form-control form-control-line" name="new_password"
                                                value="{{old('new_password')}}">
                                            @if($errors->has('new_password'))
                                            <div class="text-danger">{{ $errors->first('new_password') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Confirm Password</label>
                                        <div class="col-md-12">
                                            <input type="password" placeholder="Confirm Password"
                                                class="form-control form-control-line" name="confirm_password"
                                                value="{{old('confirm_password')}}">
                                            @if($errors->has('confirm_password'))
                                            <div class="text-danger">{{ $errors->first('confirm_password') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-info">Update Password</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30">
                        @if (session('image') == null )
                        <img src="{{asset('AdminStyle/assets/images/default_avatar.jpg')}}" class="img-circle"
                            width="150" />
                        @else
                        <img src="{{URL::asset(session('image'))}}" class="img-circle" width="150" />
                        @endif

                    </center>
                    <br>
                    <br>
                    <div class="card-footer text-center">
                        <button type="button" class="btn btn-info" data-toggle="modal"
                            data-target="#update_image">Update Image</button>
                    </div>
                </div>

                <div class="modal fade" id="update_image">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 style="float: left">Upload Image :</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{Route('client.update.image')}}" enctype="multipart/form-data">
                                @csrf
                                @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                <div class="modal-body">
                                    <label>Image :</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">No
                                    </button>
                                    <button type="submit" class="btn btn-info">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

            </div>
        </div>
        <!-- Column -->

    </div>
</section>

@endsection
