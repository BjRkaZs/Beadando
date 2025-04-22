<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Http\Controllers\ResponseController;
use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\City;
use App\Models\Department;
use App\Models\Position;


class WorkerController extends ResponseController
{
    public function getWorkers()
    {
        $workers = Worker::with("department", "position", "city")->get();
        return response()->json($workers);
    }
    

    public function searchWorker(Request $request)
    {
        $worker = Worker::where( "name", $request["name"] )->first();

        if( !$worker ){

            return $this->sendError( "Nincs ilyen dolgozó" );
        }

        return $this->sendResponse( $worker, "Sikeres olvasás");
    }


    public function addWorker(Request $request)
    {
        $worker = new Worker;
        $worker->name = $request["name"];
        $worker->birthdate = $request["birthdate"];
        $worker->city_id = $request["city"];
        $worker->phonenumber = $request["phonenumber"];
        $worker->salary = $request["salary"];
        $worker->department_id = $request["department"];
        $worker->position_id = $request["position"];
        $worker->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Dolgozó sikeresen hozzáadva',
            'data' => $worker,
        ]);
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