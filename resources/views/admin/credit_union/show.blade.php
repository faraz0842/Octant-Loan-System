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
                    <h4 class="card-title">Credit union</h4>
                    <button type="button" class="btn btn-info mr-2" data-toggle="modal"
                        data-target="#exampleModalSizeSm">Add Credit Union</button>

                    <!--begin::Modal-->
                    <div class="modal fade" id="exampleModalSizeSm" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalSizeSm" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Credit Union</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <form action="{{Route('credit-union.store')}}" method="post">
                                    @csrf
                                    @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="credit_union"
                                                placeholder="Enter name">
                                            @if($errors->has('credit_union'))
                                            <div class="text-danger">{{ $errors->first('credit_union') }}</div>
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
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($credit_union as $item)
                                <tr>
                                    <td class="text-center">{{$item->credit_union_id}}</td>
                                    <td class="text-center">{{$item->credit_union}}</td>
                                    <td class="text-center">
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-info mr-2" data-toggle="modal"
                                            data-target="#edititem{{$item->credit_union_id}}"><i
                                                class="ti-pencil"></i></button>
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-info mr-2" data-toggle="modal"
                                            data-target="#deleteitem{{$item->credit_union_id}}"><i
                                                class="ti-trash"></i></button>
                                        <!--end::Button-->
                                    </td>
                                </tr>
                                <!--Edit::Modal-->
                                <div class="modal fade" id="edititem{{$item->credit_union_id}}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Credit Union</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{Route('credit-union.update',$item->credit_union_id)}}"
                                                method="post">
                                                @method('PUT')
                                                @csrf
                                                @if(session('error'))
                                                <div class="alert alert-danger">{{ session('error') }}</div>
                                                @endif
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" name="credit_union"
                                                            value="{{old('credit_union',$item->credit_union)}}"
                                                            placeholder="Enter name">
                                                        @if($errors->has('credit_union'))
                                                        <div class="text-danger">{{ $errors->first('credit_union') }}
                                                        </div>
                                                        @endif
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

                                <!--  Delete Modal -->
                                <div class="modal fade" id="deleteitem{{$item->credit_union_id}}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Credit Union</h5>
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
                                                <a href="{{Route('credit-union.destroy',$item->credit_union_id)}}"
                                                    type="submit" class="btn btn-info font-weight-bold">Yes</a>
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
