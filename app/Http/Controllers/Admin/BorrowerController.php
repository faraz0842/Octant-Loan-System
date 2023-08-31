<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrower;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrower = Borrower::all();
        return view('admin.borrower.show',compact('borrower'));
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
            'borrower_name' => 'required'
        ]);

        try {

            $borrower = new Borrower();
            $borrower['borrower_name'] = $request->input('borrower_name');
            $borrower->created_at = Carbon::now();
            $borrower->updated_at = Carbon::now();
            $borrower->save();

            return redirect()->Route('borrower.show');

        } catch (QueryException $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }catch (Exception $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $borrower_id
     * @return \Illuminate\Http\Response
     */
    public function show($borrower_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $borrower_id
     * @return \Illuminate\Http\Response
     */
    public function edit($borrower_id)
    {
        // $borrower = Borrower::where('borrower_id',$borrower_id)->first();
        // return view('admin.borrower.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $borrower_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $borrower_id)
    {
         $request->validate([
            'borrower_name' => 'required'
        ]);

        try {

            Borrower::where('borrower_id',$borrower_id)->update([
                'borrower_name' => $request->input('borrower_name'),
                'updated_at' => Carbon::now()
            ]);
            return redirect()->Route('borrower.show');

        } catch (QueryException $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }catch (Exception $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $borrower_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($borrower_id)
    {
         Borrower::where('borrower_id',$borrower_id)->delete();
         return redirect()->Route('borrower.show');
    }
}
