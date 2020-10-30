<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class View extends Model
{
    //
    protected $table = 'view';
    protected $fillable = ['title','description','time','course', 'img', 'video', 'files'];

}
