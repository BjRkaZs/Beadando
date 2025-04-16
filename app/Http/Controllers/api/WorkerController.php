<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Worker;

class WorkerController extends Controller
{
    public function getWorkers()
    {
        $workers = Worker::all();
        return response()->json($workers);
    }

    public function searchWorker(Request $request)
    {
        $worker = Worker::find($request->id);

        if (!$worker) {
            return response()->json(['message' => 'Worker not found'], 404);
        }

        return response()->json($worker);
    }

    public function addWorker(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);

        $worker = Worker::create($validatedData);

        return response()->json(['message' => 'Worker added successfully', 'worker' => $worker], 201);
    }


    public function updateWorker(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:workers,id',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);

        $worker = Worker::find($validatedData['id']);
        $worker->update($validatedData);

        return response()->json(['message' => 'Worker updated successfully', 'worker' => $worker]);
    }

    public function deleteWorker(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:workers,id',
        ]);

        $worker = Worker::find($validatedData['id']);
        $worker->delete();

        return response()->json(['message' => 'Worker deleted successfully']);
    }
}