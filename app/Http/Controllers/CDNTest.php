<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
use DB;
class CDNTest extends Controller
{
    public function index()
    {
    	$pwd = '123456';
    	$pass = password_hash($pwd, PASSWORD_BCRYPT);
    	$redis_uid_key = "str:count:userid";
    	$uid = Redis::incr($redis_uid_key);
    	$data = [
    		'uid' => $uid,
    		'name' => Str::random(10),
    		'pwd' => $pass,
    		'email' => Str::random(8).'@qq.com',
    		'reg_time' => time()
    	];
    	$table_name = 'users_'.$uid % 5;
    	$id = DB::table($table_name)->insert($data);
    	var_dump($id);die;
    	// $hash = '$2y$10$aWowjCMfXdddkVD7NCknruPoLc6mSBv3iqPnlpIK/mDXyhtRUtkrO';
    	// $result = password_verify($pwd, $hash);
    	// var_dump($result);die;
    	return view('cdn/CDNTest');
    }
}
