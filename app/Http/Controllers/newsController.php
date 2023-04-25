<?php

namespace App\Http\Controllers;

use App\Models\newsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class newsController extends Controller
{
    public function index()
    {

        $data = newsModel::all();
        
        return view('news/index', compact('data'));
    }

    public function add()
    {
        
        return view('news/add');
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $data = newsModel::find($id);
        $data->delete();

        return redirect(route('news'))->with('message', 'Berhasil Update Data!');
    }

    public function edit($id)
    {
        $data = newsModel::find($id);
        return view('news/edit', compact('data'));
    }

    public function update_data(Request $request)
    {

        $rules = [
            'title' => 'required|min:2|max:255',
            'desc' => 'required|min:2',
            'short_desc' => 'required|min:2|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
        ];

    $validator = Validator::make($request->all(), $rules);
    
    if ($validator->fails()) {

        
        return Redirect::back()->withErrors(['error' => $validator->errors()->first()])->withInput();

    } else {
        
            $id = $request->input('id');
            $title = $request->input('title');
            $short_desc = $request->input('short_desc');
            $desc = $request->input('desc');

            $name = "";
            $path = "";
            if ($request->file('image')) {
                $name = $request->file('image')->getClientOriginalName();
                $path = base_path() . '/public/img';
                $request->file('image')->move($path,$name);
                
            }
   
           $save = newsModel::firstWhere('id', $id);
           $save->title = $title;
           $save->short_desc = $short_desc;
           $save->desc = $desc;
           $save->image = $name;
           $save->updated_at = now();
            $save->save();
         return redirect(route('news.edit', [$id]))->with('message', 'Berhasil Update Data!');
        }
   
    }

    public function store(Request $request)
    {

            $rules = [
                    'title' => 'required|min:2|max:255',
                    'desc' => 'required|min:2',
                    'short_desc' => 'required|min:2|max:255',
                    'image' => 'required|image|mimes:jpeg,jpg,png,gif',
                ];

            $validator = Validator::make($request->all(), $rules);
            
            if ($validator->fails()) {

                
                return Redirect::back()->withErrors(['error' => $validator->errors()->first()])->withInput();

            } else {
                $title = $request->input('title');
                $short_desc = $request->input('short_desc');
                $desc = $request->input('desc');
    
                $name = "";
                $path = "";
                if ($request->file('image')) {
                    $name = $request->file('image')->getClientOriginalName();
                    $path = base_path() . '/public/img';
                    $request->file('image')->move($path,$name);
                    
                }
       
               $save = new newsModel;
               $save->title = $title;
               $save->short_desc = $short_desc;
               $save->desc = $desc;
               $save->image = $name;
               $save->status = 1;
               $save->created_at = now();
                $save->save();
             return redirect(route('news.add'))->with('message', 'Berhasil Tambah Data!');
                
            }

   
    }
    
}
