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
                    <h4 class="card-title">Borrower</h4>
                    <button type="button" class="btn btn-info mr-2" data-toggle="modal"
                        data-target="#exampleModalSizeSm">Add Borrower</button>

                    <!--begin::Modal-->
                    <div class="modal fade" id="exampleModalSizeSm" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalSizeSm" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Borrower</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <form action="{{Route('borrower.store')}}" method="post">
                                    @csrf
                                    @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="borrower_name"
                                                placeholder="Enter name">
                                            @if($errors->has('borrower_name'))
                                            <div class="text-danger">{{ $errors->first('borrower_name') }}</div>
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
                                @foreach ($borrower as $item)
                                <tr>
                                    <td class="text-center">{{$item->borrower_id}}</td>
                                    <td class="text-center">{{$item->borrower_name}}</td>
                                    <td class="text-center">
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#edititem{{$item->borrower_id}}"><i
                                                class="ti-pencil"></i></button>
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#deleteitem{{$item->borrower_id}}"><i
                                                class="ti-trash"></i></button>
                                        <!--end::Button-->
                                    </td>
                                </tr>
                                <!--Edit::Modal-->
                                <div class="modal fade" id="edititem{{$item->borrower_id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalSizeSm" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Borrower</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{Route('borrower.update',$item->borrower_id)}}"
                                                method="post">
                                                @method('PUT')
                                                @csrf
                                                @if(session('error'))
                                                <div class="alert alert-danger">{{ session('error') }}</div>
                                                @endif
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" name="borrower_name"
                                                            value="{{old('borrower_name',$item->borrower_name)}}"
                                                            placeholder="Enter name">
                                                        @if($errors->has('borrower_name'))
                                                        <div class="text-danger">{{ $errors->first('borrower_name') }}
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
                                <div class="modal fade" id="deleteitem{{$item->borrower_id}}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
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
                                                <a href="{{Route('borrower.destroy',$item->borrower_id)}}" type="submit"
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
