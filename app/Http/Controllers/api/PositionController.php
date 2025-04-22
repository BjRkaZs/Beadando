<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Position;
use App\Http\Resources\PositionResource;

class PositionController extends Controller
{
    public function getPositions()
    {
        $positions = Position::all();
        return response()->json($positions);
    }

    public function getPositionId($PositionId)
    {
        $position = Position::where("position", $PositionId)->first();
        return $position ? $position->id : null;
    }
}
