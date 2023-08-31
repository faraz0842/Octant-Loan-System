<?php

libxml_use_internal_errors(true);

?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Loan Id</th>
                                        <th>Borrower</th>
                                        <th>Loan Type</th>
                                        <th>Amount Applied</th>
                                        <th>Application Date</th>
                                        <th>Credit Union</th>
                                        <th>BDO</th>
                                        <th>Employee</th>
                                        <th>Loan Amount</th>
                                        <th>Application Submitted Incomplete</th>
                                        <th>Credit Demo</th>
                                        <th>Octant Recommendation</th>
                                        <th>UW Base Fee</th>
                                        <th>UW Additional Fee Comments</th>
                                        <th>CU Decision</th>
                                        <th>Signed Credit Memo</th>
                                        <th>Signed Commitment Letter</th>
                                        <th>Appraisal And ENV Ordered</th>
                                        <th>Appraisal And ENV Complete</th>
                                        <th>Closing Process</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Notes</th>
                                        <th>Settlement Fees Approved</th>
                                        <th>Loan QCD</th>
                                        <th>Credit QCD</th>
                                        <th>Preclosing</th>
                                        <th>Waived</th>
                                        <th>Satisfied</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>{{ $loan->loan_id }}</td>
                                        <td>{{ $loan->borrower_name }}</td>
                                        <td>{{ $loan->loan_type_name }}</td>
                                        <td>{{ $loan->amount_applied }}</td>
                                        <td>{{ date('d-M-Y', strtotime($loan->application_date)) }}</td>
                                        <td>{{ $loan->credit_union }}</td>
                                        <td>{{ $loan->bdo }}</td>
                                        <td>{{ $loan->employee }}</td>
                                        <td>{{ $loan->loan_amount }}</td>
                                        <td>{{ $loan->application_submitted_incomplete }}</td>
                                        <td>{{ $loan->credit_memo }}</td>
                                        <td>{{ $loan->octant_recommendation }}</td>
                                        <td>{{ $loan->uw_base_fee }}</td>
                                        <td>{{ $loan->uw_additional_fee_comments }}</td>
                                        <td>{{ $loan->cu_decision }}</td>
                                        <td>{{ $loan->signed_credit_memo }}</td>
                                        <td>{{ $loan->signed_commitment_letter }}</td>
                                        <td>{{ $loan->appraisal_and_env_ordered }}</td>
                                        <td>{{ $loan->appraisal_and_env_complete }}</td>
                                        <td>{{ $loan->closing_process }}</td>
                                        <td>{{ $loan->status }}</td>
                                        <td>{{ date('d-M-Y', strtotime($loan->date)) }}</td>
                                        <td>{{ $loan->notes }}</td>

                                        <td>
                                            @if ($loan->settlement_fees_approved == 0)
                                                No
                                            @else
                                                Yes
                                            @endif
                                        </td>
                                        <td>
                                            @if ($loan->loan_qcd == 0)
                                                No
                                            @else
                                                Yes
                                            @endif
                                        </td>
                                        <td>
                                            @if ($loan->credit_qcd == 0)
                                                No
                                            @else
                                                Yes
                                            @endif
                                        </td>
                                        {{-- @if ($loan['label'] != null || $loan['waived'] != null || $loan['satisfied'] != null)

                                            @foreach ($loan['label'] as $key => $assigned_to_array)
                                                <td>({{$key+1}}){{ $loan->label[$loop->index]  }}</td>
                                            @endforeach

                                            @foreach ($loan['waived'] as $key => $assigned_to_array)
                                                <td>({{$key+1}}){{$loan->waived[$loop->index] ? 'Yes' : 'No' }}</td>
                                            @endforeach

                                            @foreach ($loan['satisfied'] as $key => $assigned_to_array)
                                                <td>({{$key+1}}){{$loan->satisfied[$loop->index] ? 'Yes' : 'No' }}</td>
                                            @endforeach
                                        @endif --}}
                                        @if ($loan['label'] != null || $loan['waived'] != null || $loan['satisfied'] != null)
                                            <td>
                                                @foreach ($loan['label'] as $key => $assigned_to_array)
                                                    ({{ $key + 1 }})
                                                    {{ $loan->label[$loop->index] }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($loan['waived'] as $key => $assigned_to_array)
                                                    ({{ $key + 1 }})
                                                    {{ $loan->waived[$loop->index] ? 'Yes' : 'No' }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($loan['satisfied'] as $key => $assigned_to_array)
                                                    ({{ $key + 1 }})
                                                    {{ $loan->satisfied[$loop->index] ? 'Yes' : 'No' }}
                                                @endforeach
                                            </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
