<?php

namespace App\Http\Controllers\Admin;

use App\Exports\IndividualExport;
use App\Exports\LoanExport;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Borrower;
use App\Models\CreditUnion;
use App\Models\Loan;
use App\Models\LoanType;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrower = Borrower::all();
        $loan_type = LoanType::all();
        $credit_union = CreditUnion::all();
        $employee = Admin::where('role','employee')->get();
        $loan = Loan::join('loan_types','loan_types.loan_type_id','loan.loan_type_id')
        ->join('borrower','borrower.borrower_id','loan.borrower_id')
        ->join('credit_union','credit_union.credit_union_id','loan.credit_union_id')
        ->select('loan.*','credit_union.*','loan_types.*','borrower.*')
        ->where('status','!=','archived')->get();

        // return response()->json($loan);
        return view('admin.loan.show',compact('loan','borrower','loan_type','credit_union', 'employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $borrower = Borrower::orderBy('borrower_name')->get();
        $loan_type = LoanType::all();
        $credit_union = CreditUnion::orderBy('credit_union')->get();
        $employee = Admin::where('role','employee')->get();
        return view('admin.loan.add',compact('borrower','loan_type','credit_union', 'employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        //return response()->json($request->input('credit_qcd')) ;

        $request->validate([
            'borrower_id' => 'required',
            'loan_type_id' => 'required',
            'credit_union_id' => 'required',
            'amount_applied' => 'required'
        ]);

        try {

            $loan = new Loan();
            $loan['borrower_id'] = $request->borrower_id;
            $loan['loan_type_id'] = $request->loan_type_id;
            $loan['amount_applied'] = $request->amount_applied;
            $loan['application_date'] = $request->application_date;
            $loan['credit_union_id'] = $request->credit_union_id;
            $loan['bdo'] = $request->bdo;
            $loan['employee'] = $request->employee;
            $loan['loan_amount'] = $request->loan_amount;
            $loan['application_submitted_incomplete'] = $request->application_submitted_incomplete;
            $loan['credit_memo'] = $request->credit_memo;
            $loan['octant_recommendation'] = $request->octant_recommendation;
            $loan['uw_base_fee'] = $request->uw_base_fee;
            $loan['uw_additional_fee_comments'] = $request->uw_additional_fee_comments;
            $loan['uw_incomplete_start'] = $request->uw_incomplete_start;
            $loan['uw_incomplete_finish'] = $request->uw_incomplete_finish;
            $loan['cu_decision'] = $request->cu_decision;
            $loan['signed_credit_memo'] = $request->signed_credit_memo;
            $loan['signed_commitment_letter'] = $request->signed_commitment_letter;
            $loan['appraisal_and_env_ordered'] = $request->appraisal_and_env_ordered;
            $loan['appraisal_and_env_complete'] = $request->appraisal_and_env_complete;
            $loan['closing_process'] = $request->closing_process;
            $loan['anticipated_close_date'] = $request->anticipated_close_date;
            $loan['notes'] = $request->notes;

            if ($request->serviced_loan == 'on') {
                $loan['serviced_loan'] = 1;
            } else {
                $loan['serviced_loan'] = 0;
            }

            if($request->settlement_fees_approved == 'on'){
                $loan['settlement_fees_approved'] = 1;
            }else{
                $loan['settlement_fees_approved'] = 0;
            }

            if($request->loan_qcd == 'on'){
                $loan['loan_qcd'] = 1;
            }else{
                $loan['loan_qcd'] = 0;
            }

            if($request->credit_qcd == 'on'){
                $loan['credit_qcd'] = 1;
            }else{
                $loan['credit_qcd'] = 0;
            }

            $loan['label'] = $request->label;
            $loan['waived'] = $request->waived;
            $loan['satisfied'] = $request->satisfied;
            $loan['sort'] = $request->sort;
            $loan['date'] = $request->date;
            $loan->created_at = Carbon::now();
            $loan->updated_at = Carbon::now();
            $loan->save();

            return redirect()->Route('loan.show');

        } catch (QueryException $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }catch (Exception $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($loan_id)
    {
        $borrower = Borrower::orderBy('borrower_name')->get();
        $loan_type = LoanType::all();
        $credit_union = CreditUnion::orderBy('credit_union')->get();
        $employee = Admin::where('role','employee')->get();
        $item = Loan::where('loan_id',$loan_id)->first();

        //return response()->json($item);
        return view('admin.loan.edit',compact('borrower','loan_type','credit_union', 'employee','item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $loan_id)
    {
        //return $request->input('amount_applied');


        $request->validate([
            'borrower_id' => 'required',
            'loan_type_id' => 'required',
            'credit_union_id' => 'required',
            'amount_applied' => 'required'
        ]);

        try {

            if ($request->serviced_loan == 'on') {
                $serviced_loan = 1;
            } else {
                $serviced_loan = 0;
            }

            if($request->settlement_fees_approved == 'on'){
                $settlement_fees_approved = 1;
            }else{
                $settlement_fees_approved = 0;
            }

            if($request->loan_qcd == 'on'){
                $loan_qcd = 1;
            }else{
                $loan_qcd = 0;
            }

            if($request->credit_qcd == 'on'){
                $credit_qcd = 1;
            }else{
                $credit_qcd = 0;
            }

            $loan = Loan::where('loan_id',$loan_id)->update([

            'borrower_id' => $request->input('borrower_id'),
            'loan_type_id' => $request->input('loan_type_id'),
            'amount_applied' => $request->input('amount_applied'),
            'application_date' => $request->input('application_date'),
            'credit_union_id' => $request->input('credit_union_id'),
            'bdo' => $request->input('bdo'),
            'employee' => $request->input('employee'),
            'loan_amount' => $request->input('loan_amount'),
            'application_submitted_incomplete' => $request->input('application_submitted_incomplete'),
            'credit_memo' => $request->input('credit_memo'),
            'octant_recommendation' => $request->input('octant_recommendation'),
            'uw_base_fee' => $request->input('uw_base_fee'),
            'uw_additional_fee_comments' => $request->input('uw_additional_fee_comments'),
            'cu_decision' => $request->input('cu_decision'),
            'uw_incomplete_start' => $request->input('uw_incomplete_start'),
            'uw_incomplete_finish' => $request->input('uw_incomplete_finish'),
            'signed_credit_memo' => $request->input('signed_credit_memo'),
            'signed_commitment_letter' => $request->input('signed_commitment_letter'),
            'appraisal_and_env_ordered' => $request->input('appraisal_and_env_ordered'),
            'appraisal_and_env_complete' => $request->input('appraisal_and_env_complete'),
            'closing_process' => $request->input('closing_process'),
            'anticipated_close_date' => $request->input('anticipated_close_date'),
            'status' => $request->input('status'),
            'settlement_fees_approved' => $settlement_fees_approved,
            'serviced_loan' => $serviced_loan,
            'loan_qcd' => $loan_qcd,
            'credit_qcd' => $credit_qcd,
            'date' => $request->input('date'),
            'notes' => $request->input('notes'),
            'label' => $request->input('edit_label'),
            'waived' => $request->input('edit_waived'),
            'satisfied' => $request->input('edit_satisfied'),
            'sort' => $request->input('edit_sort'),
            'updated_at' => Carbon::now(),

            ]);

            return redirect()->Route('loan.show');

        } catch (QueryException $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }catch (Exception $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }
    }

    /**************
    | =====================
    |  Loan Edit Dashboard
    | =====================
    **************/


     public function dashboardLoanEdit($loan_id)
    {
        $borrower = Borrower::orderBy('borrower_name')->get();
        $loan_type = LoanType::all();
        $credit_union = CreditUnion::orderBy('credit_union')->get();
        $employee = Admin::where('role','employee')->get();
        $item = Loan::where('loan_id',$loan_id)->first();

        //return response()->json($item);
        return view('admin.loan_dashboard_edit',compact('borrower','loan_type','credit_union', 'employee','item'));
    }


    /**************
    | =====================
    |  Loan Update Dashboard
    | =====================
    **************/
    public function dashboardLoanUpdate(Request $request, $loan_id)
    {
        // return $request->input('edit_waived');

        //return $request->serviced_loan;

        $request->validate([
            'borrower_id' => 'required',
            'loan_type_id' => 'required',
            'credit_union_id' => 'required',
            'amount_applied' => 'required'
        ]);

        try {

            if ($request->serviced_loan == 'on') {
                $serviced_loan = 1;
            } else {
                $serviced_loan = 0;
            }

            if($request->settlement_fees_approved == 'on'){
                $settlement_fees_approved = 1;
            }else{
                $settlement_fees_approved = 0;
            }

            if($request->loan_qcd == 'on'){
                $loan_qcd = 1;
            }else{
                $loan_qcd = 0;
            }

            if($request->credit_qcd == 'on'){
                $credit_qcd = 1;
            }else{
                $credit_qcd = 0;
            }

            $loan = Loan::where('loan_id',$loan_id)->update([

            'borrower_id' => $request->input('borrower_id'),
            'loan_type_id' => $request->input('loan_type_id'),
            'amount_applied' => $request->input('amount_applied'),
            'application_date' => $request->input('application_date'),
            'credit_union_id' => $request->input('credit_union_id'),
            'bdo' => $request->input('bdo'),
            'employee' => $request->input('employee'),
            'loan_amount' => $request->input('loan_amount'),
            'application_submitted_incomplete' => $request->input('application_submitted_incomplete'),
            'credit_memo' => $request->input('credit_memo'),
            'octant_recommendation' => $request->input('octant_recommendation'),
            'uw_base_fee' => $request->input('uw_base_fee'),
            'uw_additional_fee_comments' => $request->input('uw_additional_fee_comments'),
            'uw_incomplete_start' => $request->input('uw_incomplete_start'),
            'uw_incomplete_finish' => $request->input('uw_incomplete_finish'),
            'cu_decision' => $request->input('cu_decision'),
            'signed_credit_memo' => $request->input('signed_credit_memo'),
            'signed_commitment_letter' => $request->input('signed_commitment_letter'),
            'appraisal_and_env_ordered' => $request->input('appraisal_and_env_ordered'),
            'appraisal_and_env_complete' => $request->input('appraisal_and_env_complete'),
            'closing_process' => $request->input('closing_process'),
            'anticipated_close_date' => $request->input('anticipated_close_date'),
            'status' => $request->input('status'),
            'date' => $request->input('date'),
            'notes' => $request->input('notes'),
            'settlement_fees_approved' => $settlement_fees_approved,
            'loan_qcd' => $loan_qcd,
            'credit_qcd' => $credit_qcd,
            'serviced_loan' => $serviced_loan,
            'label' => $request->input('edit_label'),
            'waived' => $request->input('edit_waived'),
            'satisfied' => $request->input('edit_satisfied'),
            'sort' => $request->input('edit_sort'),
            'updated_at' => Carbon::now(),

            ]);

            return redirect()->Route('dashboard');

        } catch (QueryException $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }catch (Exception $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($loan_id)
    {
        Loan::where('loan_id',$loan_id)->delete();
            return redirect()->Route('loan.archived');
    }

    public function changeStatusToArchived($loan_id)
    {
        $archived_status = Loan::where('loan_id',$loan_id)->update(
            [
                'status' => 'archived'
            ]
        );

        return back();
    }

    public function changeStatusToPending($loan_id)
    {
        $archived_status = Loan::where('loan_id',$loan_id)->update(
            [
                'status' => 'pending'
            ]
        );

        return redirect()->Route('loan.archived');
    }

    public function changeStatusToActive($loan_id)
    {
        $archived_status = Loan::where('loan_id',$loan_id)->update(
            [
                'status' => 'active'
            ]
        );

        return redirect()->Route('dashboard');
    }

    public function archivedLoan()
    {
        $loan = Loan::join('loan_types','loan_types.loan_type_id','loan.loan_type_id')
        ->join('borrower','borrower.borrower_id','loan.borrower_id')
        ->join('credit_union','credit_union.credit_union_id','loan.credit_union_id')
        ->select('loan.*','credit_union.*','loan_types.*','borrower.*')
        ->where('status','archived')->get();

        //return response()->json($loan);

        return view('admin.loan.archived',compact('loan'));
    }

    public function fetchDataByAjax(Request $request)
    {
        $value = $request->value;
        $data = LoanType::where('loan_type_id', $value)->first();
        echo $data;

    }

    public function ExportToCSV()
    {
        $id = time();
        return Excel::download(new LoanExport(), $id.'.csv');
    }

    public function ExportIndividualIdToCSV($loan_id)
    {
        return Excel::download(new IndividualExport($loan_id), $loan_id.'.csv');
    }
}
