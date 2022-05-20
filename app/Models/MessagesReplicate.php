<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessagesReplicate extends Model
{

    protected $table = 'messages_replicate';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'chat_replicate_id',
        'message_id'
    ];
}
