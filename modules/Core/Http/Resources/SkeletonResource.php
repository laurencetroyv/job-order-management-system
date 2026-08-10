<?php

namespace Modules\Core\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkeletonResource extends JsonResource
{
    protected Request $request;

    protected function whenRequested(
        string $fieldName,
        mixed $default,
        mixed $resource,
    ): mixed {
        return $this->when(
            in_array($fieldName, $this->request->input('with', []), true),
            $resource,
            $default,
        );
    }
}
