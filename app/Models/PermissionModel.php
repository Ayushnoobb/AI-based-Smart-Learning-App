<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    /**
     * The users that belong to the permission.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permission','permission_id','user_id');
    }
}
