<?php

use App\Models\User;
use Nette\Utils\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/try',function(){
    return view('try', ['name' => "Test"]);
});

Route::get('/homepage',[WelcomeController::class, 'index']);

Route::get('/homepage2', function(){
    return view('welcome2');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

Route::resource('/notes', NoteController::class)->middleware(['auth']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

//many to many works -> automatically deletes user_roles
// Route::get('/delete/{id}',function($id){
//     User::where('id', $id)->firstOrFail()->delete();
// });

Route::get('/myroles', function(){
    $user = Auth::user();
    $user_roles = $user->roles;

    return view('roles')->with('user_roles',$user_roles);
})->middleware(['auth']);

