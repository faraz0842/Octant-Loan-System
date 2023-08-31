<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Borrower;
use App\Models\CreditUnion;
use App\Models\Loan;
use App\Models\LoanType;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    /**
     * Display the specified login view.
     *
     * @return Factory|View
     */

    public function loginView()
    {
        return view('admin.login');
    }


    /**
     *
     * Login Function for superadmin
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */

    public function login(Request $request)
    {
        $this->validate($request,[
                'email' => 'required',
                'password' => 'required',
            ]);

            try {

                $is_exists = Admin::where('email',$request->email)->first();
                if($is_exists->role == 'admin' || $is_exists->role == 'employee' ){

                    if($is_exists){

                        if (Hash::check($request->password, $is_exists->password)) {
                            session([
                                'admin_id' => $is_exists->admin_id,
                                'image' => $is_exists->image,
                                'name' => $is_exists->name,
                                'role' => $is_exists->role,
                            ]);
                            $random_code = Str::random(6);

                            $is_exists->verification_code = $random_code;
                            $is_exists->save();

                            $name = $is_exists->name;
                            $email = $is_exists->email;

                            $data = array(
                                'name' => $name,
                                'code' => $random_code,
                            );

                            Mail::send('email.2fa', $data, function ($message) use ($request, $email) {
                                $message->to($email)->subject('Two Step Verification Code');
                                $message->from('support@pipeline.octant.us', 'Octant Web Services');
                            });

                            return redirect()->Route('admin.check.2step', $is_exists->admin_id);


                            //return redirect()->Route('dashboard');
                        } else {
                            return back()->withError('Oops ! you have entered invalid password..')->withInput();
                        }

                    }else{
                        return back()->withError('Oops ! you have entered invalid email..')->withInput();
                    }

                }elseif ($is_exists->role == 'client') {
                   if($is_exists){

                        if (Hash::check($request->password, $is_exists->password)) {
                            session([
                                'admin_id' => $is_exists->admin_id,
                                'image' => $is_exists->image,
                                'name' => $is_exists->name,
                                'credit_union' => $is_exists->credit_union,
                                'role' => 'client',
                            ]);
                            $random_code = Str::random(6);

                            $is_exists->verification_code = $random_code;
                            $is_exists->save();

                            $name = $is_exists->name;
                            $email = $is_exists->email;

                            $data = array(
                                'name' => $name,
                                'code' => $random_code,
                            );

                            Mail::send('email.2fa', $data, function ($message) use ($request, $email) {
                                $message->to($email)->subject('Two Step Verification Code');
                                $message->from('support@pipeline.octant.us', 'Octant Web Services');
                            });

                            return redirect()->Route('admin.check.2step', [$is_exists->admin_id, $is_exists->email]);

                            //return redirect()->Route('client.loans');
                        } else {
                            return back()->withError('Oops ! you have entered invalid password..')->withInput();
                        }

                    }else{
                        return back()->withError('Oops ! you have entered invalid email..')->withInput();
                    }
                }else{
                    return back()->withError('You are not registered as an admin so please contact support team')->withInput();
                }


            } catch (QueryException $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }catch (Exception $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }



    }

    public function twoStepVerification($admin_id)
    {
        return view('auth.two_step')->with('admin_id',$admin_id)->with('error','');
    }

    public function checkOTP(Request $request , $admin_id )
    {


        $check_code = Admin::where("verification_code", $request->code)->first();

        if($check_code){

            $is_check= Admin::where("admin_id", $admin_id)->where("verification_code", $request->code)->first();
             if($is_check){
                 $this->storeSession($is_check);
                 $is_check->verification_code = null;
                 $is_check->save();
                if($is_check->role == 'admin'){
                    return redirect()->Route('dashboard');

                }elseif($is_check->role == 'client'){
                    return redirect()->Route('client.loans');

                }


             } else{
                return back()->withError('code does not matched');
             }

        }else{
            return back()->withError('code does not matched');
        }

    }

    public function storeSession(Admin $admin)
    {
        session([
            'admin_id' => $admin->admin_id,
            'image' => $admin->image,
            'name' => $admin->name,
            'credit_union' => $admin->credit_union,
            'role' => $admin->role,
        ]);

    }

    /**
     *
     * Logout Function for admin
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->Route('login.view');
    }


    /**
     * Display the specified dashboard view.
     *
     * @return Factory|View
     */
    public function dashboard(Request $request)
    {
        $borrower = Borrower::all();
        $loan_type = LoanType::all();
        $credit_union = CreditUnion::orderBy('credit_union')->get();;
        $total_loans = Loan::where('status','active')->where('date',null)->orWhere('date','>',Carbon::now())->count();
        $total_amount_of_loans = Loan::where('status','active')->where('date',null)->orWhere('date','>',Carbon::now())->sum('loan_amount');
        $pending_amount = Loan::where('status','pending')->sum('loan_amount');
        $approved_loans = Loan::where('status','active')->where('cu_decision', 'Approved')->where('serviced_loan',1)->whereNull('date')->count();
        $total_amount_of_approved_loans = Loan::where('status', 'active')->where('cu_decision', 'Approved')->where('serviced_loan', 1)->whereNull('date')->sum('loan_amount');
        $pending_loans = Loan::where('status','pending')->count();
        $archived_loans = Loan::where('status','archived')->count();
        $employee = Admin::where('role','employee')->get();


        $loan = Loan::query()
        ->leftJoin('loan_types','loan_types.loan_type_id','loan.loan_type_id')
        ->leftJoin('borrower','borrower.borrower_id','loan.borrower_id')
        ->leftJoin('credit_union','credit_union.credit_union_id','loan.credit_union_id')
        ->select('loan.*','credit_union.*','loan_types.*','borrower.*')
        ->where('status','!=','archived');

        if(isset($request->serach_credit_union)){
            $loan = $loan->where('loan.credit_union_id',$request->serach_credit_union );
        }

        $loan = $loan->get();

        return view('admin.dashboard',compact('loan','total_loans','total_amount_of_loans','pending_loans','pending_amount',
                                                'approved_loans','total_amount_of_approved_loans','archived_loans','borrower','loan_type','credit_union','employee'));
    }

    public function updateLoanInDashboard(Request $request, $loan_id)
    {


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

            if ($request->settlement_fees_approved == 'on') {
                $settlement_fees_approved = 1;
            } else {
                $settlement_fees_approved = 0;
            }

            if ($request->loan_qcd == 'on') {
                $loan_qcd = 1;
            } else {
                $loan_qcd = 0;
            }

            if ($request->credit_qcd == 'on') {
                $credit_qcd = 1;
            } else {
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
            'updated_at' => Carbon::now(),

            ]);

            return redirect()->Route('dashboard');

        } catch (QueryException $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }catch (Exception $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }
    }

    public function test()
    {
        return bcrypt('admin123');
    }
}
