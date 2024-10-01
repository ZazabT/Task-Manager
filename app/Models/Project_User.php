<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_User extends Model
{
    use HasFactory;


    // fillable
    protected $fillable = [
        'project_id',
        'user_id',
        'role',
        'invited_at',
        'accepted_at',
    ];

    

    // Relation between project_user and project
    public function project()
    {
        return $this->belongsTo(Project::class , 'project_id');
    }


    // Relation between project_user and user
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }


    
}
