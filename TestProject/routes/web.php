<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response as HttpResponse;
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
    return view('index');
});
Route::get('/login',function(){
	return view('login');
});
Route::get('/fblogin',function(){
	return view('fblogin');
});
Route::get('/profile',function(){
	return view('profile');
});
Route::get('/api/v1/employees/{id?}', 'Employees@index');
Route::post('/api/v1/employees', 'Employees@store');
Route::post('/api/v1/employees/{id}', 'Employees@update');
Route::delete('/api/v1/employees/{id}', 'Employees@destroy');
Route::get('/api/v1/categories/{id?}', 'Categories@index');
Route::get('/api/v1/products/{search?}', 'Products@index');
Route::get('/api/v1/users', 'UserController@showAll');
Route::get('/api/v1/user/{id}', 'UserController@index');
Route::post('/signup', /*function () {
   $credentials = Input::only('name','email','password');
	$credentials['password'] = Hash::make(Input::get('password'));
   try {
       $user = App\UserDetails::create($credentials);
	   
   } catch (Exception $e) {
       return Response::json(['error' => $e], HttpResponse::HTTP_CONFLICT);
   }

   $token = JWTAuth::fromUser($user);

   return Response::json(compact('token'));
}*/'UserController@normalRegistration');
Route::post('/signin', /*function () {
   $credentials = Input::only('email', 'password');
	
   if ( ! $token = JWTAuth::attempt($credentials)) {
       return Response::json(false, HttpResponse::HTTP_UNAUTHORIZED);
   }

   return Response::json(compact('token'));
}*/'UserController@normalLogin');
Auth::routes();

Route::get('/home', 'HomeController@index');
