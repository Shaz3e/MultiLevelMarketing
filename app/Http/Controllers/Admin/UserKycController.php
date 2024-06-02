<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserKycController extends Controller
{
    public function index()
    {
        // Check Authorize
        Gate::authorize('viewAny', User::class);

        return view('admin.user-kyc.index');
    }
}
