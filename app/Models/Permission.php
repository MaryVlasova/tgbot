<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    /**     
     *
     * @var string
     */    
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code',
    ];    

    /**
     * The roles that belong to the permissions.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_code', 'role_id','code', 'id');
    }    
}
