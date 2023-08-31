@extends('admin.master')

@section('title','Loan | Edit')

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
                    <h4 class="card-title">Edit Loan Application</h4>
                </div>
                <form action="{{Route('loan.update',$item->loan_id)}}" method="post">
                    @method('PUT')
                    @csrf
                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <div class="modal-body">

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Borrower</label>
                                <select name="borrower_id" class="form-control">
                                    <option value=""> Select borrower </option>
                                    @foreach ($borrower as $borrower_edit)
                                    @if ($item->borrower_id ==
                                    $borrower_edit->borrower_id)
                                    <option value="{{$borrower_edit->borrower_id}}" selected>
                                        {{$borrower_edit->borrower_name}}
                                    </option>
                                    @else
                                    <option value="{{$borrower_edit->borrower_id}}">
                                        {{$borrower_edit->borrower_name}} </option>
                                    @endif

                                    @endforeach
                                </select>
                                @if($errors->has('borrower_id'))
                                <div class="text-danger">
                                    {{ $errors->first('borrower_id') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="">Loan Type</label>
                                <select id="loan_type" name="loan_type_id" class="form-control">
                                    <option value=""> Select loan type </option>
                                    @foreach ($loan_type as $loan_type_edit)
                                    @if ($loan_type_edit->loan_type_id ==
                                    $item->loan_type_id)
                                    <option value="{{$loan_type_edit->loan_type_id}}" selected>
                                        {{$loan_type_edit->loan_type_name}}
                                    </option>
                                    @else
                                    <option value="{{$loan_type_edit->loan_type_id}}">
                                        {{$loan_type_edit->loan_type_name}} </option>
                                    @endif

                                    @endforeach
                                </select>
                                @if($errors->has('loan_type_id'))
                                <div class="text-danger">
                                    {{ $errors->first('loan_type_id') }}</div>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Amount Applied</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" name="amount_applied"
                                        placeholder="Amount Applied *" value="{{old('amount_applied',$item->amount_applied)}}"/>
                                        <!--value="{{old('amount_applied',number_format($item->amount_applied,2))}}"/>-->

                                </div>

                                @if($errors->has('amount_applied'))
                                <div class="text-danger">
                                    {{ $errors->first('amount_applied') }}</div>
                                @endif
                            </div>


                            <div class="col-md-6">
                                <label for="">Credit Union</label>
                                <select name="credit_union_id" class="form-control">
                                    <option value=""> Select Credit Union </option>
                                    @foreach ($credit_union as $credit_union_edit)
                                    @if ($credit_union_edit->credit_union_id ==
                                    $item->credit_union_id)
                                    <option value="{{$credit_union_edit->credit_union_id}}" selected>
                                        {{$credit_union_edit->credit_union}}
                                    </option>
                                    @else
                                    <option value="{{$credit_union_edit->credit_union_id}}">
                                        {{$credit_union_edit->credit_union}} </option>
                                    @endif

                                    @endforeach
                                </select>
                                @if($errors->has('credit_union_id'))
                                <div class="text-danger">
                                    {{ $errors->first('credit_union_id') }}</div>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">BDO</label>
                                <input type="text" class="form-control" name="bdo" placeholder="BDO"
                                    value="{{old('bdo',$item->bdo)}}">
                            </div>
                            <div class="col-md-6">
                                <label>Octant employee</label>
                                <select name="employee" class="form-control">
                                    <option value="">Select Employee</option>
                                    @foreach ($employee as $employees)
                                    @if ($item->employee == $employees->name)
                                    <option value="{{$employees->name}}" {{ 'selected' }}>
                                        {{$employees->name}}
                                    </option>
                                    @else
                                    <option value="{{$employees->name}}">
                                        {{$employees->name}}
                                    </option>
                                    @endif
                                    @endforeach

                                </select>
                                @if($errors->has('employee'))
                                <span class="form-text">{{ $errors->first('employee') }}</span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Loan Amount</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text"  class="form-control" name="loan_amount"
                                        placeholder="Loan Amount" value="{{old('loan_amount',$item->loan_amount)}}">
                                        <!--value="{{old('loan_amount',number_format($item->loan_amount,2))}}">-->
                                </div>


                            </div>
                            <div class="col-md-6">
                                <label for="">Application Submitted Incomplete</label>
                                <input type="date" class="form-control" name="application_submitted_incomplete"
                                    placeholder="Application Submitted Incomplete"
                                    value="{{old('application_submitted_incomplete',$item->application_submitted_incomplete)}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Credit Memo Issued</label>
                                <input type="date" class="form-control" name="credit_memo"
                                    placeholder="“Credit Memo Issued" value="{{old('credit_memo',$item->credit_memo)}}">

                            </div>
                            <div class="col-md-6">
                                <label for="">Octant Recommendation</label>
                                <select class="form-control select2" name="octant_recommendation">
                                    <option value="TBD" @if ($item->octant_recommendation == 'TBD')
                                        selected
                                        @endif>TBD</option>
                                    <option value="Approved" @if ($item->octant_recommendation == 'Approved')
                                        selected
                                        @endif>Approved</option>
                                    <option value="Decline" @if ($item->octant_recommendation == 'Decline')
                                        selected
                                        @endif>Decline</option>
                                    <option value="Withdrawn" @if ($item->octant_recommendation == 'Withdrawn')
                                        selected
                                        @endif>Withdrawn</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">UW Base Fee</label>
                                <input type="number" class="form-control" id="loan_type_base_fee" name="uw_base_fee" placeholder="UW Base Fee"
                                    value="{{old('uw_base_fee',$item->uw_base_fee)}}">

                            </div>
                            <div class="col-md-6">
                                <label>Additional UW Fee Applied</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)"
                                        name="uw_additional_fee_comments" placeholder="Additional UW Fee Applied"
                                        value="{{old('uw_additional_fee_comments',$item->uw_additional_fee_comments)}}">
                                </div>
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>CU Decision</label>
                                <select name="cu_decision" class="form-control">
                                    <option value="">Select CU Decision</option>
                                    <option value="Approved" @if ($item->cu_decision == 'Approved')
                                        selected
                                        @endif>Approved</option>
                                    <option value="Decline" @if ($item->cu_decision == 'Decline')
                                        selected
                                        @endif>Decline</option>
                                    <option value="Withdrawn" @if ($item->cu_decision == 'Withdrawn')
                                        selected
                                        @endif>Withdrawn</option>
                                </select>
                                @if($errors->has('cu_decision'))
                                <span class="form-text">{{ $errors->first('cu_decision') }}</span>
                                @endif

                            </div>
                            <div class="col-md-6">
                                <label for="">Signed Credit Memo</label>
                                <input type="date" class="form-control" name="signed_credit_memo"
                                    placeholder="Signed Credit Memo"
                                    value="{{old('signed_credit_memo',$item->signed_credit_memo)}}">
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Signed Commitment Letter</label>
                                <input type="date" class="form-control" name="signed_commitment_letter"
                                    placeholder="Signed Commitment Letter"
                                    value="{{old('signed_commitment_letter',$item->signed_commitment_letter)}}">

                            </div>
                            <div class="col-md-6">
                                <label for="">Appraisal Order Date</label>
                                <input type="date" class="form-control" name="appraisal_and_env_ordered"
                                    placeholder="Appraisal Order Date "
                                    value="{{old('appraisal_and_env_ordered',$item->appraisal_and_env_ordered)}}">
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Appraisal Review Completed</label>
                                <input type="date" class="form-control" name="appraisal_and_env_complete"
                                    placeholder="Appraisal Review Completed"
                                    value="{{old('appraisal_and_env_complete',$item->appraisal_and_env_complete)}}">

                            </div>
                            <div class="col-md-6">
                                <label>Octant Status</label>
                                <select name="closing_process" class="form-control">
                                    <option value="">Select Octant Status</option>
                                    <option value="Application" @if ($item->closing_process == 'Application')
                                        selected
                                        @endif>Application</option>
                                    <option value="Underwriting" @if ($item->closing_process == 'Underwriting')
                                        selected
                                        @endif>Underwriting</option>
                                    <option value="Closing" @if ($item->closing_process == 'Closing')
                                        selected
                                        @endif>Closing</option>
                                </select>
                                @if($errors->has('closing_process'))
                                <span class="form-text">{{ $errors->first('closing_process') }}</span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Application Date</label>
                                <input type="date" class="form-control" name="application_date"
                                    placeholder="Application Date"
                                    value="{{old('application_date',$item->application_date)}}">
                            </div>
                            <div class="col-md-6">
                                <label>Date Closed</label>
                                <input type="date" class="form-control" name="date" placeholder="date"
                                    value="{{old('date',$item->date)}}">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>UW Incomplete Start</label>
                                <input type="date" class="form-control" name="uw_incomplete_start"
                                    placeholder="UW Incomplete Start"
                                    value="{{old('uw_incomplete_start',$item->uw_incomplete_start)}}">
                            </div>
                            <div class="col-md-6">
                                <label>UW Incomplete Finish</label>
                                <input type="date" class="form-control" name="uw_incomplete_finish" placeholder="UW Incomplete Finish"
                                    value="{{old('uw_incomplete_finish',$item->uw_incomplete_finish)}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">status</label>
                                <select class="form-control select2bs4" name="status">
                                    <option value=""> -- select status --</option>
                                    <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="archived" {{ $item->status == 'archived' ? 'selected' : '' }}>
                                        Archived</option>
                                </select>
                                @if ($errors->has('status'))
                                <div class="text-danger">{{ $errors->first('status') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label>Anticipated Close Date</label>
                                <input type="date" class="form-control" name="anticipated_close_date"
                                    placeholder="Anticipated Close Date" value="{{old('anticipated_close_date',$item->anticipated_close_date)}}">
                            </div>
                            <div class="col-md-12">
                                <label for="">Notes</label>
                                <textarea rows="4" type="date" class="form-control" name="notes"
                                    placeholder="Add Notes">{{old('notes',$item->notes)}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                @if ($item->serviced_loan == 1)
                                <input style="transform: scale(1.2);" checked type="checkbox" class="check"
                                    id="minimal-checkbox-1" name="serviced_loan">
                                <label class="pl-2" for="minimal-checkbox-1">Serviced Loan</label>
                                @else
                                <input style="transform: scale(1.2);" type="checkbox" class="check"
                                    id="minimal-checkbox-1" name="serviced_loan">
                                <label class="pl-2" for="minimal-checkbox-1">Serviced Loan</label>
                                @endif

                            </div>
                            <div class="col-md-12">
                                @if ($item->settlement_fees_approved == 1)
                                <input style="transform: scale(1.2);" checked type="checkbox" class="check"
                                    id="minimal-checkbox-1" name="settlement_fees_approved">
                                <label class="pl-2" for="minimal-checkbox-1">Settlement Fees Approved</label>
                                @else
                                <input style="transform: scale(1.2);" type="checkbox" class="check"
                                    id="minimal-checkbox-1" name="settlement_fees_approved">
                                <label class="pl-2" for="minimal-checkbox-1">Settlement Fees Approved</label>
                                @endif

                            </div>
                            <div class="col-md-12">
                                @if ($item->loan_qcd == 1)
                                <input style="transform: scale(1.2);" checked type="checkbox" class="check"
                                    id="minimal-checkbox-1" name="loan_qcd">
                                <label class="pl-2" for="minimal-checkbox-1">Loan QC’d</label>
                                @else
                                <input style="transform: scale(1.2);" type="checkbox" class="check"
                                    id="minimal-checkbox-1" name="loan_qcd">
                                <label class="pl-2" for="minimal-checkbox-1">Loan QC’d</label>
                                @endif

                            </div>
                            <div class="col-md-12">
                                @if ($item->credit_qcd == 1)
                                <input style="transform: scale(1.2);" checked type="checkbox" class="check"
                                    id="minimal-checkbox-1" name="credit_qcd">
                                <label class="pl-2" for="minimal-checkbox-1">Credit & Legal File QC’d</label>
                                @else
                                <input style="transform: scale(1.2);" type="checkbox" class="check"
                                    id="minimal-checkbox-1" name="credit_qcd">
                                <label class="pl-2" for="minimal-checkbox-1">Credit & Legal File QC’d</label>
                                @endif

                            </div>
                        </div>


                        @if($item->waived != null || $item->satisfied != null || $item->sort != null)
                        @foreach ($item->waived as $item_waived)

                        <div class="col-md-12" id="delete_category_div{{$item->sort[$loop->index]}}">
                            <div class="edit_category_div" style="background-color: #eee;padding:10px;margin-top:10px;">
                                <div class="form-group">
                                    <div style="display: flex;">
                                        <input type="text" id="sort" name="edit_sort[]" class="categ_sort form-control"
                                            value="{{$item->sort[$loop->index]}}"
                                            style="background-color: white;flex-basis: 50px;margin-right:5px;text-align: center;">
                                        <input type="text" class="form-control" name="edit_label[]" required=""
                                            value="{{$item->label[$loop->index]}}" placeholder="Enter Label"
                                            style="background-color: white;" />

                                            <button onclick="removeForm('delete_category_div{{$item->sort[$loop->index]}}')" type="button"
                                            class="btn btn-danger m-0 ml-2">
                                            <i class="fa fa-close"></i></button>
                                        <!--<button type="button" data-categid="1"-->
                                        <!--    class="del_category btn btn-danger m-0 ml-2">-->
                                        <!--    <i class="fa fa-close"></i></button>-->
                                        <br>


                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Waived :</label>
                                    <select name="edit_waived[]" class="form-control" style="background-color: white;">
                                        <option value=""> Select Option </option>
                                        <option value="1" {{ $item->waived[$loop->index] == '1' ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="0" {{ $item->waived[$loop->index] == '0' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>Satisfied :</label>
                                    <select name="edit_satisfied[]" class="form-control"
                                        style="background-color: white;">
                                        <option value=""> Select Option </option>
                                        <option value="1" {{ $item->satisfied[$loop->index] == '1' ? 'selected' : '' }}>
                                            Yes</option>
                                        <option value="0" {{ $item->satisfied[$loop->index] == '0' ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                </div>
                                <br>
                            </div>
                            <br>
                        </div>

                        @endforeach
                        <input type="hidden" id="raw_count" value="{{count($item["sort"])}}">
                        @endif
                        <div class="col-md-12">
                            <div class="edit_category_main">

                                <button type="button" class="edit_category btn btn-info fa fa-plus "> Add
                                    Pre Closing Condition</button>
                                <br>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-info font-weight-bold">Update Loan</button>
                    </div>
                </form>
            </div>
        </div>

</section>


@endsection

@section('custom_scripts')


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


<script>
    if($('#raw_count').val() == null){
      var  raw_count = 0;
    }else{
       var raw_count = $('#raw_count').val();
    }

    console.log(raw_count);

    var edit_category = '<div class="category_div" style="background-color: #eee;padding:10px;margin-top:10px;"><div class="form-group"><div style="display: flex;"> <input type="text" name="edit_sort[]" class="categ_sort form-control" value="1" style="background-color: white;flex-basis: 50px;margin-right:5px;text-align: center;"> <input type="text" class="form-control" name="edit_label[]" placeholder="Please Enter Label" style="background-color: white;" /> <button type="button" data-categid="1" class="edit_del_category btn btn-danger m-0 ml-2"><i class="fa fa-close"></i></button> </div><br>  <div class="form-group"> <label>Waived :</label> <select name="edit_waived[]" class="form-control" style="background-color: white;">  <option value=""> Select Option </option> <option value="1">Yes</option> <option value="0">No</option> </select> </div> <div class="form-group"> <label>Satisfied :</label> <select name="edit_satisfied[]" class="form-control" style="background-color: white;"> <option value=""> Select Option </option> <option value="1">Yes</option> <option value="0">No</option> </select> </div>';

    var categs_edit= raw_count;


        $(document).on('click',".edit_category",function(){
        categs_edit++;

        $(".edit_category_main").append(edit_category.replace('value="1"','value="'+categs_edit+'"').replace('name="categ_1_product_name[]"','name="categ_'+categs_edit+'_product_name[]"').replace('data-categid="1"','data-categid="'+categs_edit+'"'));

        });
        $(document).on('click',".edit_del_category",function(){
        if(categs_edit>raw_count){
        var categ_id = $(this).attr('data-categid');
        $(this).parent().parent().parent().remove();
        // alert(parseInt(categ_id));
        for (var i = parseInt(categ_id); i <= $(".categ_sort").length; i++) { $(".categ_sort").eq(i-1).val(i);
            $("button[data-categid='"+(i+1)+"' ]").attr('data-categid',i); $("input[name='categ_"+(i+1)+"_product_name[]' ]").attr('name',"categ_"+i+"_product_name[]"); $("input[name='categ_"+(i+1)+"_subitem_id[]' ]").attr('name',"categ_"+i+"_subitem_id[]");
        }
    }
    categs_edit--;
});

function removeForm(id){
            console.log(id);
            $("#"+id).remove();
            categs_edit--;
        }

</script>





@endsection
