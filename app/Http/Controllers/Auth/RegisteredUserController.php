<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    public function store(Request $request): RedirectResponse
    {

        // $request->validate([
        //     'nombre' => 'required|string|max:255',
        //     'apellidos' => 'required|string|max:255',
        //     'telefono' => 'required|max:11',
        //     'email' => 'required|string|email|max:255|unique:'.User::class,
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        $request->validate([
            'nombre' => 'required|string|max:40|regex:/[A-Za-z]+$/',
            'apellidos' => 'required|string|max:255|regex:/[A-Za-z]+$/',
            'dni' => 'required|min:9|max:9|regex:/^[0-9]{8}[A-Za-z]$/',
            'telefono' => 'required|max:9|min:9',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $user = User::create([
            'tipo' => $request->tipo,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'dni' => $request->dni,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
