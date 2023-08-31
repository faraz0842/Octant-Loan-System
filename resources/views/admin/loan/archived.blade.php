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
                    <h4 class="card-title">Archived Loans</h4>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Officer</th>
                                    <th class="text-center">Amount Applied</th>
                                    <th class="text-center">Member</th>
                                    <th class="text-center">Loan Type</th>
                                    <th class="text-center">Employee</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loan as $item)
                                <tr>
                                    <td class="text-center">{{$item->loan_id}}</td>
                                    <td class="text-center">{{$item->application_date}}</td>
                                    <td class="text-center">{{$item->loan_type_name}}</td>
                                    <td class="text-center">{{'$'.number_format($item->amount_applied)}}</td>
                                    <td class="text-center">{{$item->borrower_name}}</td>
                                    <td class="text-center">{{$item->loan_type_name}}</td>
                                    <td class="text-center">{{$item->employee}}</td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-warning"
                                            style="color: white">{{$item->status}}</span>
                                    </td>
                                    <td class="text-center ml-3" style="padding: 10px 0px 0px 4px;">
                                        <!--begin::Button-->
                                        <a href="{{Route('loan.change.status.pending',$item->loan_id)}}"
                                            class="btn btn-info btn-xs"><img
                                                src="{{asset('AdminStyle/assets/images/archive.png')}}" height="23px"
                                                width="16px" alt="archive icon">UnArchive</a>
                                        <button type="button" class="btn btn-info mr-2" data-toggle="modal"
                                            data-target="#deleteitem{{$item->loan_id}}"><i
                                                class="ti-trash"></i></button>

                                        <!--end::Button-->
                                    </td>
                                </tr>

                                <!--  Delete Modal -->
                                <div class="modal fade" id="deleteitem{{$item->loan_id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalSizeSm" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
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
                                                <a href="{{Route('loan.destroy',$item->loan_id)}}"
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
