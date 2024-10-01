<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    // return home page or project view 
    public function show(){
     return view('project.show');
    }

    // get specific project
    public function get($id){
        $project = Project::findOrFail($id);
        return view('project.get' , ['project' => $project]);
    }

    // add or store project
    public function store(Request $request){
        try {

            // Validate the request
            $validData = $request->validate([
                'title' => 'string|max:255|required',
                'description' => 'string|max:255|required',
                'deadline' => 'date|required'
            ]);

            // Add user id
            $validData['created_by'] = Auth::user()->id;

            // Create the project
            Project::create($validData);

            // Flash success message
            session()->flash('success', 'Project added successfully!');

            // Redirect to home page
            return redirect()->route('project.show');
            
        }catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Database Error: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
       
    }
}