<?php

declare(strict_types=1);

namespace Database\Seeders\User;

use Infrastructure\Seed\Seeder;

class RolesSeeder extends Seeder
{
    protected string $table = 'roles';

    public function run(): void
    {
        $this->db->table('roles')->insert($this->getData());
    }

    protected function getData(): array
    {
        return [
            [
                'team_id' => null,
                'name' => 'admin',
                'guard_name' => 'web',
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ],
            [
                'team_id' => null,
                'name' => 'network',
                'guard_name' => 'web',
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ],
            [
                'team_id' => null,
                'name' => 'user',
                'guard_name' => 'web',
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ],
        ];
    }
}
