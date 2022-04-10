<?php

declare(strict_types=1);

namespace App\Application\User\Actions;

use App\Actions\Fortify\PasswordValidationRules;
use App\Application\Shared\Rules\Rule;
use App\Domain\User\Dto\CreateUserDto;
use App\Domain\User\Services\Creator;
use Illuminate\Config\Repository as Config;
use Illuminate\Hashing\HashManager;
use Illuminate\Validation\Factory;
use Infrastructure\Shared\Models\User;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function __construct(
        private Creator $creator,
        private Config $config,
        private Factory $validator,
        private HashManager $hasher
    ) {
    }

    public function create(array $input): User
    {
        $this->validator->make($input, $this->rules())->validate();

        $input['password'] = $this->hasher->make($input['password']);

        $properties = array_filter($input, function ($key) {
            return in_array($key, (new User())->getFillable());
        }, ARRAY_FILTER_USE_KEY);

        $properties['role_name'] = 'admin';

        return $this->creator->create(new CreateUserDto($properties));
    }

    private function rules(): array
    {
        return [
            'name' => Rule::nameRules(),
            'email' => Rule::emailRules(),
            'password' => Rule::passwordRules(),
        ];
    }
}
