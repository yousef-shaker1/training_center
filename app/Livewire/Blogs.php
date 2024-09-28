<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Blogs extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $title, $img,$id, $body;

    public function render()
    {
        $blogs = Blog::paginate(6);
        return view('livewire.blogs', compact('blogs'));
    }

    public function rules(){
        return [
            'img' => 'required|image',
            'title' => 'required|max:50',
            'body' => 'required|max:600|min:20',
        ];
    }
    public function updateRules(){
        return [
            'img' => 'nullable',
            'title' => 'nullable|max:50',
            'body' => 'nullable|max:600|min:20',
        ];
    }

    
    public function updated($fields){
        return $this->validateOnly($fields);
    }

    public function saveBlog(){
        $validateData = $this->validate();
        $path = $this->img->store('blogs', 'public');

        Blog::create([
            'img' => $path,
            'title' => $validateData['title'],
            'body' => $validateData['body'],
        ]);
        session()->flash('message', 'create blog success');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function editBlog(int $id){
        $blog = Blog::findorfail($id);
        if($blog){
            $this->id = $blog->id;
            $this->img = $blog->img;
            $this->title = $blog->title;
            $this->body = $blog->body;
        }
    }
    public function deleteBlog(int $id){
        $blog = Blog::findorfail($id);
        if($blog){
            $this->id = $blog->id;
            $this->title = $blog->title;
        }
    }



    public function updateBlog(){
        $validationDate = $this->validate($this->updateRules());
        $blog = Blog::findorfail($this->id);
        if ($this->img instanceof UploadedFile) {
            if(!empty($this->img) && Storage::disk('public')->exists($blog->img)){
                Storage::disk('public')->delete($blog->img);
            }
            $path = $this->img->store('blogs', 'public');
            $blog->img = $path;
        }
        $blog->title = $validationDate['title'];
        $blog->body = $validationDate['body'];
        $blog->save();
        session()->flash('message', 'blog updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function destroyBlog(){
        $blog = Blog::findorfail($this->id);
        if(!empty($this->img) && Storage::disk('public')->exists($blog->img)){
            Storage::disk('public')->delete($blog->img);
        }
        $blog->delete();
        session()->flash('delete', 'blog updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }


    public function closeModal(){
        return $this->resetInput();
    }
    
    public function resetInput(){
        $this->img = '';
        $this->title = '';
        $this->body = '';
    }

}
