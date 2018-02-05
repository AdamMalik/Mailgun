<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Mailgun\Mailgun;
use Route;

class user extends Controller
{
    public function mypaginate($namatbl, $namacol, $limit, $offset){
        $allbox = DB::table($namatbl)->where($namacol,'=',Auth::user()->email)
                    ->offset($offset)
                    ->limit($limit)
                    ->orderBy('id','desc')
                    ->get();

        return $allbox;
    }

    public function index(){
        return Redirect::to('/mail/1');
    }

    public function all(Request $req){
        return $req->all();
    }

    public function compose(Request $req){
        if( $req->isMethod('post') ){
            $data = $req->all();
            // return $data;
            $mgClient = new Mailgun('key-30f568b1ba8dcd818cb866c7d9860541');
            $domain = "mail.ingo.io";

            // $mgClient = new Mailgun('key-046c54e5e94d3321ae8cf782c59a9a2d');
            // $domain = "sandbox250e357b99964061ad3c3e50b8877328.mailgun.org";

            # Make the call to the client.
            // return $sent;
            $result = $mgClient->sendMessage("$domain", array(
                'from'    => Auth::user()->email,
                'to'      => $data['to'],
                'subject' => $data['subject'],
                'html'    => $data['mail']
            ));

            if($result->http_response_code == 200){
                DB::table('pesan')->insert(
                    ['from_user'=>Auth::user()->email, 'to_user' => $data['to'], 'subject' => $data['subject'], 'message' => $data['mail'] ]
                );
            } else {
                return "ERROR";
            }
        }
        return view('compose');
    }

    public function getMail(Request $req, $page){
    	$allmess = DB::table('pesan')->where('to_user','=',Auth::user()->email)->get();
        $total = count($allmess);

        $per = $page > 1? ($page * 15) - 15 : 0;
        $allbox = $this->mypaginate('pesan','to_user',15,$per);

        $pages = ceil($total/15);
        $start = $per/15;
        return view('mail',['allmess'=>$allbox, 'pages'=>$pages, 'idx'=>$per, 'start'=>$start]);
    }
    
    public function getDraft(Request $req, $page){
    	$allmess = DB::table('draft')->where('from_user','=',Auth::user()->email)->get();
        $total = count($allmess);
        
        $per = $page > 1? ($page * 5) - 5 : 0;
        $allbox = $this->mypaginate('draft','from_user',5,$per);

        $pages = ceil($total/5);
        $start = $per/5;
        return view('draft',['allmess'=>$allbox, 'pages'=>$pages, 'idx'=>$per, 'start'=>$start]);
    }
    public function readMail(Request $req, $id){
        $pesan;
        if(explode('/',Route::current()->uri)[0] == 'read-mail'){
            $pesan = DB::table('pesan')
                    ->where(['id'=>$id,'to_user'=>Auth::user()->email])
                    ->get();
            if($pesan[0]->read == 0){
                DB::table('pesan')
                    ->where('id', $id)
                    ->update(['read' => 1]);
            }
        } else {
            $pesan = DB::table('pesan')
                    ->where(['id'=>$id,'from_user'=>Auth::user()->email])
                    ->get();
        }
        return view('read',['pesan'=>$pesan]);
    }
    
    public function readDraft(Request $req, $id){
        $pesan = DB::table('draft')->where(['id'=>$id,'from_user'=>Auth::user()->email])->get();
        return view('read',['pesan'=>$pesan]);
    }
    
    public function getSent(Request $req, $page){
        $allmess = DB::table('pesan')->where('from_user','=',Auth::user()->email)->get();
        // return $allmess;
        $total = count($allmess);

        $per = $page > 1? ($page * 5) - 5 : 0;
        $allsent = $this->mypaginate('pesan','from_user',5,$per);
        // return $allsent;
        $pages = ceil($total/5);
        $start = $per/5;
        return view('sent',['allmess'=>$allsent,'pages'=>$pages, 'idx'=>$per, 'start'=>$start]);
    }

    public function composeDraft(Request $req, $id){
        $pesan = DB::table('draft')->where(['id'=>$id,'from_user'=>Auth::user()->email])->get();
        return view('composeDraft',['pesan'=>$pesan]);   
    }
    
    public function postDraft(Request $req){
        $data = $req->all();
        // return $data;
        DB::table('draft')->insert(
            ['from_user'=>Auth::user()->email, 'to_user' => $data['to'], 'subject' => $data['subject'], 'message' => $data['mail'] ]
        );
        return Redirect::to('/draft/1');        
    }
}
