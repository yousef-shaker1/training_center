<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment_Blog;
use Illuminate\Support\Facades\Auth;

class CommentBlog extends Component
{
    public $id, $comment, $count_comment, $comment_blogs;
    public $check = false;
    public function render()
    {
        return view('livewire.comment-blog');
    }
    
    public function mount($id){
        $this->id =$id;
        $this->refreshComments();
        if(Auth::check()){
            $this->check = true;
        }
    }

    public function rules(){
        return [
            'comment' => 'required',
        ];
        
    }
    public function refreshComments()
    {
        $this->comment_blogs = Comment_Blog::where('blog_id', $this->id)->get();
        $this->count_comment = $this->comment_blogs->count();
    }

    public function save_comment(){
        $this->validate();
        Comment_Blog::create([
            'blog_id' => $this->id,
            'user_id' => Auth::user()->id,
            'comment' => $this->comment,
        ]);
        $this->comment = '';
        $this->refreshComments();
    }
}
