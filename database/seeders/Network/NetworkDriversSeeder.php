<?php

declare(strict_types=1);

namespace Database\Seeders\Network;

use App\Domain\Network\Enum\Driver;
use App\Infrastructure\Seed\Seeder;

class NetworkTypesSeeder extends Seeder
{
    public function run(): void
    {
        $this->db->table($this->getTable())->insert($this->getData());
    }

    protected function getData(): array
    {
        return Driver::getAll()->map(fn (Driver $driver): array => [
            'name' => $driver->value,
            'creatable' => $driver->isCreatable(),
            'created_at' => $this->now,
            'updated_at' => $this->now,
        ])->toArray();
    }
}
