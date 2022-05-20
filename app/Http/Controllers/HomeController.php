<?php

namespace App\Http\Controllers;


use App\Models\Chat;
use App\Library\TelegramStart;
use Longman\TelegramBot\Request;

class HomeController extends Controller
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
    public function index()
    {
        $this->telegram->initialTelegram();
        
        $chats = Chat::whereNotIn('type', ['private', 'custom'])
            ->where('status','1')
            ->get()
            ->toArray();
        
        
        foreach ($chats as $key => $chat) {
            $link = Request::createChatInviteLink([
                'chat_id' => $chat['id']
            ]);
            if (!isset($link->result) || !$link->result)
                continue;

            $chats[$key]['link'] = $link->result->invite_link;
            
        }
        
        return view('home',['chats' => $chats]);
    }


    


}
