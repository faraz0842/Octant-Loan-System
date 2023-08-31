<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreditUnion;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CreditUnionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credit_union = CreditUnion::all();
        return view('admin.credit_union.show',compact('credit_union'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'credit_union' => 'required'
        ]);

        try {

            $borrower = new CreditUnion();
            $borrower['credit_union'] = $request->input('credit_union');
            $borrower->created_at = Carbon::now();
            $borrower->updated_at = Carbon::now();
            $borrower->save();

            return redirect()->Route('credit-union.show');

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
    public function update(Request $request, $credit_union_id)
    {
        $request->validate([
            'credit_union' => 'required'
        ]);

        try {

            CreditUnion::where('credit_union_id',$credit_union_id)->update([
                'credit_union' => $request->input('credit_union'),
                'updated_at' => Carbon::now()
            ]);
            return redirect()->Route('credit-union.show');

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
    public function destroy($credit_union_id)
    {
        CreditUnion::where('credit_union_id',$credit_union_id)->delete();
            return redirect()->Route('credit-union.show');
    }
}
