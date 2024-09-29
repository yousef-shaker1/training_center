<?php

namespace App\Http\Controllers\api;

use App\Models\Blog;
use Pest\Support\Str;
use App\ApirequestTrait;
use App\Models\love_blog;
use App\Models\Comment_Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\love_blogResource;
use Illuminate\Validation\ValidationException;

class BlogController extends Controller
{
    use ApirequestTrait;

    public function index(){
        $blogs = BlogResource::collection(Blog::all());
        return $this->apiResponse($blogs, 'ok', 200);
    }

    public function show_blog(Request $request, $id){
        $blog = Blog::findorfail($id);
        if($blog){
            return $this->apiResponse(new BlogResource($blog),'ok', 200);
        } else {
            return $this->apiResponse(null,'blog not found', 404);
        }
    }

    public function create(Request $request){
        try{
            $validated = $request->validate([
                'img' => 'required',
                'title' => 'required|min:2|max:90',
                'body' => 'required|min:20|max:600',
            ]);
        } catch (ValidationException $e){
            return $this->apiResponse(null, $e->errors(), 400);
        }
        try{
            if($request->hasFile('img')){
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();

                $path = $image->storeAs('blogs', $imageName, 'public');
                $validated['img'] = 'blogs/' . $imageName;
                
            }
        } catch (ValidationException $e){
            return $this->apiResponse(null, $e->errors(), 400);
        }

        try{
            $blog = blog::create($validated);
        } catch(\Exception $e){
            return $this->apiResponse(null, 'blog creation failed', 401);
        }
        return $this->apiResponse(new BlogResource($blog), 'ok', 200);
    }




    public function edit(Request $request, $id){
        try{
            $validatedData = $request->validate([
                'img' => 'nullable',
                'title' => 'nullable|min:2|max:90',
                'body' => 'nullable|min:20|max:600',
            ]);
        } catch (ValidationException $e){
            return $this->apiResponse(null, $e->errors(), 400);
        }

        $blog = blog::where('id',$id)->first();

        if(!$blog){
            return $this->apiResponse(null, 'blog not found', 401);
        }

        if($request->hasFile('img')){
            try{
                if($blog->img){
                Storage::disk('public')->delete($blog->img);
                }
                $image = $request->file('img');
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('blogs', $imageName, 'public');
                $validatedData['img'] = 'blogs/' . $imageName;
            } catch (ValidationException $e){
                return $this->apiResponse(null, 'Image upload failed', 500);
            }
        }



        $blog->update($validatedData);
        return $this->apiResponse(new BlogResource($blog), 'blog updated success', 200);
    }

    public function delete(Request $request, $id){
        $blog = blog::where('id', $id)->first();
        if($blog->img){
            Storage::disk('public')->delete($blog->img);
        }
        if(!$blog){
            return $this->apiResponse(null, 'blog not found', 404);
        }
        $blog->delete();
        return $this->apiResponse(null, 'blog delete success', 200);
    }

    public function create_comment(Request $request, $id){
        $userId = Auth::id();
        $Comment_Blog = Comment_Blog::create([
            'user_id' => $userId, 
            'comment' => $request->comment, 
            'blog_id' => $id,
        ]);
        if(!$Comment_Blog){
            return $this->apiResponse(null, 'blog not found', 404);
        }
        return $this->apiResponse(new CommentResource($Comment_Blog), 'add comment blog', 200);
    }
    
    public function comment_blogs(Request $request, $id) {
        // البحث عن التعليقات المرتبطة بالمدونة
        $comments = Comment_Blog::where('blog_id', $id)->get();
        // التحقق إذا كانت المجموعة فارغة
        if ($comments->isEmpty()) {
            return $this->apiResponse(null, 'comment not found', 404);
        }
        return $this->apiResponse(CommentResource::collection($comments), 'ok', 200);
    }
    
    public function delete_comment_blog(Request $request, $id){
        $blog = Comment_Blog::where('id', $id)->first();
        
        if(!$blog){
            return $this->apiResponse(null, 'comment not found', 404);
        }
        $blog->delete();
        return $this->apiResponse(null, 'blog delete success', 200);
    }

    public function create_love(Request $request, $id){
        $userId = Auth::id();
        $love_blog = love_blog::create([
            'user_id' => $userId, 
            'blog_id' => $id, 
        ]);
        if(!$love_blog){
            return $this->apiResponse(null, 'blog not found', 404);
        }
        return $this->apiResponse(new love_blogResource($love_blog), 'add love blog', 200);
    }

    public function delete_love(Request $request, $id){
        $userId = Auth::id();
        $love_blog = love_blog::where('blog_id',$id)->where('user_id', $userId)->first();
        if(!$love_blog){
            return $this->apiResponse(null, 'blog not found', 404);
        }
        $love_blog->delete();
        
        return $this->apiResponse(null, 'delete love blog', 200);
    }
}
