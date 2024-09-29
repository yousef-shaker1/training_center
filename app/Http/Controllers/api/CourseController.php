<?php

namespace App\Http\Controllers\api;

use App\Models\Course;
use App\ApirequestTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResponce;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CourseController extends Controller
{
    use ApirequestTrait;
    public function course_all(Request $request){
        $courses = CourseResponce::collection(Course::get());
        return $this->apiResponse($courses, 'ok', 200);
    }

    public function show_course(Request $request, $id){
        try {
            $Course = Course::findOrFail($id);
    
            return $this->apiResponse(new CourseResponce($Course), 'ok', 200);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'Course not found', 404);
        }
    }

    public function create(Request $request){
        try{
            $validator = $request->validate([
                'section_id' => 'required',
                'img' => 'required|image',
                'name' => 'required|min:2|max:50',
                'description' => 'required|min:2|max:100',
                'price' => 'required',
                'Numberofhours' => 'required',
                'Quantity' => 'required',
                'type' => 'required',
                'start_data' => 'required',
                'end_data' => 'required',
            ]);
        } catch (ValidationException $e){
            return $this->apiResponse(null, $e->errors(), 400);
        }

        try {
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();

                $imagePath = $image->storeAs('courses', $imageName, 'public');
                $validator['img'] = 'courses/' . $imageName;
            }
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
        }

        try{
            $Course = Course::create($validator);
        } catch(\Exception $e){
            return $this->apiResponse(null, 'Course creation failed', 401);
        }
        return $this->apiResponse(new CourseResponce($Course), 'ok', 200);
    }

    public function edit(Request $request, $id){
        try{
            $validatedData = $request->validate([
                'section_id' => 'nullable',
                'img' => 'nullable|image',
                'name' => 'nullable|min:2|max:50',
                'description' => 'nullable|min:2|max:100',
                'price' => 'nullable',
                'Numberofhours' => 'nullable',
                'Quantity' => 'nullable',
                'type' => 'nullable',
                'start_data' => 'nullable',
                'end_data' => 'nullable',
            ]);
        } catch (ValidationException $e){
            return $this->apiResponse(null, $e->errors(), 400);
        }

        $Course = Course::where('id',$id)->first();

        if(!$Course){
            return $this->apiResponse(null, 'Course not found', 401);
        }
        
        if ($request->hasFile('img')) {
            try {
                // Delete old image if it exists
                if ($Course->img) {
                    Storage::disk('public')->delete('courses/' . basename($Course->img));
                }

                // Store the new image
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('courses', $imageName, 'public');
                $validatedData['img'] = 'courses/' . $imageName;
            } catch (\Exception $e) {
                return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
            }
        } 
        $Course->update($validatedData);
        return $this->apiResponse(new CourseResponce($Course), 'ok', 200);
    }

    public function delete(Request $request, $id){
        $Course = Course::where('id', $id)->first();
        if(!$Course){
            return $this->apiResponse(null, 'Course not found', 401);
        }
        if ($Course->img) {
            Storage::disk('public')->delete('courses/' . basename($Course->img));
        }
        $Course->delete();
        return $this->apiResponse(null, 'delete success', 200);
    }
}
