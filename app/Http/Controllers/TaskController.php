<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {

        $tasks = Task::with('user')->get();

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function create(Task $task)
    {

        return view('tasks.create',[
            'task' => $task,
            'priorities' => Priority::all(),
            'users' => User::all()
        ]);
    }

    public function show(Task $task)
    {

        return view('tasks.show', [
            'task' => $task
        ]);
    }

    public function store()
    {

        // $task = new Task();

        // $task->name = request('name'); 
        // $task->description = request('description');

        // $task->save();
        $data = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'priority_id' => 'required|exists:priorities,id',
            'user_id' => 'required|exists:users,id'
        ]);

        Task::create($data);

        return redirect('/tasks')->with('sucess', 'Tarea creada exitosamente.');
    }
    public function delete(Task $task)
    {
        $task->delete();
        return redirect('/tasks');
    }
    public function edit(Task $task)
    {

        return view('tasks.edit', [
            'task' => $task,
            'priorities' => Priority::all(),
            'users' => User::all()
        ]);
    }

    public function update(Task $task)
    {

        $data = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'priority_id' => 'required|exists:priorities,id',
            'user_id' => 'required|exists:users,id'
        ]);

       $task->fill($data)->save();
       //$task->update($data);

        return redirect('/tasks/' . $task->id);
    }
    public function complete(Task $task)
    {
        $task->completed = true;
        $task->save();

        return redirect('/tasks');
    }
}

