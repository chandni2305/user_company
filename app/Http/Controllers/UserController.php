<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index')->withUsers($users);
    }
    public function create()
    {
        return view('users.create');
    }
    
   
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);
        $input = $request->all();

        User::create($input);
        Session::flash('flash_message', 'User successfully added!');

        return redirect()->route('users.index');
        
    }
    
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit')->withUser($user);
    }
    
    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        $input = $request->all();

        $user->fill($input)->save();

        Session::flash('flash_message', 'User successfully added!');

        return redirect()->route('users.index');
    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        Session::flash('flash_message', 'User successfully deleted!');

        return redirect()->route('users.index');
    }
}
