<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idea;
class IdeaController extends Controller
{
    public function getIdeas(){
        return Idea::orderBy('id','DESC')->get();
    }

    public function store(Request $request){
        $this->validate($request,
        ['descripcion' => 'required'] );

        Idea::create($request->all());

        return;
    }
}
