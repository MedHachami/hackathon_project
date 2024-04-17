<?php

namespace App\Services\Contracts;

use App\Models\Project;

interface MediaServiceInterface
{
    public function store(array $medias, Project $project);

    public function update(array $medias, Project $project);
    public function upload($media);

}
