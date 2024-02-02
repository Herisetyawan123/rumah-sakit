<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\PasienLoginRequest;
use App\Models\Kasir;

class AuthenticatedSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['destroy', 'destroyPasien']]);
    }

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('cms.pages.login');
    }

    /**
     * Display the login view.
     */
    public function createPasien()
    {
        return redirect()->route('pasien.home.index');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $admin = Kasir::where('email',$request->email)->first();
        if ($admin) {
            $request->authenticate('cms');
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        $request->authenticate('dokter');

        $request->session()->regenerate();
        return redirect()->intended('dokter/dashboard');

    }

    /**
     * Handle an incoming authentication request.
     */
    public function storePasien(PasienLoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended('pasien/beranda');

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if(Auth::guard('cms')->check()){
            Auth::guard('cms')->logout();
        }else{
            Auth::guard('dokter')->logout();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // dd('dimari');
        return redirect('admin/login');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroyPasien(Request $request): RedirectResponse
    {

        dd($request);
        Auth::guard('pasien')->logout();

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();

        $request->session()->flush();

        return redirect(route('pasien.home.index'));
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function storeUser(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(RouteServiceProvider::HOME);
    // }
}
