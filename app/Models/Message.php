<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = 'message';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chat_id',
        'sender_chat_id',
        'message_id',
        'id',
        'user_id',
        'date',
        'forward_from',
        'forward_from_chat',
        'forward_from_message_id',
        'forward_signature',
        'forward_sender_name',
        'forward_date',
        'is_automatic_forward',
        'reply_to_chat',
        'reply_to_message',
        'via_bot',
        'edit_date',
        'has_protected_content',
        'media_group_id',
        'author_signature',
        'text',
        'entities',
        'caption_entities',
        'audio',
        'document',
        'animation',
        'game',
        'photo',
        'sticker',
        'video',
        'voice',
        'video_note',
        'caption',
        'contact',
        'location',
        'venue',
        'poll',
        'dice',
        'new_chat_members',
        'left_chat_member',
        'new_chat_title',
        'new_chat_photo',
        'delete_chat_photo',
        'group_chat_created',
        'supergroup_chat_created',
        'channel_chat_created',
        'message_auto_delete_timer_changed',
        'migrate_to_chat_id',
        'migrate_from_chat_id',
        'pinned_message',
        'invoice',
        'successful_payment',
        'connected_website',
        'passport_data',
        'proximity_alert_triggered',
        'video_chat_scheduled',
        'video_chat_started',
        'video_chat_ended',
        'video_chat_participants_invited',
        'web_app_data',
        'reply_markup'
    ];
    
}
