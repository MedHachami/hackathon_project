<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class StoreProjectRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name" => "required|unique:projects",
            "description" => "required",
            "link" => "required",
            "media" => "required"
        ];
    }
}
