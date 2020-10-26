<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   // all tasks
   public function index(){
       $tasks = Task::all()->sortByDesc('prio')->toArray();
       return array_reverse($tasks);
   }

   // add task
   public function add(Request $request){
       $task = new Task([
           'task_name' => $request->input('task_name'),
           'prio' => $request->input('prio'),
           'statut' => $request->input('statut')
       ]);
       $task->save();

       return response()->json('The task successfully added');
   }

   // edit task
   public function edit($id){
       $task = Task::find($id);
       return response()->json($task);
   }

   // update task
   public function update($id, Request $request){
       $task = Task::find($id);
       $task->update($request->all());

       return response()->json('The task successfully updated');
   }

   // delete task
   public function delete($id){
       $task = Task::find($id);
       $task->delete();

       return response()->json('The task successfully deleted');
   }
}
