<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create', [
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:64',
            'email' => 'required|email|unique:users',
            'password' => "required|string|min:3|confirmed"
        ]);

        $new_user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $new_roles = $request->input('roles');
        $new_user->syncRoles([$new_roles]);

        return redirect(route('user.index'))->with('success', 'New user added!');
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
    public function edit(User $user)
    {
        
        return view('admin.user.edit', [
            'user' => $user,
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:64|',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => "sometimes|nullable|required_with:password_confirmation|string|min:3|confirmed|"
        ]);
        
        $data = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ];

        if($validatedData['password'] != null) {
            $data['password'] = Hash::make($validatedData['password']);
        }
        
        $user->update($data);

        $new_roles = $request->input('roles');
        $user->syncRoles([$new_roles]);

        return redirect(route('user.index'))->with('success', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Region deleted!');
    }


    
    
    public function resend() {
        return view('auth.resend');
    }
    
    public function resend_email(Request $request) {
        $user = User::where("email", auth()->user()->email)->first();
        if($user){
            $user->sendEmailVerificationNotification();
            return redirect()->route('home')->with('success', 'Please check your email!');
        }
        return redirect()->route('home')->with('error', 'Couldn\'t find the email!');
    }
}
