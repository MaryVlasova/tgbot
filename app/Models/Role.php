<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**     
     *
     * @var string
     */    
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
    ];    

    /**
     * The roles that belong to the permissions.
     */
    public function permissions()
    {
        return $this->belongsToMany(Role::class, 'role_permission', 'role_id', 'permission_code', 'id','code');
    }     
}
