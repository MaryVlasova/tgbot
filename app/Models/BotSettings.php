<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotSettings extends Model
{
    use HasFactory;
    protected $table = 'bot_settings';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'info',
        'token',
        'img',
        'link'     
    ];
}
