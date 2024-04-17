<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\Contracts\MediaServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        try {
            // $validatedData = $request->validated();

            $project = Project::create([
                "name" => $request->name,
                "description" => $request->description,
                "link" => $request->link,
                "student_id" => auth()->id(),
                "category_id" => $request->category_id,
            ]);

            $this->service->store($request->media, $project);
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

    public function filterUserProjects()
    {
        $filters = request(["search", "category"]);
        $filters['user_id'] = auth()->id();

        $projects = Project::filterUserProjects($filters)->with("media", "category")->get();
        return $this->sendResponse(
            message: "filter result",
            result:  ProjectResource::collection($projects),
        );
    }
}
