<?php

declare(strict_types=1);

namespace App\Application\User\Commands;

use App\Application\Shared\Rules\Rule;
use App\Domain\User\Dto\CreateUserDto;
use App\Domain\User\Services\Creator;
use App\Infrastructure\Shared\Models\Permissions\Role;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Factory;

class MakeUserCommand extends Command
{
    protected $signature = 'make:user {name}';

    protected $description = 'Create a new user';

    private Factory $validator;
    private Collection $roles;
    private array $roleNames = [];

    public function handle(Creator $creator, Role $role, Factory $validator): void
    {
        $this->validator = $validator;
        $this->roles = $role->all();
        $this->roleNames = $this->roles->map->getName()->toArray();

        $userDto = new CreateUserDto($this->getData());

        $creator->create($userDto);
    }

    private function getData(): array
    {
        return [
            'name' => $this->argument('name'),
            'email' => $this->askForEmail(),
            'password' => $this->askForPassword(),
            'email_verified_at' => Carbon::now(),
            'role_names' => $this->askForRole(),
        ];
    }

    private function askForEmail(): string
    {
        do {
            $email = $this->ask('What is the user email?');
        } while (! $this->validator->make(['email' => $email], ['email' => Rule::emailRules()])->passes());

        return $email;
    }

    private function askForPassword(): string
    {
        do {
            $data = [
                'password' => $this->secret('What is the user password?'),
                'password_confirmation' => $this->secret('Confirm the user password?'),
            ];
        } while (! $this->validator->make($data, ['password' => Rule::passwordRules()])->passes());

        return $data['password'];
    }

    private function askForRole(): string
    {
        do {
            $roleName = $this->anticipate('What is the user role?', $this->roleNames);
        } while (! $this->validator->make(['roles' => $roleName], ['roles' => ['required', Rule::in($this->roleNames)]])->passes());

        return $roleName;
    }
}
