<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryNotes extends Model
{
    use HasFactory;

    /**     
     *
     * @var string
     */    
    protected $table = 'category_notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'img',
        'color_id'
    ];


    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    
    public function color()
    {
        return $this->belongsTo(ColorOfNoteCategory::class, 'color_id', 'id');
    } 

}
