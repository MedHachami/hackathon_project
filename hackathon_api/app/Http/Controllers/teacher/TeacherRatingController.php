<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatRatingRequest;
use App\Http\Requests\CreatUpdateRatingRequest;
use App\Models\Project;
use App\Models\Rating;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class TeacherRatingController extends Controller
{

    public function CreateRating(CreatRatingRequest $request)
    {
        $validatedData = $request->validated();
        $teacher = JWTAuth::user();

        $rating = Rating::create([
            'note' => $validatedData["note"],
            'comment' => $validatedData["comment"],
            'teacher_id' => $teacher->id,
            'project_id' => $validatedData["project_id"]
        ]);

        Project::find($validatedData["project_id"])
            ->update(["is_rated" => true]);

        return response()->json([
            'status' => 'success',
            'message' => 'Rate Created successfully',
            'Rating' => $rating,
        ]);
    }

    public function EditRating($id)
    {
        $rating = Rating::where('project_id', $id)->first();
        return response()->json([
            'statut' => 'success',
            'rating' => $rating,
        ], 200);
    }

    public function UpdateRating($id, CreatUpdateRatingRequest $request)
    {
        $Rating = $request->validated();
        Rating::where('project_id', $id)->update([
            'note' => $request->note,
            'comment' => $request->comment

        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Rate Updated successfully',
            'Rating' => $Rating,

        ]);
    }

    public function DeleteRating($id)
    {

        $rating = rating::findOrFail($id);
        $rating->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'rate deleted successfully',

        ], 200);
    }
}
