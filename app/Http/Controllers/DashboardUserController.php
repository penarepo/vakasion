<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $users = DB::table('users')
            ->leftJoin('roles', 'users.id_role', '=', 'roles.id')
            ->select('users.*', 'roles.nama_role')
            ->get();

        return view('dashboard.users.index',[
            'users' => $users,
        ]);

        // return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
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
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        $request->session()->flash('success','Registration successfull!');

        return redirect('dashboard/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit',[
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $request['id_role'] = (int)$request['id_role'];
       
        $rules = [
            'name' => 'required|max:255',
            'id_role' => 'required',
        ];

        if ($request->username != $user->username) {
            $rules['username'] = 'required|min:3|max:255|unique:users';
        }

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email|unique:users';
        }

        $validatedData = $request->validate($rules);
        User::where('id', $user->id)
        ->update($validatedData);

        return redirect('dashboard/users')->with('success', 'User has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
        User::destroy($user->id);

        // $request->session()->flash('success','Registration successfull!');

        return redirect('dashboard/users')->with('success','User successfull deleted!');
    }
}
