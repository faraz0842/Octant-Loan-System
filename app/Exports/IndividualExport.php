<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class IndividualExport implements FromView , ShouldAutoSize
{

    use Exportable;
    private $loan_id;

    public function __construct($loan_id)
    {
        $this->loan_id = $loan_id;
    }


    public function view(): View
    {

         $loan =  Loan::leftJoin('loan_types','loan_types.loan_type_id','loan.loan_type_id')
        ->leftJoin('borrower','borrower.borrower_id','loan.borrower_id')
        ->leftJoin('credit_union','credit_union.credit_union_id','loan.credit_union_id')
        ->select('loan.*','credit_union.*','loan_types.*','borrower.*')
        ->where('loan.loan_id',$this->loan_id)->first();
        
        //return $loan;

        return view('admin.loan.export')->with('loan',$loan);

    }
}
