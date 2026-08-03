<?php

namespace Modules\Core\Http\Requests;

/**
 * @property-read bool $list_all
 * @property-read ?string $search
 * @property-read ?int $page
 * @property-read ?int $per_page
 * @property-read ?string $sort_by
 * @property-read ?string $sort_order
 */
class IndexSkeletonRequest extends SkeletonRequest
{
    protected function shouldListAll(): bool
    {
        return $this->input('list_all', false);
    }

    /**
     * @return array<string, mixed>
     */
    public function searchParameter(): array
    {
        return [
            'search' => [
                'sometimes',
                'string',
                'max:64',
            ],
        ];
    }

    /**
     * @param  array<string, mixed>  $acceptedSortByColumns
     * @return array<string, mixed>
     */
    public function paginatedParameters(array $acceptedSortByColumns = []): array
    {
        if ($this->shouldListAll()) {
            return [
                'list_all' => [
                    'nullable',
                    'boolean',
                ],
            ];
        }

        $inRule = ! empty($acceptedSortByColumns)
            ? 'in:'.implode(',', $acceptedSortByColumns)
            : '';

        return [
            'list_all' => [
                'nullable',
                'boolean',
            ],

            'page' => [
                'sometimes',
                'integer',
                'min:1',
            ],

            'per_page' => [
                'sometimes',
                'integer',
                'min:1',
                'max:64',
            ],

            'sort_by' => [
                'nullable',
                'string',
                'max:64',
                $inRule,
            ],

            'sort_order' => [
                'nullable',
                'string',
                'in:asc,desc',
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function indexDefaultParameters(): array
    {
        return [
            ...$this->searchParameter(),
            ...$this->paginatedParameters(),
            ...$this->withTrashedParameter(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            ...$this->indexDefaultParameters(),
        ];
    }
}
