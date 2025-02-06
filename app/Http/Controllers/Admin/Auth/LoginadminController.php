<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use  App\Models\Post;

class LoginadminController extends Controller
{

    public function dashboard()
{
    $query = Post::with('user'); 

    if (request()->has('search')) {
        $search = request('search');
        $query->whereHas('user', function ($q) use ($search) {
            $q->where('name', 'like', "%$search%");
        });
    }

    $posts = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.dashboard', compact('posts'));
}
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(AdminLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
