<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    public function hobbies() {
        return $this->belongsToMany('App\Hobby');
    }

    public function filteredHobbies() {
        // Pivot is the connecting table hobby_tag. 
        return $this->belongsToMany('App\Hobby')
        ->wherePivot('tag_id', $this->id)
            ->orderBy('updated_at', 'DESC');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'name',
        'style'
    );
}
