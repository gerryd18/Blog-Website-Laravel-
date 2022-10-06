<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// models
use App\models\Information;
use App\models\Category;

class PageController extends Controller
{
    public function allInfo(){
        // $informations = Information::all();

        $informations = Information::where('status','Accepted')->get(); // harus di get buat ambil dari database!

        return view('Information/allInfo',compact('informations'));
    }
}
