<?php

namespace App\Http\Controllers\teacher;

use App\Models\rating;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatRatingRequest;
use App\Http\Requests\CreatUpdateRatingRequest;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class TeacherRatingController extends Controller
{

    public function CreateRating(CreatRatingRequest $request)
    {
        $Rating = $request->validated();
        $teacher = JWTAuth::user();

        rating::create([
            'note' => $request->note,
            'comment' => $request->comment,
            'teacher_id' => $teacher->id,
            'project_id' => $request->project_id
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Rate Created successfully',
            'Rating' => $Rating,
        ]);
    }
    public function EditRating($id)
    {
        $rating = rating::where('project_id', $id)->first();
        return response()->json([
            'statut' => 'success',
            'rating' => $rating,
        ], 200);
    }

    public function UpdateRating($id, CreatUpdateRatingRequest $request)
    {
        $Rating = $request->validated();


        rating::where('project_id', $id)->update([
            'note' => $request->note,
            'comment' => $request->comment

        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Rate Updated successfully',
            'Rating' => $Rating,

        ]);
    }
    public function DeleteRating($id){

        $rating = rating::findOrFail($id);
        $rating->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'rate deleted successfully',

        ], 200);
    }
}
