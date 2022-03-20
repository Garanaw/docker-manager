<?php

declare(strict_types=1);

namespace Application\Network\Requests;

use Application\Shared\Request\Contracts\ContainsDto;
use Domain\Network\Dto\CreateNetworkDto;
use Domain\Network\Enum\Driver;
use Domain\Network\Enum\Scope;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Spatie\DataTransferObject\DataTransferObject;

class StoreRequest extends FormRequest implements ContainsDto
{
    public function getDto(): string
    {
        return CreateNetworkDto::class;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
                'max:255',
            ],
            'driver' => [
                'required',
                new Enum(Driver::class),
            ],
            'scope' => [
                'nullable',
                new Enum(Scope::class),
            ],
            'gateway' => [
                'nullable',
                'ip',
            ],
            'attachable' => [
                'required',
                'boolean',
            ],
            'ipv6' => [
                'required',
                'boolean',
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'attachable' => $this->boolean('attachable', false),
            'ipv6' => $this->boolean('ipv6', false),
        ]);
    }

    public function toDto(): DataTransferObject
    {
        return $this->toGivenDto($this->getDto());
    }

    public function toGivenDto(string $dto): DataTransferObject
    {
        return new $dto($this->validated());
    }
}
