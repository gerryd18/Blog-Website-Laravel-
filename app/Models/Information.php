<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $table = 'informations';

    // Field yang boleh diisi
    protected $fillable = ['cover','title','description','content','user_id','category_id'];

    // Field yang tidak boleh diisi
    // protected $hidden = ['id',''];
    // protected $guarded = ['id'];


    public function category(){
        return $this->belongsTo('App\Models\Category','category_id','id'); //menambahkan foreign key 
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
