<?php

namespace App\Http\Controllers\api;

use Pest\Support\Str;
use App\Models\Section;
use App\ApirequestTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResponce;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SectionController extends Controller
{
    use ApirequestTrait;
    public function section_all(Request $request){
        $sections = SectionResponce::collection(Section::get());
        return $this->apiResponse($sections, 'ok', 200);
    }

    public function show_section(Request $request, $id){
        try {
            $section = Section::findOrFail($id);
    
            return $this->apiResponse(new SectionResponce($section), 'ok', 200);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'Section not found', 404);
        }
    }

    public function create(Request $request){
        try{
            $validator = $request->validate([
                'name' => 'required|min:2|max:50',
                'img' => 'required|image',
            ]);
        } catch (ValidationException $e){
            return $this->apiResponse(null, $e->errors(), 400);
        }

        try {
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();

                $imagePath = $image->storeAs('section', $imageName, 'public');
                $validator['img'] = 'section/' . $imageName;
            }
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
        }

        try{
            $section = Section::create($validator);
        } catch(\Exception $e){
            return $this->apiResponse(null, 'section creation failed', 401);
        }
        return $this->apiResponse(new SectionResponce($section), 'ok', 200);
    }

    public function edit(Request $request, $id){
        try{
            $validatedData = $request->validate([
                'name' => 'nullable|min:2|max:50',
                'img' => 'nullable',
            ]);
        } catch (ValidationException $e){
            return $this->apiResponse(null, $e->errors(), 400);
        }

        $section = Section::where('id',$id)->first();

        if(!$section){
            return $this->apiResponse(null, 'section not found', 401);
        }
        
        if ($request->hasFile('img')) {
            try {
                // Delete old image if it exists
                if ($section->img) {
                    Storage::disk('public')->delete('section/' . basename($section->img));
                }

                // Store the new image
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('section', $imageName, 'public');
                $validatedData['img'] = 'section/' . $imageName;
            } catch (\Exception $e) {
                return $this->apiResponse(null, 'Image upload failed: ' . $e->getMessage(), 500);
            }
        } 
        $section->update($validatedData);
        return $this->apiResponse(new SectionResponce($section), 'ok', 200);
    }

    public function delete(Request $request, $id){
        $section = Section::where('id', $id)->first();
        if(!$section){
            return $this->apiResponse(null, 'section not found', 401);
        }
        if ($section->img) {
            Storage::disk('public')->delete('section/' . basename($section->img));
        }
        $section->delete();
        return $this->apiResponse(null, 'delete success', 200);
    }
}
