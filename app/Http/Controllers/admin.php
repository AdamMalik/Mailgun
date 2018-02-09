<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use app\User;


class admin extends Controller
{
    public function User(Request $req, $page){
        $alluser = User::orderBy('id','asc')
                    ->paginate(15,['id','name','email'],'page',$page);
        $per = $page > 1? ($page * 15) - 15 : 0;

    	return view('user',['alluser'=>$alluser,'idx'=>$per, 'start'=>$alluser->currentPage()-1, 'pages'=>$alluser->lastPage()]);
    }
    public function deleteUser(Request $req, $id){    
        User::where('id', $id)->delete();
        return response()->json([ 'success' => true ]);
    }
    public function editUser(Request $req){
        $v = $req->validate([
            'name' => 'required|string',
            'mail' => 'required|string|email',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        $data = $req->all();

        
        $user = User::where('email', $data['mail'])->get();

        if(Hash::check($data['password'], $user[0]->password)){
            return response()->json([ 'success' => false ]);
        } else {
            User::where('email', $data['mail'])
                ->update(['password'=>bcrypt($data['password'])]);
            
            return response()->json([ 'success' => true ]);
        }

    }
    
    public function add(Request $req){
        // return $req;
        $v = $req->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $data = $req->all(); 
        $cek = User::where('email', $data['email'])->get();
        // return $cek;
        if(count($cek)>0){
            return response()->json([ 'success' => false ]);
        } else {
            $user = new User();
            $user->name  = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            return response()->json([ 'success' => true, 'total'=>count(User::all()), 'id'=>$user->id ]);
        }
    }
}
