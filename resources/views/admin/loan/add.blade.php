@extends('admin.master')

@section('title','Loan | Add')

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
                    <h4 class="card-title">Add Loan Application</h4>
                </div>
                <form action="{{Route('loan.store')}}" method="post">
                    @csrf
                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Borrower</label>
                                <select name="borrower_id" class="form-control">
                                    <option value=""> Select borrower </option>
                                    @foreach ($borrower as $item)
                                    <option value="{{$item->borrower_id}}" @if(old('borrower_id')==$item->borrower_id)
                                        selected
                                        @endif>{{$item->borrower_name}} </option>
                                    @endforeach
                                </select>
                                @if($errors->has('borrower_id'))
                                <div class="text-danger">{{ $errors->first('borrower_id') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="">Loan Type</label>
                                <select id="loan_type" name="loan_type_id" class="form-control">
                                    <option value=""> Select loan type </option>
                                    @foreach ($loan_type as $item)
                                    <option value="{{$item->loan_type_id}}" @if(old('loan_type_id')==$item->
                                        loan_type_id)
                                        selected
                                        @endif>{{$item->loan_type_name}} </option>
                                    @endforeach
                                </select>
                                @if($errors->has('loan_type_id'))
                                <div class="text-danger">{{ $errors->first('loan_type_id') }}</div>
                                @endif
                            </div>

                            {{ csrf_field() }}
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Amount Applied</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" name="amount_applied"
                                        placeholder="Amount Applied *" value="{{old('amount_applied')}}">

                                </div>

                                @if($errors->has('amount_applied'))
                                <div class="text-danger">{{ $errors->first('amount_applied') }}</div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="">Credit Union</label>
                                <select name="credit_union_id" class="form-control">
                                    <option value=""> Select Credit Union </option>
                                    @foreach ($credit_union as $item)
                                    <option value="{{$item->credit_union_id}}" @if(old('credit_union_id')==$item->
                                        credit_union_id)
                                        selected
                                        @endif>{{$item->credit_union}} </option>
                                    @endforeach
                                </select>
                                @if($errors->has('credit_union_id'))
                                <div class="text-danger">{{ $errors->first('credit_union_id') }}</div>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">BDO</label>
                                <input type="text" class="form-control" name="bdo" placeholder="BDO"
                                    value="{{old('bdo')}}">
                            </div>

                            <div class="col-md-6">
                                <label>Octant employee</label>
                                <select name="employee" class="form-control">
                                    <option value="">Select Employee</option>
                                    @foreach ($employee as $item)
                                    <option value="{{$item->name}}" @if (old('employee')==$item->
                                        name) {{ 'selected' }} @endif>
                                        {{$item->name}}
                                    </option>
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
                                    <input type="text" class="form-control" name="loan_amount"
                                        placeholder="Loan Amount" value="{{old('loan_amount')}}">

                                </div>

                            </div>
                            <div class="col-md-6">
                                <label for="">Application Submitted Incomplete</label>
                                <input type="date" class="form-control" name="application_submitted_incomplete"
                                    placeholder="Application Submitted Incomplete"
                                    value="{{old('application_submitted_incomplete')}}">
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Credit Memo Issued</label>
                                <input type="date" class="form-control" name="credit_memo"
                                    placeholder="“Credit Memo Issued" value="{{old('credit_memo')}}">

                            </div>

                            <div class="col-md-6">
                                <label>Octant Recommendation</label>
                                <select name="octant_recommendation" class="form-control">
                                    <option value="TBD">TBD</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Decline">Decline</option>
                                    <option value="Withdrawn">Withdrawn</option>
                                </select>
                                @if($errors->has('octant_recommendation'))
                                <span class="form-text">{{ $errors->first('octant_recommendation') }}</span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">UW Base Fee</label>
                                <input type="text" class="form-control" id="loan_type_base_fee" name="uw_base_fee"
                                    placeholder="UW Base Fee" value="{{old('uw_base_fee')}}">

                            </div>
                            <div class="col-md-6">
                                <label>Additional UW Fee Applied</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)" name="uw_additional_fee_comments"
                                        placeholder="Additional UW Fee Applied">

                                </div>
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>CU Decision</label>
                                <select name="cu_decision" class="form-control">
                                    <option value="">Select CU Decision</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Decline">Decline</option>
                                    <option value="Withdrawn">Withdrawn</option>
                                </select>
                                @if($errors->has('cu_decision'))
                                <span class="form-text">{{ $errors->first('cu_decision') }}</span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="">Signed Credit Memo</label>
                                <input type="date" class="form-control" name="signed_credit_memo"
                                    placeholder="Signed Credit Memo" value="{{old('signed_credit_memo')}}">
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Signed Commitment Letter</label>
                                <input type="date" class="form-control" name="signed_commitment_letter"
                                    placeholder="Signed Commitment Letter" value="{{old('signed_commitment_letter')}}">

                            </div>
                            <div class="col-md-6">
                                <label for="">Appraisal Order Date</label>
                                <input type="date" class="form-control" name="appraisal_and_env_ordered"
                                    placeholder="Appraisal Order Date" value="{{old('appraisal_and_env_ordered')}}">
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Appraisal Review Completed</label>
                                <input type="date" class="form-control" name="appraisal_and_env_complete"
                                    placeholder="Appraisal Review Completed"
                                    value="{{old('appraisal_and_env_complete')}}">

                            </div>
                            <div class="col-md-6">
                                <label>Closing Process</label>
                                <select name="closing_process" class="form-control">
                                    <option value="">Select Closing Process</option>
                                    <option value="Application">Application</option>
                                    <option value="Underwriting">Underwriting</option>
                                    <option value="Closing">Closing</option>
                                </select>
                                @if($errors->has('closing_process'))
                                <span class="form-text">{{ $errors->first('closing_process') }}</span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Anticipated Close Date</label>
                                <input type="date" class="form-control" name="anticipated_close_date"
                                    placeholder="Anticipated Close Date" value="{{old('anticipated_close_date')}}">
                            </div>
                            <div class="col-md-6">
                                <label>Date Closed</label>
                                <input type="date" class="form-control" name="date" placeholder="date"
                                    value="{{old('date')}}">
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Application Date</label>
                                <input type="date" class="form-control" name="application_date"
                                    placeholder="Application Date" value="{{old('application_date')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="">Notes</label>
                                <textarea rows="4" type="text" class="form-control" name="notes"
                                    placeholder="Add Notes">{{old('notes')}}</textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>UW Incomplete Start</label>
                                <input type="date" class="form-control" name="uw_incomplete_start"
                                    placeholder="UW Incomplete Start"
                                    value="{{old('uw_incomplete_start')}}">
                            </div>
                            <div class="col-md-6">
                                <label>UW Incomplete Finish</label>
                                <input type="date" class="form-control" name="uw_incomplete_finish" placeholder="UW Incomplete Finish"
                                    value="{{old('uw_incomplete_finish')}}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-12">
                                <input style="transform: scale(1.2);" type="checkbox" class="check"
                                    id="minimal-checkbox-1" name="serviced_loan">
                                <label class="pl-2" for="minimal-checkbox-1">Serviced Loan</label>
                            </div>
                            <div class="col-md-12">
                                <input style="transform: scale(1.2);" type="checkbox" class="check"
                                    id="minimal-checkbox-1" name="settlement_fees_approved">
                                <label class="pl-2" for="minimal-checkbox-1">Settlement Fees Approved</label>
                            </div>
                            <div class="col-md-12">
                                <input style="transform: scale(1.2);" type="checkbox" class="check"
                                    id="minimal-checkbox-1" name="loan_qcd">
                                <label class="pl-2" for="minimal-checkbox-1">Loan QC’d</label>
                            </div>
                            <div class="col-md-12">
                                <input style="transform: scale(1.2);" type="checkbox" class="check"
                                    id="minimal-checkbox-1" name="credit_qcd">
                                <label class="pl-2" for="minimal-checkbox-1">Credit & Legal File QC’d</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="category_main">
                                <button type="button" class="add_category btn btn-info fa fa-plus "> Add
                                    Pre Closing Condition</button>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-info font-weight-bold">Add Loan</button>
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
    var category = '<div class="category_div" style="background-color: #eee;padding:10px;margin-top:10px;"><div class="form-group"><div style="display: flex;"> <input type="text" name="sort[]" class="categ_sort form-control" value="1" style="background-color: white;flex-basis: 50px;margin-right:5px;text-align: center;"> <input type="text" class="form-control" name="label[]" placeholder="Please Enter Label" style="background-color: white;" /> <button type="button" data-categid="1" class="del_category btn btn-danger m-0 ml-2"><i class="fa fa-close"></i></button> </div><br>  <div class="form-group"> <label>Waived :</label> <select name="waived[]" class="form-control" style="background-color: white;">  <option value=""> Select Option </option> <option value="1">Yes</option> <option value="0">No</option> </select> </div> <div class="form-group"> <label>Satisfied :</label> <select name="satisfied[]" class="form-control" style="background-color: white;"> <option value=""> Select Option </option> <option value="1">Yes</option> <option value="0">No</option> </select> </div>';

    var categs= 0;

    $(document).on('click',".add_category",function(){

    categs++;

    $(".category_main").append(category.replace('value="1"','value="'+categs+'"').replace('name="categ_1_product_name[]"','name="categ_'+categs+'_product_name[]"').replace('data-categid="1"','data-categid="'+categs+'"'));

    });
    $(document).on('click',".del_category",function(){
    if(categs>1){
    var categ_id = $(this).attr('data-categid');
    $(this).parent().parent().parent().remove();
    // alert(parseInt(categ_id));
    for (var i = parseInt(categ_id); i <= $(".categ_sort").length; i++) { $(".categ_sort").eq(i-1).val(i);
        $("button[data-categid='"+(i+1)+"' ]").attr('data-categid',i); $("input[name='categ_"+(i+1)+"_product_name[]']").attr('name',"categ_"+i+"_product_name[]"); $("input[name='categ_"+(i+1)+"_subitem_id[]' ]").attr('name',"categ_"+i+"_subitem_id[]");
    }

    }
    categs--;
 });
</script>





@endsection
