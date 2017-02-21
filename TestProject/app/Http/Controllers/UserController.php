<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserDetails;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\Facades\JWTAuth;
use Response;
use Exception;
class UserController extends Controller
{
    public function showAll()
	{
		
		$users =  UserDetails::orderBy('id', 'asc')->get();
		   $res =  array();
		   $i = 0;
		   foreach($users as $user)
		   {
			   //echo($user);
			   $usersArray =  array();
			   $usersArray["user"] = $user;
			   $usersArray["social_connections"]=$user->sociallogins();
			   $res[$i] = $usersArray;
				++$i;
		   }
		   return $res;
	}
  public function index($id){
		$user =  UserDetails::find($id);
		
			$res =  array();
		   $i = 0;
		  if($user!=null)
		  {
				
			   $usersArray =  array();
			   $usersArray["user"] = $user;
			   $usersArray["social_connections"]= $user->sociallogins();
			   $res[$i] = $usersArray;
		  }	
		   
		   return $res;
	}
	
	public function normalRegistration()
	{
		$credentials = Input::only('name','email','password');
		$credentials['password'] = \Hash::make(Input::get('password'));
		try {
				$user = UserDetails::create($credentials);
				$token = JWTAuth::fromUser($user);
				return Response::json(compact('token'));
			} catch (Exception $e) {
				$res = json_encode(array('error'=>'Account with same credentials already exists,try to login'));
				//return Response::json(['error' => 'Account with same credentials already exists,try to login'], HttpResponse::HTTP_CONFLICT);
				return $res;
			}
	
		

		
	}
	
	public function socialRegistration($provider)
	{
		try
		{
			$credentials = Input::only('name','email');
			$credentials['password'] = \Hash::make(Input::get('email'));
			$user = UserDetails::create($credentials);
			$socialRecord = new SocialLogins;
			$socialRecord->user_id = $user->id;
			$socialRecord->social_id = Input::get('socialid');
			$socialRecord->provider = $provider;
			$socialRecord->save();
			$token = JWTAuth::fromUser($user);
			return Response::json(compact('token'));
		}
		catch(Exception $e)
		{
			$res = json_encode(array('error'=>'Account with same credentials already exists,try to login'));
				//return Response::json(['error' => 'Account with same credentials already exists,try to login'], HttpResponse::HTTP_CONFLICT);
				return $res;
		}
	}
	public function connectSocial($provider)
	{
		try
		{
			/*$credentials = Input::only('name','email');
			$credentials['password'] = \Hash::make(Input::get('email'));
			$user = UserDetails::create($credentials);*/
			$email = Input::get('email');
			$user =  UserDetails::find($email);
			if($user!=null)
			{
				$socialRecord = new SocialLogins;
				$socialRecord->user_id = $user->id;
				$socialRecord->social_id = Input::get('socialid');
				$socialRecord->provider = $provider;
				$socialRecord->save();
				$res = json_encode(array('msg'=>'Success'));
			}
			else
			{
				$res = json_encode(array('error'=>'Unable to find user'));
			}
		}
		catch(Exception $e)
		{
			$res = json_encode(array('error'=>'Could not connect'));
				//return Response::json(['error' => 'Account with same credentials already exists,try to login'], HttpResponse::HTTP_CONFLICT);
				return $res;
		}
	}
	
	public function normalLogin()
	{
		$credentials = Input::only('email', 'password');
	
		if ( ! $token = JWTAuth::attempt($credentials)) {
			$res = json_encode(array('error'=>'could not authenticate'));
				//return Response::json(false, HttpResponse::HTTP_UNAUTHORIZED);
				return $res;
		}

		return Response::json(compact('token'));
	}
}
