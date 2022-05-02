<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\UserChat;
use Longman\TelegramBot\Request;
use App\Library\TelegramStart;
use Illuminate\Http\Request as Req;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $telegram;

    public function __construct()
    {
        $this->middleware('auth');
        $this->telegram = new TelegramStart;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id)
    {
        
        $status = false;
        Chat::where('id',$id)->update(['status' => '0']);

        $status = true;
        $message = 'Grupo Desativado';
        
        return ['status' => $status, 'message' => $message];
    }

    public function showMembersChat($id){
        
        $this->telegram->initialTelegram();

        $members = User::select('id','first_name','last_name','username','ban')
            ->join('user_chat','user_id','id')
            ->where('chat_id',$id)
            ->get();

        foreach ($members as $key =>  $member) {

            $user_info = Request::getChatMember([
                'chat_id' => $id,
                'user_id' => $member->id
            ]);
           
            if(($user_info->result->status == 'creator') || ($user_info->result->status == 'administrator')){
                User::where('id',$member->id)
                    ->update(['is_admin' => '1']);
                $members[$key]['is_admin'] = '1';
            }
        }

        return $members;
    }

    public function banMember($chat_id, $user_id){
        
        $this->telegram->initialTelegram();

        var_dump(Request::banChatSenderChat([
            'chat_id' => $chat_id,
            'sender_chat_id' => $user_id
        ]));

        UserChat::where('chat_id',$chat_id)
            ->where('user_id',$user_id)
            ->update(['ban' => '0']);
        
    }

    public function unbanMember($chat_id, $user_id){

        $this->telegram->initialTelegram();

        Request::unbanChatSenderChat([
            'chat_id' => $chat_id,
            'sender_chat_id' => $user_id
        ]);

        UserChat::where('chat_id',$chat_id)
            ->where('user_id',$user_id)
            ->update(['ban' => '1']);
    }

    public function sendMessage(Req $request){

        $this->telegram->initialTelegram();

        Request::sendMessage([
            'chat_id' => $request->chat_id,
            'text'    => $request->message,
        ]);
        
        return redirect('/home');
    }


    
}
