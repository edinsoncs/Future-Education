<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Courses extends Model
{
    //
    protected $table = 'courses';
    protected $fillable = ['title','description','price','category'];

}
