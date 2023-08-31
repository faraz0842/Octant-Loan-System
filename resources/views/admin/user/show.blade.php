@extends('admin.master')

@section('title','Dashboard')

@section('content')

{{-- <div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Octant Business Service Dashboard</h4>
        </div>
    </div>

</div> --}}

<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User</h4>
                    <button type="button" class="btn btn-info mr-2" data-toggle="modal"
                        data-target="#exampleModalSizeSm">Add User</button>

                    <!--begin::Modal-->
                    <div class="modal fade" id="exampleModalSizeSm" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalSizeSm" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <form action="{{Route('user.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" name="first_name"
                                                placeholder="Enter First Name">
                                            @if($errors->has('first_name'))
                                            <div class="text-danger">{{ $errors->first('first_name') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name"
                                                placeholder="Enter Last Name">
                                            @if($errors->has('last_name'))
                                            <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email"
                                                placeholder="Enter Email">
                                            @if($errors->has('email'))
                                            <div class="text-danger">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>

                                        <label>Image</label>
                                        <div class="form-group">
                                            <input type="file" class="form-control" placeholder="Enter Image"
                                                name="image" value="{{old('image')}}">
                                        </div>

                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Enter Password">
                                            @if($errors->has('password'))
                                            <div class="text-danger">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select id="role_value" class="form-control select2-dropdown" name="role">
                                                <option value="">-- Select Role -- </option>
                                                <option value="admin">Admin</option>
                                                <option value="employee">Employee</option>
                                                <option value="client">Client</option>
                                            </select>
                                            @if($errors->has('role'))
                                            <div class="text-danger">{{ $errors->first('role') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group" id="credit_union">
                                            <label for="">Credit Union</label>
                                            <select name="credit_union" class="form-control">
                                                <option value=""> Select Credit Union </option>
                                                @foreach ($credit_union as $item)
                                                <option value="{{$item->credit_union_id}}"
                                                    @if(old('credit_union')==$item->credit_union_id)
                                                    selected
                                                    @endif>{{$item->credit_union}} </option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('credit_union'))
                                            <div class="text-danger">{{ $errors->first('credit_union') }}
                                            </div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-info font-weight-bold"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-info font-weight-bold">Add</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!--end::Modal-->
                    {{-- <h6 class="card-subtitle">Data table example</h6> --}}
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Update Image</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                <tr>
                                    <td class="text-center">{{$item->first_name}}</td>
                                    <td class="text-center">{{$item->last_name}}</td>
                                    <td class="text-center">{{$item->email}}</td>
                                    <td class="text-center">{{$item->role}}</td>
                                    <td class="text-center">
                                        @if ($item->image == null)
                                        --
                                        @else
                                        <img src="{{URL::asset($item->image)}}" class="img-rounded" width="80px"
                                            height="80px">
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#editimage{{$item->admin_id}}"><i
                                                class="ti-image"></i></button>
                                        <!--end::Button-->
                                    </td>
                                    <td class="text-center">
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#edititem{{$item->admin_id}}"><i
                                                class="ti-pencil"></i></button>
                                        <!--end::Button-->

                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteitem{{$item->admin_id}}"><i
                                                class="ti-trash"></i></button>
                                        <!--end::Button-->
                                    </td>
                                </tr>
                                <!--Edit::Modal-->
                                <div class="modal fade" id="edititem{{$item->admin_id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalSizeSm" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{Route('user.update', $item->admin_id)}}" method="post">
                                                @csrf
                                                @if(session('error'))
                                                <div class="alert alert-danger">{{ session('error') }}</div>
                                                @endif
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" name="first_name"
                                                            value="{{old('first_name',$item->first_name)}}"
                                                            placeholder="Enter First Name">
                                                        @if($errors->has('first_name'))
                                                        <div class="text-danger">{{ $errors->first('first_name') }}
                                                        </div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" name="last_name"
                                                            value="{{old('last_name',$item->last_name)}}"
                                                            placeholder="Enter Last Name">
                                                        @if($errors->has('last_name'))
                                                        <div class="text-danger">{{ $errors->first('last_name') }}
                                                        </div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" name="email"
                                                            value="{{old('email',$item->email)}}"
                                                            placeholder="Enter Email">
                                                        @if($errors->has('email'))
                                                        <div class="text-danger">{{ $errors->first('email') }}
                                                        </div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Role</label>
                                                        <select id="edit_role_value"
                                                            class="form-control select2-dropdown" name="role">
                                                            <option value="">-- Select Role -- </option>
                                                            <option value="admin" @if ($item->role == 'admin')
                                                                selected
                                                                @endif>Admin</option>
                                                            <option value="employee" @if ($item->role == 'employee')
                                                                selected
                                                                @endif>Employee</option>
                                                            <option value="client" @if ($item->role == 'client')
                                                                selected
                                                                @endif>Client</option>
                                                        </select>
                                                        @if($errors->has('role'))
                                                        <div class="text-danger">{{ $errors->first('role') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group" id="edit_credit_union">
                                                        <label for="">Credit Union</label>
                                                        <select name="credit_union" class="form-control">
                                                            <option value=""> Select Credit Union </option>
                                                            @foreach ($credit_union as $credit_union_edit)
                                                            @if ($credit_union_edit->credit_union_id ==
                                                            $item->credit_union)
                                                            <option value="{{$credit_union_edit->credit_union_id}}"
                                                                selected>
                                                                {{$credit_union_edit->credit_union}}
                                                            </option>
                                                            @else
                                                            <option value="{{$credit_union_edit->credit_union_id}}">
                                                                {{$credit_union_edit->credit_union}} </option>
                                                            @endif

                                                            @endforeach
                                                        </select>
                                                    </div>



                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-info font-weight-bold"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="btn btn-info font-weight-bold">Update</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!--Edit::Modal-->
                                <!--EditImage::Model-->
                                <div class="modal fade" id="editimage{{$item->admin_id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalSizeSm" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update User Image</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{Route('user.update.image', $item->admin_id)}}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @if(session()->has('error'))
                                                <div class="alert alert-danger">{{session('error')}}</div>
                                                @endif
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Upload Image</label>
                                                        <input type="file" name="image" class="form_control">
                                                        @if ($errors->has('image'))
                                                        <div class="text-danger">{{ $errors->first('image') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--EditImage::Model End-->
                                <!--  Delete Modal -->
                                <div class="modal fade" id="deleteitem{{$item->admin_id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalSizeSm" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Do you really want to delete this data ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-info font-weight-bold"
                                                    data-dismiss="modal">No</button>
                                                <a href="{{Route('user.destroy',$item->admin_id)}}" type="submit"
                                                    class="btn btn-info font-weight-bold">Yes</a>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!--  Delete Modal -->

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection

@section('custom_scripts')

<script>
    $(document).ready(function () {

        $('#credit_union').hide();
            $('#role_value').change(function(){
                if($('#role_value').val() == 'client') {
                    $('#credit_union').show();
                } else {
                $('#credit_union').hide();
            }
        });

    });
</script>

<script>
    $(document).ready(function () {

        $('#edit_credit_union').hide();
            $('#edit_role_value').change(function(){
                if($('#edit_role_value').val() == 'client') {
                    $('#edit_credit_union').show();
                } else {
                $('#edit_credit_union').hide();
            }
            });

    });
</script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
</script>

@endsection
