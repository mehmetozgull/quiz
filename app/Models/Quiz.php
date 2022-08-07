<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Quiz extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'description', 'finished_at', 'slug', 'status'];

    protected $dates = ['finished_at'];

    protected $appends = ['details', 'my_rank'];

    public function questions(){
        return $this->hasMany('App\Models\Question');
    }

    public function my_result(){
        return $this->hasOne('App\Models\Result')->where('user_id', auth()->user()->id);
    }

    public function results(){
        return $this->hasMany('App\Models\Result');
    }

    public function topTen(){
        return $this->results()->orderByDesc('point')->take(10);
    }

    public function getDetailsAttribute(){

        if($this->results()->count() > 0){
            return [
                'average' => round($this->results()->avg('point')),
                'join_count' => $this->results()->count(),
            ];
        }

        return null;
    }

    public function getMyRankAttribute(){
        $rank = 1;
        foreach($this->results()->orderByDesc('point')->get() as $result){
            if(auth()->user()->id == $result->user_id){
                return $rank;
            }
            $rank++;
        }
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'onUpdate' => true,
                'source' => 'title'
            ]
        ];
    }

}
