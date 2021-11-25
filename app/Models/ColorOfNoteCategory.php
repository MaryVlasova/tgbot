<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorOfNoteCategory extends Model
{
    use HasFactory;
    /**     
     *
     * @var string
     */    
    protected $table = 'colors_of_note_category';

    /**     
     *
     * @var bool
     */  
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'code'
    ];


    public function categoriesOfNotes()
    {
        return $this->hasMany(CategoryNotes::class, 'id', 'color_id');
    }

}
