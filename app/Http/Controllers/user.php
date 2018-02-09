<?php

namespace App\Http\Controllers;

use Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Mailgun\Mailgun;
use Illuminate\Support\Facades\Validator;
use App\model\Message;

class user extends Controller
{

    public function index(){
        return Redirect::to('/mail/1');
    }

    public function search(Request $req, $cari = null, $page = 1){
        $data = $req->all();
        $result;
        $idx=0;

        // return $cari;
        function ambilSearch($field, $role, $syarat, $page, $field2){
            $hasil = DB::table('messages')
                    ->join('users', 'users.email', '=', 'messages.'.$field2)
                    ->select('from_user','to_user','subject','role','name','read','message','messages.id')
                    ->where([$field=>Auth::user()->email, 'role'=>$role])
                    ->Where(function ($query) use($syarat) {
                         for ($i = 0; $i < count($syarat)-1; $i++){
                            $query->orwhere($syarat[$i], 'like',  '%' . $syarat[4] .'%');
                         }
                    })
                    ->orderBy('messages.id','desc')
                    ->paginate(15,['*'],'page',$page);
            return $hasil;
        }

        $per = $page > 1? ($page * 15) - 15 : 0;
        // return $cari;
        if($cari == null){
            $cari = $data['search'];
        }
        $syarat = ['name','to_user','from_user','subject',$cari];

        if(explode('/',Route::current()->uri)[0] == 'search-sent'){
            $result = ambilSearch('from_user',0,$syarat,$page,'to_user');
        } else if(explode('/',Route::current()->uri)[0] == 'search-mail'){
            $result = ambilSearch('to_user',0,$syarat,$page,'from_user');   
        } else if(explode('/',Route::current()->uri)[0] == 'search-draft'){   
            $result = ambilSearch('from_user',1,$syarat,$page,'to_user');
        }

        return view('search',['cari'=>$cari, 'allmess'=>$result, 'pages'=>$result->lastPage(), 'idx'=>$per, 'start'=>$result->currentPage()-1]);
    }

    public function compose(Request $req, $email = null){
        if( $req->isMethod('post') ){
            $data = $req->all();
            // return $data;
            $mgClient = new Mailgun(env('MAILGUN_SECRET'));
            $domain = env('MAIL_USERNAME');

            $result = $mgClient->sendMessage("$domain", array(
                'from'    => Auth::user()->email,
                'to'      => $data['to'],
                'subject' => $data['subject'],
                'html'    => $data['mail']
            ));

            if($result->http_response_code == 200){
                $pesan = new Message();
                $pesan->from_user = Auth::user()->email;
                $pesan->to_user = $data['to'];
                $pesan->subject = $data['subject'];
                $pesan->message = $data['mail'];
                $pesan->role = 0;
                $pesan->save();
                return response()->json([ 'success' => true ]);
            } else {
                return response()->json([ 'success' => false ]);
            }
        }
        return view('compose',['email'=>$email]);
    }

    public function getMail(Request $req, $page){
    	$allmess = Message::where('to_user',Auth::user()->email)
                    ->where('role',0)
                    ->orderBy('id','desc')
                    ->paginate(15,['id','to_user','from_user','subject','read'],'page',$page);
        $per = $page > 1? ($page * 15) - 15 : 0;
        return view('mail',['allmess'=>$allmess, 'pages'=>$allmess->lastPage(), 'idx'=>$per, 'start'=>$allmess->currentPage()-1]);
    }
    
    public function getDraft(Request $req, $page){
    	$allmess = Message::where('from_user',Auth::user()->email)
                    ->where('role',1)
                    ->orderBy('id','desc')
                    ->paginate(15,['id','to_user','from_user','subject'],'page',$page);
        $per = $page > 1? ($page * 15) - 15 : 0;
        return view('draft',['allmess'=>$allmess, 'pages'=>$allmess->lastPage(), 'idx'=>$per, 'start'=>$allmess->currentPage()-1]);
    }


    public function readMail(Request $req, $id){
        $pesan;
        if(explode('/',Route::current()->uri)[0] == 'read-mail'){
            $pesan = Message::where('id',$id)
                    ->where('to_user',Auth::user()->email)
                    ->where('role',0)
                    ->get();
            if($pesan[0]->read == 0){
                Message::where('id', $id)->update(['read' => 1]);
            }
        } else if(explode('/',Route::current()->uri)[0] == 'read-draft'){ 
            $pesan = Message::where('id',$id)
                    ->where('from_user',Auth::user()->email)
                    ->where('role',1)
                    ->get();
            return view('compose',['pesan'=>$pesan]);
        } else {
            $pesan = Message::where('id',$id)
                    ->where('from_user',Auth::user()->email)
                    ->where('role',0)
                    ->get();
        }
        return view('read',['pesan'=>$pesan]);
    }
    
    public function getSent(Request $req, $page){
        $allmess = Message::where('role',0)
                    ->where('from_user',Auth::user()->email)
                    ->orderBy('id','desc')
                    ->paginate(15,['to_user','from_user','subject','id'],'page',$page);

        $per = $page > 1? ($page * 15) - 15 : 0;
        return view('sent',['allmess'=>$allmess, 'pages'=>$allmess->lastPage(), 'idx'=>$per, 'start'=>$allmess->currentPage()-1]);
    }
    
    public function postDraft(Request $req){
        $data = $req->all();
        
        $pesan = new Message();
        $pesan->from_user = Auth::user()->email;
        $pesan->to_user = $data['to'] == null ? "null":$data['to'];
        $pesan->subject = $data['subject'] == null ? "null":$data['subject'];
        $pesan->message = $data['mail'] == null ? "null":$data['mail'];
        $pesan->role = 1;
        $pesan->save();    

        return Redirect::to('/draft/1');        
    }

    public function forward(Request $req, $id){
        $pesan = Message::find($id);
        if($pesan->to_user == Auth::user()->email || $pesan->from_user == Auth::user()->email){
            return view('forward',['pesan'=>$pesan]);
        } else {
            return Redirect::to('/mail/1');
        }
        return $pesan;
    }

    public function deleteMessage(Request $req, $id){
        Message::where('id', $id)->delete();
        if(explode('/',Route::current()->uri)[0] == 'delete-draft'){
            return Redirect::to('/draft/1');
        } else if(explode('/',Route::current()->uri)[0] == 'delete-sent'){
            return Redirect::to('/sent/1');
        } else {
            return Redirect::to('/mail/1');
        }
    }
}