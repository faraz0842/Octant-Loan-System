@extends('admin.master')

@section('title','Loan | Show')

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
                    <h4 class="card-title">Loan Application</h4>
                    <a href="{{Route('loan.add')}}" type="button" class="btn btn-info mr-2">Add Loan</a>
                    <a href="{{Route('loan.export-to-csv')}}" type="button" class="btn btn-info mr-2">Export CSV</a>


                    <div class="table-responsive">
                        <table id="myTable" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Date Created</th>
                                    <th>Loan Name</th>
                                    <th>Loan Amount</th>
                                    <th>Borrower Name</th>
                                    <th>Status</th>
                                    <th>Credit Union</th>
                                    <th>Employee</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loan as $item)
                                <tr>

                                    <td>{{date('d-M-Y', strtotime($item->application_date))}}</td>
                                    <td>{{$item->loan_type_name}}</td>
                                    <td>{{'$'.number_format((float)($item->loan_amount), 2)}}</td>
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
                                    <td colspan="2" style="padding: 10px 0px 0px 4px;">
                                        <!--begin::Button-->
                                        <a href="{{Route('loan.change.status.archived',$item->loan_id)}}"
                                            class="btn btn-info btn-xs"><img
                                                src="{{asset('AdminStyle/assets/images/archive.png')}}" height="23px"
                                                width="16px" alt="archive icon">Archive</a>
                                        <!-- export button -->
                                        <a href="{{Route('loan.export-to-csv.individual',$item->loan_id)}}" class="btn
                                        btn-info"><i class="fa fa-download"></i></a>

                                        <!-- edit button -->
                                        <a href="{{Route('loan.edit',$item->loan_id)}}" type="button"
                                            class="btn btn-info mr-2"><i class="ti-pencil"></i></a>
                                        <!--end::Button-->
                                    </td>
                                </tr>


                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

</section>



@endsection

@section('custom_scripts')

<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<!-- end - This is for export functionality only -->
<script>
    $('#example23').DataTable({
    dom: 'Bfrtip',
    buttons: [
    // 'copy', 'csv', 'excel', 'pdf', 'print'
    'csv'

    ]
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

<script>
    $(document).ready(function () {
        $('#loan_type').change(function(){
            if($(this).val() != ''){
                var value = $(this).val();
                var _token = $('input[name = "_token"]').val();

                $.ajax({
                    url:" {{Route('loan.fetch.data')}} ",
                    method : "POST",
                    data:{
                        value:value , _token:_token ,
                    },
                    success:function(result){
                        var parsed_data = JSON.parse(result);
                        $('#loan_type_base_fee').val(parsed_data.uw_base_fee);
                        console.log(result);
                    }
                })

                // console.log(result);
            }
        });
    });
</script>

{{-- <script>
    var counter=0;

    var add_fields = '<div class="form-group row"><div id="label" class="col-md-12"> <textarea rows="4" type="text" class="form-control" name="label[]" placeholder="Add Label"></textarea> </div> </div> <div class="form-group row"> <div id="waived" class="col-md-6"> <label>Waived</label> <select name="waived[]" class="form-control"> <option value=""> Select Option </option> <option value="1">Yes</option>  <option value="0">No</option> </select> </div>  <div id="satisfied" class="col-md-6"> <label>Satisfied</label>  <select name="satisfied[]" class="form-control"> <option value=""> Select Option </option>  <option value="1">Yes</option>   <option value="0">No</option> </select>  </div>  </div>'


    $('#add_button').click(function(){
        counter++;
        $("#theCount").text(counter);
                    $(".main_div").append([counter ,add_fields]);


    });

</script>
<script>
    var counter=0;

    var edit_fields = '<div class="form-group row"><div  class="col-md-12"> <textarea rows="4" type="text" class="form-control" name="edit_label[]" placeholder="Add Label"></textarea> </div></div><div class="form-group row"><div  class="col-md-6"> <label>Waived</label> <select name="edit_waived[]" class="form-control"><option value=""> Select Option </option><option value="1">Yes</option><option value="0">No</option></select> </div><div  class="col-md-6"> <label>Satisfied</label> <select name="edit_satisfied[]" class="form-control"><option value=""> Select Option </option><option value="1">Yes</option><option value="0">No</option></select> </div></div>'

    $('.edit_button').click(function(){
        counter++;
        $("#theCount").text(counter);

        $(".edit_main_div").append([counter ,edit_fields]);

    });

</script> --}}







@endsection
