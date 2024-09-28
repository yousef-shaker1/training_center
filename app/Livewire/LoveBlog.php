<?php

namespace App\Livewire;

use App\Models\blog;
use App\Models\love_blog;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoveBlog extends Component
{
    public $blogId;

    public function mount($blogId)
    {
        $this->blogId = $blogId;
    }

    public function addLove($blogId)
    {
        if (Auth::check() && $blogId) {
            love_blog::create([
                'user_id' => Auth::user()->id,
                'blog_id' => $blogId,
            ]);
        }
    }

    public function delLove($blogId)
    {
        if (Auth::check() && $blogId) {
            love_blog::where('user_id', Auth::user()->id)
                ->where('blog_id', $blogId)
                ->delete();
        }
    }

    public function render()
    {
        $blogs = Blog::find($this->blogId);
        $count_love = love_blog::where('blog_id', $this->blogId)->count();
        $love_blogs = love_blog::where('user_id', Auth::user()->id)
            ->pluck('blog_id')
            ->toArray();

        return view('livewire.love-blog', [
            'blogs' => $blogs,
            'love_blogs' => $love_blogs,
            'count_love' => $count_love,
        ]);
    }
}