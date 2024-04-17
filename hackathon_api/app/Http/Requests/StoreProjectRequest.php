<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class StoreProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
//        return $this->user()->can("create", Project::class);
    }

    public function rules()
    {
        return [
            "name" => "required",
            "description" => "required",
            "link" => "required",
            "media" => "required"
        ];
    }
}
