<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Requests\save_instructor;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\update_instructor;
use Illuminate\Routing\Controllers\Middleware;

class InstructorController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:instructor')->only(['index']);
        $this->middleware('permission:create_instructor')->only(['create', 'store']);
        $this->middleware('permission:edit_instructor')->only(['edit', 'update']);
        $this->middleware('permission:delete_instructor')->only(['destroy']);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Instructors = Instructor::with('section')->paginate(5);
        $sections = Section::all();
        return view('admin.instructors',compact('Instructors', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(save_instructor $request)
    {
        $validatedData = $request->validated();
        $path = $request->img->store('instructors', 'public');
        $data = [
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'year_experience' => $validatedData['year_experience'],
            'section_id' => $validatedData['section_id'],
            'img' => $path,
        ];
    
        Instructor::create($data);
    
        session()->flash('message', 'Instructor created successfully.');
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(update_instructor $request, string $id)
    {
        $Instructor = Instructor::findorfail($request->id);
        $data = $request->validated();
            if($request->hasFile('img')){
                if (!empty($Instructor->img) && Storage::disk('public')->exists($Instructor->img)) {
                    Storage::disk('public')->delete($Instructor->img);
                }
                $data['img'] = $request->file('img')->store('instructors', 'public');
            }else{
                unset($data['img']);
            }
            $Instructor->update($data);
        session()->flash('message', 'Instructor updated successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $Instructor = Instructor::findorfail($request->id);
        if(!empty($Instructor->img && Storage::disk('public')->exists($Instructor->img))){
            Storage::disk('public')->delete($Instructor->img);
        }
        $Instructor->delete();
        session()->flash('delete', 'Instructor delete successfully.');
        return redirect()->back();
    }
}
