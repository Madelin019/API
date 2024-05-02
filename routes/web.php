<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\PhotoSearchController;

Route::get('/', function () {
    return view('welcome');
});

// Ruta, login for Google
Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});

// Ruta, services for Google / valida sesión usuarios
Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    $userExist = User::where('external_id', $user->id)->where('external_auth', 'google')->first();

   //Condicional 
    if ($userExist) {
        Auth::login($userExist); //Si ya existe el usuario registrado entonces redirige al home
    } else { 
        //De lo contrario crea el nuevo usuario, redirige a home
        $NewUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'external_id' => $user->id,
            'external_auth' => 'google', 
            'status' => 1,
        ]);

        Auth::login($NewUser);
    }

    return redirect('/home'); //Retorno a home
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    // Ruta a la que se redirige despues del inicio de sesión
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Rutas para la búsqueda de fotos
    Route::get('/home', [PhotoSearchController::class, 'create']); //Ruta que llama a la funcion create en el metodo get
    Route::post('/home', [PhotoSearchController::class, 'store']); //Ruta que llama a la funcion store en el metodo post

    
});
