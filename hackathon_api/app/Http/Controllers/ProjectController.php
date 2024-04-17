<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\Contracts\MediaServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends BaseApiController
{
    use AuthorizesRequests;
    public function __construct(public MediaServiceInterface $service)
    {
    }

    public function index()
    {
        try {
            return $this->sendResponse(
                message: "projects list",
                result: ProjectResource::collection(Project::with("media", "category")->get()),
            );
        } catch (\Exception $e) {
            return $this->sendError(error: $e->getMessage());
        }
    }

    public function show(Project $project)
    {
        try {
            return $this->sendResponse(
                message: "project showed ",
                result: new ProjectResource($project),
            );
        }catch (\Exception $e) {
            return $this->sendError(error: $e->getMessage());
        }
    }

    public function store(StoreProjectRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $project = Project::create([
                "name" => $validatedData["name"],
                "description" => $validatedData["description"],
                "link" => $validatedData["link"],
                "student_id" => auth()->id(),
                "category_id" => 1
            ]);

            $this->service->store($validatedData["media"], $project);

            return $this->sendResponse(
                message: "the project was created successfully",
                result: new ProjectResource($project),
                code: 201
            );
        } catch (\Exception $e) {
            return $this->sendError(error: $e->getMessage());
        }
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        try {
            $validatedData = $request->validated();
            $project->update([
                "name" => $validatedData["name"],
                "description" => $validatedData["description"],
                "link" => $validatedData["link"],
            ]);
            $this->service->update($validatedData["media"], $project);
            return $this->sendResponse(
                message: "project update successfully",
                code: 204
            );
        } catch (\Exception) {
            return $this->sendError(
                error: "could not update project"
            );
        }
    }

    public function destroy(Project $project)
    {
        try {
            $project->delete();
            return $this->sendResponse(message: "project destroyed successfully",);
        } catch (\Exception $e) {
            return $this->sendError("could not delete project");
        }
    }

    public function restore($id)
    {
        try {
            Project::withTrashed()->where("id", $id)->restore();
            return $this->sendResponse(message: "project restored successfully");
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function filter()
    {
        $projects = Project::filter(request(["search", "category"]))->with("media", "category")->get();
        return $this->sendResponse(
            message: "filter result",
            result:  ProjectResource::collection($projects),
        );
    }
}
