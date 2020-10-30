<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Comments extends Model
{
    //
    protected $table = 'comments';
    protected $fillable = ['message','users','courses'];
    
    public function user(){
        return $this->belongsTo('App\Users', 'users', 'id');
    }
    
    public function courses(){
        return $this->belongsTo('App\Courses', 'courses', 'id');
    }

}
