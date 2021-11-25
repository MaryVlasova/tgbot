<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;    

    /**     
     *
     * @var string
     */    
    protected $table = 'notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'text',
        'is_sent_to_telegram',
        'sent_to_telegram_at',
        'category_notes_id',
        'author_id',
        'img'

    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }    
    public function categoryNotes()
    {
        return $this->belongsTo(CategoryNotes::class, 'category_notes_id', 'id');
    }      
}
