<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{

    // return home page or project view 
    public function show(){
     return view('project.show');
    }
}
