<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Borrower;
use App\Models\CreditUnion;
use App\Models\Loan;
use App\Models\LoanType;

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
        ->where('status','!=','archived')
        ->where('credit_union.credit_union_id',session('credit_union'))->get();

        //return response()->json(count($loan[0]["waived"]));
        return view('client.loan.show',compact('loan','borrower','loan_type','credit_union', 'employee'));
    }
}
