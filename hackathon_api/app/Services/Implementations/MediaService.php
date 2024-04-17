<?php

namespace App\Services\Implementations;

use App\Models\Project;
use App\Services\Contracts\MediaServiceInterface;
use Illuminate\Support\Str;

class MediaService implements MediaServiceInterface
{

    public function store(array $medias, Project $project)
    {
        foreach ($medias as $media) {
            $mediaPath = $this->upload($media);
            $project->media()->create([
                "path" => $mediaPath,
            ]);
        }
    }
    public function update(array $medias, Project $project)
    {
        foreach ($medias as $media) {
            $mediaPath = $this->upload($media);
            $project->media()->update([
                "path" => $mediaPath,
            ]);
        }
    }
    public function upload($media)
    {
        $mediaName = time().Str::random( 4) . "." . $media->extension();
        $media->storeAs('public/', $mediaName);
        return $mediaName;
    }

}
