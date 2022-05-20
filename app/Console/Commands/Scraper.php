<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Message;
use App\Models\ChatReplicate;
use App\Library\TelegramStart;
use App\Models\MessagesReplicate;
use Longman\TelegramBot\Request;


class Scraper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->alert('Start Script');
        $this->replicateMessages();
        $this->alert('End Script');        
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
        $telegram = new TelegramStart;
        $telegram->initialTelegram();
    
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
