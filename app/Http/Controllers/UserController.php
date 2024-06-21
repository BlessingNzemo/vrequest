<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //
        if(Session::has('user')){
            $users = User::all();
            return view('users.index',compact('users'));
        }
        else{
            return redirect()->route('login');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        if(Session::has('user')){
            $roles = Role::all();
            $user = User::find($id);
            $user_roles = $user->getRoleNames();
            $user_role = [];
            foreach ($user_roles as $role) {
                $user_role[] = $role;
            }
            
        
            return view('users.detail',compact('roles','user','user_role'));
        }
      
        else{
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
