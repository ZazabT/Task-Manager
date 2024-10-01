<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

     // The fillable attributes
     protected $fillable = [
        'title',
        'description',
        'deadline',
        'created_by'
    ];  
    

    // Relation between project and user
    public function user()
    {
        return $this->belongsTo(User::class , 'created_by');
    }


    // Relation between project and tasks 
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
