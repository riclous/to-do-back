<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $todos = Todo::select('id','description','created_at')->get();

        foreach($todos as $todo){
            $createdsplit = explode(" ",$todo->created_at);
            $todo['time'] = $createdsplit[1];
            $todo['date'] = $createdsplit[0];
            unset($todo['created_at']);
        }

        Log::channel('stderr')->info('returning index request',[$todos]);
        return response()->json($todos,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // Log::channel('stderr')->info('received store request');
        $todo = json_decode($request->getContent(),true);
        Todo::create($todo);

        return response()->json(['info'=>'ok'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        Log::channel('stderr')->info('received id:',[$id]);

        // $updated=Todo::update($request->all());
        $updated=Todo::find($id);

        $updated->description = $request->description;

        $updated->save();

        if($updated){
            return response()->json(['info'=>true],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Log::channel('stderr')->info("deleted product:",['id'=>$id]);

        $deleted = Todo::find($id)->delete();

        if($deleted){
            return response()->json(['info'=>true],200);
        }
    }
}
