<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

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
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $new_user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
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
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if($validated['password'] != null) {
            $data['password'] = Hash::make($validated['password']);
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
