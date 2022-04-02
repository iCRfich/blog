<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use File;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'title',
        'image',
        'about',
        'twitter',
        'facebook',
        'instagram',
        'email',
        'skype',
        'youtube'
    ];

    public function orUpdateOrCreate($request)
    {
        $oldPhoto = About::where('user_id', Auth::id())->first()->image;

        if($request->has('image')){
            $imageName = time().'.'.$request->image->extension();  
        }
        else{
            $imageName = $oldPhoto;
        }

        if( About::updateOrCreate([
        'user_id' => Auth::id()
        ],
        [
            'name' => $request->name,
            'surname' => $request->surname,
            'title' => $request->title,
            'image' => $imageName,
            'about' => $request->about,
            'twitter' => $request->twitter,
            'skype' => $request->skype,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'email' => $request->email,
            'youtube' => $request->youtube
        ])){
           if($oldPhoto !== $imageName){
                if(file_exists(public_path('images/'.$oldPhoto))){
                    unlink(public_path('images/'.$oldPhoto));
                }
                $request->image->move(public_path('images'), $imageName);
           }
        }
    }
}
