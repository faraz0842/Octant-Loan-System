@extends('admin.master')

@section('title','Dashboard')

@section('content')

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Octant Business Services Pipeline</h4>
        </div>
    </div>

</div>

<section class="content">

    <!--.row -->
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-uppercase">Active Loans/Total Amount</h5>
                    <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                        <h1><i class="ti-money text-info"></i></h1>
                        <div class="ml-auto">
                            <h5 class="text-muted">{{$total_loans}} / {{'$'.number_format($total_amount_of_loans, 2)}}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-uppercase">PENDING LOANS</h5>
                    <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                        <h1><i class="ti-reload text-purple"></i></h1>
                        <div class="ml-auto">
                            <h5 class="text-muted">{{$pending_loans}} / {{'$'.number_format($pending_amount, 2)}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-uppercase">APPROVED LOANS</h5>
                    <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                        <h1><i class="ti-check text-danger"></i></h1>
                        <div class="ml-auto">
                            <h5 class="text-muted">{{$approved_loans}} /
                                {{'$'.number_format($total_amount_of_approved_loans, 2)}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-uppercase">ARCHIVED LOANS</h5>
                    <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                        <h1><i class="ti-wallet text-success"></i></h1>
                        <div class="ml-auto">
                            <h5 class="text-muted">{{$archived_loans}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Octant Pipeline</h4>
                    <a href="{{Route('loan.export-to-csv')}}" type="button" class="btn btn-info mr-2">Export CSV</a>

                    <div class="col-md-4 offset-4">
                        <form action="{{Route('dashboard')}}" method="">
                            <div class="form-group">
                                <label>Search By Credit Union</label>
                                <select class="form-control select2" name="serach_credit_union">
                                    <option value=""> Select Credit Union </option>
                                    @foreach ($credit_union as $credit_union)
                                    <option value="{{$credit_union->credit_union_id}}">
                                        {{$credit_union->credit_union}} </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-info">Search</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="card-body">
                    {{-- <h6 class="card-subtitle">Data table example</h6> --}}
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date Created</th>
                                    <th>Loan Name</th>
                                    <th>Loan Amount</th>
                                    <th>Borrower Name</th>
                                    <th>Status</th>
                                    <th>Credit Union</th>
                                    <th>Employee</th>
                                    <th>Octant Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loan as $item)
                                <tr>
                                    <td>{{$item->application_date}}</td>
                                    <td>{{$item->loan_type_name}}</td>
                                    <td>{{'$'.number_format($item->loan_amount, 2)}}</td>
                                    <td>{{$item->borrower_name}}</td>
                                    <td>
                                        @if ($item->status == 'pending')
                                        <span class="badge badge-pill badge-success">{{$item->status}}</span>
                                        @else
                                        <span class="badge badge-pill badge-info">{{$item->status}}</span>
                                        @endif
                                    </td>
                                    <td>{{$item->credit_union}}</td>
                                    <td>{{$item->employee}}</td>
                                    <td>{{$item->closing_process}}</td>
                                    <td colspan="2" style="padding: 10px 0px 0px 4px;">
                                        <a href="{{Route('loan.change.status.archived',$item->loan_id)}}"
                                            class="btn btn-info btn-xs"><img
                                                src="{{asset('AdminStyle/assets/images/archive.png')}}" height="23px"
                                                width="16px" alt="archive icon">Archive</a>
                                        <!-- export button -->
                                        <a href="{{Route('loan.export-to-csv.individual',$item->loan_id)}}" class="btn
                                                                                        btn-info"><i
                                                class="fa fa-download"></i></a>
                                        <a href="{{Route('loan.edit.dashboard',$item->loan_id)}}"
                                            class="btn btn-info mr-2"><i class="ti-pencil"></i></a>
                                    </td>
                                </tr>

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
