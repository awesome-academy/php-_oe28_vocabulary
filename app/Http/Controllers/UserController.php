<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

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
        $user = Auth::user();
        
        return view('profile', compact('user'));
    }

    public function update(Request $request, $id)
    {   
        try {
            $userId = Auth::id();
            $this->userRepo->update($userId, [
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
