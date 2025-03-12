<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedNotification extends Model
{
    use HasFactory;

    protected $table = 'failed_notifications';

    protected $fillable = [
        'email',
        'title',
        'message',
        'url',
        'sent'
    ];
}
