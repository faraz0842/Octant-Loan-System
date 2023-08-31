<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CreditUnion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credit_union = CreditUnion::orderBy('credit_union')->get();
        $user = Admin::all();
        return view('admin.user.show', compact('user','credit_union'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        try {
            $image = $request->file('image');
            if (isset($image)) {
                $image_name = $image->getClientOriginalName();
                $image_name = str_replace(" ", "_", time() . $image_name);
                $image_path = 'upload/UserImages/';
                $image->move($image_path, $image_name);
            } else {
                $image_name = null;
                $image_path = null;
            }

            $user = new Admin();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->credit_union = $request->credit_union;
            $user->image = $image_path.$image_name;
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->Route('user.show');
        } catch (Exception $th) {
            return back()->withError($th->getMessage());
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
    public function update(Request $request, $admin_id)
    {

        //return response()->json($request->credit_union);
        $request->validate([
            'first_name' => 'required',
            'email' => 'required',
        ]);

        try {
            Admin::where('admin_id', $admin_id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'role' => $request->role,
                'credit_union' => $request->credit_union
            ]);
            return redirect()->Route('user.show');
        } catch (Exception $th) {
            return back()->withError($th->getMessage());
        }
    }


    public function updateImage(Request $request, $admin_id)
    {
        $userimage = Admin::where('admin_id',$admin_id)->first();

        if (File::exists($userimage->image_path . $userimage->image_name)) {

            File::delete($userimage->image_path . $userimage->image_name);
        }

        $image = $request->file('image');
            if (isset($image)) {
                $image_name = $image->getClientOriginalName();
                $image_name = str_replace(" ", "_", time() . $image_name);
                $image_path = 'upload/UserImages/';
                $image->move($image_path, $image_name);
            } else {
                return back()->withError('Please select image');
            }

        $userimage->image = $image_path.$image_name;
        $userimage->save();

        return redirect()->Route('user.show');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($admin_id)
    {
        Admin::where('admin_id', $admin_id)->delete();
        return redirect()->route('user.show');
    }
}
