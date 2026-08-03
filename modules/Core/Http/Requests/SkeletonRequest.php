<?php

namespace Modules\Core\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Enums\SoftDeleteVisibility;

/**
 * @property-read string[] $with
 * @property-read ?string $soft_delete_visibility
 */
class SkeletonRequest extends FormRequest
{
    /**
     * @param  array<int, string>  $relationships
     * @return array<string, mixed>
     */
    public function relationshipParameter(array $relationships): array
    {
        return [
            'with'   => ['sometimes', 'array'],
            'with.*' => [
                'sometimes',
                'in:'.implode(',', $relationships),
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function withTrashedParameter(): array
    {
        return [
            'soft_delete_visibility' => [
                'sometimes',
                Rule::enum(SoftDeleteVisibility::class),
            ],
        ];
    }
}
