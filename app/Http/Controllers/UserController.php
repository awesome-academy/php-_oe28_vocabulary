<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {   
        $user = User::findOrFail($id);
        
        return view('profile', compact('user'));
    }

    public function update(Request $request, $id)
    {   
        try {
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
            ]);
        } catch (Exception $e) {
            return back()->with('status', trans('profile.update_failed'));
        }
       
        return back()->with('status', trans('profile.update_successfully'));
    }

    public function destroy($id)
    {
        //
    }
}
