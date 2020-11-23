<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\SendMailJob;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id' , '<=', 100)->get();

        foreach ($users as $user) {
            $job = (new SendMailJob($user));
            dispatch($job)->onQueue('email');
        }

        return $users;
    }
}
