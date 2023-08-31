<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanType;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class LoanTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loan_type = LoanType::all();
        return view('admin.loan_type.show',compact('loan_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'loan_type_name' => 'required',
            'uw_base_fee' => 'required'
        ]);

        try {


            $loan_type = new LoanType();
            $loan_type['loan_type_name'] = $request->input('loan_type_name');
            $loan_type['uw_base_fee'] = $request->input('uw_base_fee');
            if($request->is_serviced == 'on'){
                $loan_type['is_serviced'] = 1;
            }else{
                $loan_type['is_serviced'] = 0;
            }
            $loan_type->created_at = Carbon::now();
            $loan_type->updated_at = Carbon::now();
            $loan_type->save();

            return redirect()->Route('loan-type.show');

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $loan_type_id)
    {
        $request->validate([
            'loan_type_name' => 'required',
            'uw_base_fee' => 'required'
        ]);

        try {

            if($request->is_serviced == 'on'){
                  LoanType::where('loan_type_id',$loan_type_id)->update([
                        'loan_type_name' => $request->input('loan_type_name'),
                        'uw_base_fee' => $request->input('uw_base_fee'),
                        'is_serviced' => 1,
                        'updated_at' => Carbon::now()
                    ]);
                }else{
                   LoanType::where('loan_type_id',$loan_type_id)->update([
                        'loan_type_name' => $request->input('loan_type_name'),
                         'uw_base_fee' => $request->input('uw_base_fee'),
                        'is_serviced' => 0,
                        'updated_at' => Carbon::now()
                    ]);
                }


            return redirect()->Route('loan-type.show');

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
    public function destroy($loan_type_id)
    {
        LoanType::where('loan_type_id',$loan_type_id)->delete();
            return redirect()->Route('loan-type.show');
    }
}
