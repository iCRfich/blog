<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    public function Post()
    {
        return $this->belongsTo(Post::class);
    }

    public function Category()
    {
        return $this->hasOne(Category::class, 'id','category_id');
    }

    public function updatePostCategories($categories, $id)
    {
        $post_categories = PostCategory::where('post_id',$id)->get();
        
        foreach($post_categories as $old_cat){
            if( !in_array( $old_cat->category_id, $categories ) )
                $old_cat->delete();
        }

        foreach($categories as $new_cat){
            if( !in_array( $new_cat->category_id, $categories ) ){
                PostCategory::create([
                    'game_id' => $id,
                    'category_id' => $new_cat
                ]);
            }
        }
    }
}
