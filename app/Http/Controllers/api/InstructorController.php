<?php

namespace App\Http\Controllers\api;

use Pest\Support\Str;
use App\ApirequestTrait;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\InstructorResponce;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InstructorController extends Controller
{
    use ApirequestTrait;
    public function instructor_all(Request $request){
        $Instructors = InstructorResponce::collection(Instructor::get());
        return $this->apiResponse($Instructors, 'ok', 200);
    }

    public function show_instructor(Request $request, $id){
        try {
            $Instructor = Instructor::findOrFail($id);
    
            return $this->apiResponse(new InstructorResponce($Instructor), 'ok', 200);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'Instructors not found', 404);
        }
    }

    public function create(Request $request){
        try{
            $validator = $request->validate([
                'section_id' => 'required',
                'img' => 'required|image',
                'name' => 'required|min:2|max:50',
                'description' => 'required|min:2|max:100',
                'year_experience' => 'required',
            ]);
        } catch (ValidationException $e){
            return $this->apiResponse(null, $e->errors(), 400);
        }

        try {
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();

                $imagePath = $image->storeAs('Instructors', $imageName, 'public');
                $validator['img'] = 'Instructors/' . $imageName;
            }
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
        }

        try{
            $Instructor = Instructor::create($validator);
        } catch(\Exception $e){
            return $this->apiResponse(null, 'Instructor creation failed', 401);
        }
        return $this->apiResponse(new InstructorResponce($Instructor), 'ok', 200);
    }

    public function edit(Request $request, $id){
        try{
            $validatedData = $request->validate([
                'section_id' => 'nullable',
                'img' => 'nullable|image',
                'name' => 'nullable|min:2|max:50',
                'description' => 'nullable|min:2|max:100',
                'year_experience' => 'nullable',
            ]);
        } catch (ValidationException $e){
            return $this->apiResponse(null, $e->errors(), 400);
        }

        $Instructor = Instructor::where('id',$id)->first();

        if(!$Instructor){
            return $this->apiResponse(null, 'Instructor not found', 401);
        }
        
        if ($request->hasFile('img')) {
            try {
                // Delete old image if it exists
                if ($Instructor->img) {
                    Storage::disk('public')->delete('instructors/' . basename($Instructor->img));
                }

                // Store the new image
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('instructors', $imageName, 'public');
                $validatedData['img'] = 'instructors/' . $imageName;
            } catch (\Exception $e) {
                return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
            }
        } 
        $Instructor->update($validatedData);
        return $this->apiResponse(new InstructorResponce($Instructor), 'ok', 200);
    }

    public function delete(Request $request, $id){
        $Instructor = Instructor::where('id', $id)->first();
        if(!$Instructor){
            return $this->apiResponse(null, 'Instructor not found', 401);
        }
        if ($Instructor->img) {
            Storage::disk('public')->delete('instructors/' . basename($Instructor->img));
        }
        $Instructor->delete();
        return $this->apiResponse(null, 'delete success', 200);
    }
}
