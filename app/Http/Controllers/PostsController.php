<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        $lastRow = Post::latest()->first();
        $lastAreaCode = 1;

        if(!empty($lastRow->area_code)){
            $lastAreaCode = $lastRow->area_code + 1;
        }

        return view('posts.create', ['lastAreaCode' => $lastAreaCode]);
    }

    public function store()
    {
        request()->validate([
            'desc' => 'required',
            'floor' => 'required',
            'row' => 'required',
            'col' => 'required'
        ]);

        Post::create([
            'area_code' => request('area_code'),
            'desc' => request('desc'),
            'floor' => request('floor'),
            'row' => request('row'),
            'col' => request('col'),
            'status' => 'occupied'
        ]);

        return redirect('/posts');
    }

    public function edit($id)
    {
        $posts = Post::where('id', $id)->first();
        return view('posts.edit', ['post' => $posts]);
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'desc' => 'required',
            'floor' => 'required',
            'row' => 'required',
            'col' => 'required'
        ]);

        try {
            Post::where('id', $id)->update([
                'desc' => request('desc'),
                'floor' => request('floor'),
                'row' => request('row'),
                'col' => request('col')
            ]);
            print_r(['statusCode' => 200, 'message' => 'success']);
            return redirect('/posts');
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function preview($id)
    {
        $posts = Post::where('id', $id)->first();

        $row = $posts->row;
        $col = $posts->col;
        $position = '';
        if($row == 1 && $col == 1){
            $position = 'r1c1'; 
        }
        elseif($row == 1 && $col == 2){
            $position = 'r1c2'; 
        }
        elseif($row == 2 && $col == 1){
            $position = 'r2c1'; 
        }
        elseif($row == 2 && $col == 2){
            $position = 'r2c2'; 
        }

        return view('posts.preview', ['posts' => $posts, 'position' => $position]);
    }

    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $position = $request->position;

        switch ($position) {
            case "r1c1":
                $row = 1;
                $col = 1;
                break;
            case "r1c2":
                $row = 1;
                $col = 2;
                break;
            case "r2c1":
                $row = 2;
                $col = 1;
                break;
            case "r2c2":
                $row = 2;
                $col = 2;
                break;
        }

        try {
            Post::where('id', $id)->update(['row' => $row, 'col' => $col, 'status' => $status]);
            return ['statusCode' => 200, 'message' => 'success'];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Request $request)
    {
        try {
            Post::destroy($request->id);
            return ['statusCode' => 200, 'message' => 'success'];
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
