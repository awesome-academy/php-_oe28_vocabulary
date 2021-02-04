<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\User\UserRepositoryInterface;

class ResetPwd
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function handle($request, Closure $next)
    {
        $userId = $request->route()->parameter('userId');
        $hashedToken = sha1($request->route()->parameter('token'));
        $user = $this->userRepo->find($userId);
        if ($user->reset_pwd_token == $hashedToken) {
            return $next($request);
        } else {
            abort(404);
        } 
    }
}
