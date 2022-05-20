<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatReplicate extends Model
{

    protected $table = 'chat_replicate';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'from',
        'to'
    ];
}
