<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function Categories()
    {
        return $this->hasMany(PostCategory::class);
    }

    public function Comment()
    {
        return $this->hasMany(Comment::class);
    }


    public function storePost($request)
    {
        if($request->has('image'))$imageName = time().'.'.$request->image->extension();  


        $post = new Post();
        $post->title = $request->title;
        $post->text = $request->text;
        if($request->has('image'))$post->image = $imageName;
        if($post->save()){
            if($request->has('image'))$request->image->move(public_path('images'), $imageName);

            foreach($request->categories as $category){
                $post_category = new PostCategory();
                $post_category->post_id = $post->id;
                $post_category->category_id = $category;
                $post_category->save();
            }
        }

    }

    public function updatePost($request,$id)
    {
        if($request->has('image'))$imageName = time().'.'.$request->image->extension();  


        $post = Post::find($id);
        $post->title = $request->title;
        $post->text = $request->text;
        if($request->has('image'))$post->image = $imageName;
        if($post->save()){
            if($request->has('image'))$request->image->move(public_path('images'), $imageName);

            if(!$request->has('categories')){
                PostCategory::where('post_id',$id)->delete();
                return;
            }

            $cat_check = PostCategory::where('post_id',$id)->get('category_id')->toArray();

            if(count($cat_check)){
                foreach ($cat_check as $DB_post_genre) {
                    if(!in_array($DB_post_genre, $request->categories))PostCategory::where('post_id',$id)->where('category_id',$DB_post_genre)->first()->delete();
                }
            }

            foreach ($request->categories as $category) {
                if(!in_array($category, $cat_check)){
                $post_category = new PostCategory();
                $post_category->post_id = $id;
                $post_category->category_id = $category;
                $post_category->save();
                }
            }
        }

    }
}
