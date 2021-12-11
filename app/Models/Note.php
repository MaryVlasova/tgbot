<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes, Filterable;    

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
	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }    
    public function categoryNotes()
    {
        return $this->belongsTo(CategoryNotes::class, 'category_notes_id', 'id');
    } 
    
      
}
