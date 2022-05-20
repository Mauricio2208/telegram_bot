<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Message;
use App\Models\UserChat;
use App\Models\ChatReplicate;
use App\Models\MessagesReplicate;
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

    public function getChats(Req $request) {
        $groups = Chat::where(function($query) use ($request) {
            $query->where('title', 'like', '%'.$request->get('query').'%')
                ->orWhere('username', 'like', '%'.$request->get('query').'%')
                ->orWhere('first_name', 'like', '%'.$request->get('query').'%')
                ->orWhere('last_name', 'like', '%'.$request->get('query').'%');
        })->where('id', '<>', $request->get('chatId'))
        ->limit(10)->get();

        foreach ($groups as $key => $group) {
            if (!$group->title) {
                $groups[$key]->title = $group->first_name . ' ' . $group->last_name;
            }
        }

        return $groups->toArray();
    }

    public function getChatReplicate($chatId) {
        $groups = ChatReplicate::select('chat.*')
            ->where('chat_replicate.to', $chatId)
            ->join('chat', 'chat.id', 'chat_replicate.from')
            ->get();

        foreach ($groups as $key => $group) {
            if (!$group->title) {
                $groups[$key]->title = $group->first_name . ' ' . $group->last_name;
            }
        }

        return $groups->toArray();
    }

    public function replicate(Req $request) {
        ChatReplicate::where('to', $request->chat_id)->delete();

        foreach ($request->chats_id as $id) {
            ChatReplicate::create([
                'to' => $request->chat_id,
                'from' => $id
            ]);
        }
    }

    public function replicateMessages() {
        $chatsToReplicate = ChatReplicate::get();

        foreach ($chatsToReplicate as $chatReplicate) {
            $messages = Message::where('chat_id', $chatReplicate->from)
                ->whereNotExists(function($query) use ($chatReplicate)
                {
                    $query->select(\DB::raw(1))
                        ->from('messages_replicate')
                        ->where('chat_replicate_id', $chatReplicate->id)
                        ->whereRaw('message.id = messages_replicate.message_id');
                })->get();

            foreach ($messages as $message) {
                $this->sendMessageToChat((integer)$chatReplicate->to, (integer)$message->id);
                MessagesReplicate::create([
                    'chat_replicate_id' => $chatReplicate->id,
                    'message_id' => $message->id
                ]);
            }
        }
    }

    public function sendMessageToChat(int $chatId, int $messageId) {
        $this->telegram->initialTelegram();

        $message = Message::select('message.text', 'user.first_name', 'user.last_name')
            ->where('message.id',$messageId)
            ->join('user', 'user.id', 'message.user_id')
            ->first();

        if(!$message) return false;

        $text = $message->first_name . ' ' . $message->last_name . ': ' . $message->text; 

        Request::sendMessage([
            'chat_id' => $chatId,
            'text'    => $text,
        ]);
    }
}
