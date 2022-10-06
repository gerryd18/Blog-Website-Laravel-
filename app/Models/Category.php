<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    // Field yang boleh diisi
    protected $fillable = ['title'];

    public function information(){
        return $this->hasMany('App\Models\Information'); // foreign key
        // 1kategori punya banyak informations/blog
    }
}
