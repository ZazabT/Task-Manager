<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Console\View\Components\Task;

class ProjectController extends Controller
{

    // return home page or project view 
    public function show(){
     // get all project based on the user id
     $projects = Project::where('created_by' , Auth::user()->id)->get();
     return view('project.show' , compact('projects'));
    }

    // get specific project
    public function get(Project $project){

        // load all tasks based on the project id
        $project->load('tasks');
        
        return view('project.get' , compact('project '));
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

    // display update view
    public function edit(Project $project){
        return view('project.edit' , compact('project'));
    }

    // update project
    public function update(Request $request , Project $project){
        try {

            // Validate the request
            $validData = $request->validate([
                'title' => 'string|max:255|required',
                'description' => 'string|max:255|required',
                'deadline' => 'date|required'
            ]);

            // Update the project
            $project->update($validData);

            // Flash success message
            session()->flash('success', 'Project updated successfully!');

            // Redirect to home page
            return redirect()->route('project.show');

        }catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Database Error: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    // delete project
    public function destroy(Project $project){
        $project->delete();
        session()->flash('success', 'Project deleted successfully!');
        return redirect()->route('project.show');
    }
}