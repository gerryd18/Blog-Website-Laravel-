<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Information;

class CategoryController extends Controller
{


    public function index(){

        // get all information data
        $categories = Category::all();

        return view('category.index',[
            'categories'=> $categories
        ]);
    }

    public function store(Request $request){

        // validasi
        $request->validate([
            'categoryTitle' => 'required|min:3|string'
        ]);

        // store to database
        Category::create([
            'title' => $request->categoryTitle
        ]);

        // redirect
        return redirect('/category')->with('success_message', ($request->categoryTitle . " successfully inserted!"));

    }

    
    public function edit($id){
        //update
        $category = Category::find($id); // select*from category where id = $id
        
        // pindah ke halaman edit.blade.php di dalam folder category (category.edit)
        return view('category.edit',[
            'category'=> $category
        ]);
    }

    // klo berhubungan sama database, pake parameter Request
    public function update(Request $request, $id){
   
          // validasi
        $request->validate([
            'categoryTitle' => 'required|min:3|string'
        ]);

        // update to database
        Category::find($id)->update([ //cari idnya lalu update
            'title' => $request->categoryTitle
        ]);

        // redirect
        return redirect('/category')->with('success_message', ($request->categoryTitle . " {{$id}} successfully updated!"));
    }

    public function destroy($id){
        // delete to database
        Category::find($id)->delete();

         // redirect
         return redirect('/category')->with('success_message', ("category {{$id}} successfully deleted!"));
    }
}
