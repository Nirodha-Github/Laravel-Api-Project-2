<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation rules
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required',
                'customer_id'=>'required',
            ]);
            
            // Create a new project
            $project = Project::create($validatedData);
            return response()->json(['message' => 'Project added successfully', 'data' => $validatedData]);
        } catch (ValidationException $e) {
            return response()->json($e->validator->errors(), 422); // Return validation errors
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::find($id);

        if($project){
            return response()->json(['data' => $project]);
        }
        else{
            return response()->json(['message' => 'Project not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validation rules
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required',
                'customer_id'=>'required',
            ]);

            $project = Project::find($id);

            if($project){
                $project->update($validatedData);
                return response()->json(['message' => 'Project updated successfully', 'data' => $validatedData]);
            }
            else{
                return response()->json(['message' => 'Project not found'], 404);
            }
            
            
        } catch (ValidationException $e) {
            return response()->json($e->validator->errors(), 422); // Return validation errors
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if($project){
            $project->delete();
            return response()->json(['message' => 'Project deleted successfully']);
        }
        else{
            return response()->json(['message' => 'Project not found'], 404);
        }
    }
}
