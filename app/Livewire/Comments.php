<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment_Blog;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id;
    public $comment;
    public function render()
    {
        $comments = Comment_Blog::where('blog_id', $this->id)->paginate(5);
        return view('livewire.comments', compact('comments'));
    }

    public function deleteComment_Blog(int $id)
    {
        $Comment_Blog = Comment_Blog::find($id);
        if($Comment_Blog){
            $this->id = $Comment_Blog->id;
            $this->comment = $Comment_Blog->comment;
        } else {
            return redirect()->back();
        }
    }

    public function destroyComment_Blog(){
        Comment_Blog::find($this->id)->delete();
        session()->flash('delete', 'comment deleted Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->comment = '';
    }


}
