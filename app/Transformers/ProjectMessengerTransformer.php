<?php

namespace App\Transformers;

use App\Models\Project;
use League\Fractal\TransformerAbstract;

class ProjectMessengerTransformer extends TransformerAbstract
{

    public function transform(Project $project)
    {
        return [
            'name' => 'Project ' . $project->slug,
            'id' => (int)$project->id
        ];
    }
}