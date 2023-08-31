<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AccountSettingController extends Controller
{
    public function settingPage()
    {
        $account_profile = Admin::where('admin_id',session('admin_id'))->first();
        return view('client.settings',compact('account_profile'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'username' => 'required'
        ]);

        try {
            Admin::where('admin_id',session('admin_id'))->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'username' => $request->input('username'),
            ]);

            return  redirect()->back()->with('message','Your Profile info has been updated successfully..');
        } catch (QueryException $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }catch (Exception $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ]);

        try {

           $is_exists =  Admin::where('admin_id',session('admin_id'))->first();

           if ($is_exists) {

                if (Hash::check($request->current_password, $is_exists->password)) {
                        $is_exists->update([
                            'password' => bcrypt($request->input('new_password'))
                        ]);
                        return  redirect()->back()->with('message','Your Password Has successfully been updated..');
                } else {
                     return back()->withError('Current Password Does not match')->withInput();
                }
            }

            return redirect()->Route('account.setting.view');
        } catch (QueryException $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }catch (Exception $ex) {
            return back()->withError($ex->getMessage())->withInput();
        }
    }

    public function updateImage(Request $request)
    {

        try {

             $admin = Admin::where('admin_id', session('admin_id'))->first();
            if (File::exists($admin->image)) {
                File::delete($admin->image);
            }
            $image = $request->file('image');
            if (isset($image)) {
                $image_name = $image->getClientOriginalName();
                $image_name = str_replace(" ", "_", time().$image_name);
                $image_path = 'upload/AdminImages/';
               $image->move($image_path, $image_name);

            }
            else{
                return back()->withError('Please select image');
            }

            $admin->image = $image_path.$image_name;
            if ($admin->save()) {
                session([
                    'image' => $image_path.$image_name
                ]);
                return redirect()->route('account.setting.view');
            } else {
                return back()->withError('something went wrong');
            }


        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withinput();
        }
    }
}
