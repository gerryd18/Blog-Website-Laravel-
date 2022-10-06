<?php

namespace App\Http\Controllers;

// models
use App\models\Information;
use App\models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Str;  // hrs import ini untuk random dan conversion #line30
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    public function index(){
        $categories = Category::all();

        if(Auth::user()->role == 'Admin'){
            $informations = Information::all();

        }else if(Auth::user()->role == 'Member'){
            
            $informations = Information::where('user_id', Auth::user()->id)->get();
        }

        // return view('information/index', compact('categories', 'blog'));
        return view('information/index', [
            'categories' =>$categories,
            'informations'=> $informations
        ]);
    }

    public function store(Request $request){
        // validasi
        $request->validate([
            'cover' => 'required|',
            'title' => 'required|min:3|string',
            'description' => 'required|min:3|string',
            'content' => 'required|min:3|string',
            'category' => 'required|numeric',
        ]);

        // file processing
        $file = $request->file('cover');
        $fullFileName = $file->getClientOriginalName(); // full file name
        $fileName = pathinfo($fullFileName)['filename']; // wile name without extension (.png/.jpg/else..)
        $extension = $file->getClientOriginalExtension();

        $coverName = $fileName . '-' . Str::random(10). '-' . date('YmdHis') . '.' .$extension;

        //save to laravel storage                  
        $file ->storeAs('public/images/cover', $coverName);

        //store to db
        Information::create([
            'cover' => $coverName,
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'status' =>'Pending',
            'user_id' => Auth::user()->id, 
            'title' => $request -> title,
            'category_id' => $request->category,
        ]);

        return redirect('/information   ')->with('success_message','Information created successfully!');
    }

    public function destroy($id){
        
        $info = Information::find($id);

        
        if ($info->user_id != Auth::user()->id) {
            abort(404);
        }else{
            //delete image from local
            if (Storage::exists('public/images/cover/' . $info->cover)) {
                Storage::delete('public/images/cover/' . $info->cover);
            }
            
            Information::find($id)->delete();
            
            
            return redirect('/information')->with('success_message', ($info->title . ' deleted successfully!'));
        }
    }

    public function edit($id){
        $info = Information::find($id);
        $categories = Category::all();

        if ($info->user_id != Auth::user()->id) {
            abort(404);
        }else{
            return view('information/edit', compact('info','categories'));
        }


    }

    public function update(Request $request, $id){
        $info = Information::find($id);

        
        if ($info->user_id != Auth::user()->id) {
            abort(404);
        }else{
            
            // kalau updatenya ga pake gambar
            if ($request->file('cover') == null) {
                //validation
                $request->validate([
                    'title' => 'required|min:3|string',
                    'description' => 'required|min:3|string',
                    'content' => 'required|min:3|string',
                    'category' => 'required|numeric',
                ]);
                
                //update to db
                $info->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'content' => $request->content,
                    'status' =>'Pending',
                    'user_id' => Auth::user()->id, 
                    'title' => $request -> title,
                    'category_id' => $request->category,
                ]);
                
            }else{
                // kalau updatenya ga pake gambar
                //validasi
                $request->validate([
                    'cover' => 'required|',
                    'title' => 'required|min:3|string',
                    'description' => 'required|min:3|string',
                    'content' => 'required|min:3|string',
                    'category' => 'required|numeric',
                ]);
                
                // file processing
                $file = $request->file('cover');
                $fullFileName = $file->getClientOriginalName(); // full file name
                $fileName = pathinfo($fullFileName)['filename']; // wile name without extension (.png/.jpg/else..)
                $extension = $file->getClientOriginalExtension();
                
                $coverName = $fileName . '-' . Str::random(10). '-' . date('YmdHis') . '.' .$extension;
                
                
                
                // menghapus gambar lama di local
                if (Storage::exists('public/images/cover/' . $info->cover)) {
                    Storage::delete('public/images/cover/' . $info->cover);
                }
                
                //store to db
                $info->update([
                    'cover' => $coverName,
                    'title' => $request->title,
                    'description' => $request->description,
                    'content' => $request->content,
                    'status' =>'Pending',
                    'user_id' => Auth::user()->id, 
                    'title' => $request -> title,
                    'category_id' => $request->category,
                ]);
                
                //save to laravel storage                  
                $file ->storeAs('public/images/cover', $coverName);
                
            }
        }
            
        //return data ke halaman blog
        return redirect('/information')->with('success_message','Information updated successfully!');
    }


    public function acceptInformation($id){
        $info = Information::find($id);

        //cara 1 (eloquent)
        // $info->update([
        //     'status' => 'Accepted'
        // ]);

        //cara2 (query builder)
        Information::where('id', $id)->update([
            'status' => 'Accepted'
        ]);
        
        return redirect('/information')->with('success_message','Information accepted successfully!');
    }

    public function searchInformation(Request $request){
        
        $search = Information::where('title','like','%'. $request->searchInput. '%')->get(); // searchInput = atribut name pada input

        return view('information/result', [
            'informations' => $search 
        ]);
    }
}





