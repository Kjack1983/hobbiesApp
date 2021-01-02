<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'name',
        'description'
    );
    
    /* [
        'name', 
        'description'
    ]; */
}
