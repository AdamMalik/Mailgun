<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class admin extends Controller
{
    public function User(Request $req, $page){
        
        $value = $req->session()->get('error','null');
        $error = $value;
        // $alluser = DB::table('users')->get();
        
        $all = DB::table('users')->get();
        $total = count($all);

        $per = $page > 1? ($page * 5) - 5 : 0;
        $alluser = DB::table('users')
                    ->offset($per)
                    ->limit(5)
                    ->get();
        $pages = ceil($total/5);
        // return $pages;
        // return $alluser;
        $admin = $req->session()->get('admin','null');
        $start = $per/5;
        // return $start/5;
    	return view('user',['error'=>$error, 'alluser'=>$alluser,'idx'=>$per, 'admin'=>$admin, 'start'=>$start, 'pages'=>$pages]);
    }
    public function deleteUser(Request $req, $id){    
    	DB::table('users')->where('id', '=', $id)->delete();
        return Redirect::to('/user/1');
    }
    public function editUser(Request $req){
        $data = $req->all();
        // return $data;
        DB::table('users')
            ->where('email', $data['mail'])
            ->update(['name' => $data['name'], 'password'=>bcrypt($data['password'])]);
        return Redirect::to('/user/1');
    }
    
    public function add(Request $req){
        $data = $req->all(); 
        
        $cek = DB::table('users')->where('email','=',$data['email'])->get();

        if(count($cek)>0){
            $req->session()->flash('error', 'true');
        } else {
        	DB::table('users')->insert(
    		    ['name'=>$data['name'], 'email' => $data['email'], 'password' => bcrypt($data['password']) ]
    		);
            $req->session()->flash('error', 'false');
        }
    	return Redirect::to('/user/1');
    }
}
