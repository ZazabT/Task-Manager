<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'project_id',
        'assigned_to',
        'status',
    ];


    // Relation between task and project
    public function project()
    {
        return $this->belongsTo(Project::class , 'project_id');
    }

    // Relation between task and user
    public function user()
    {
        return $this->belongsTo(User::class , 'assigned_to');
    }
}
