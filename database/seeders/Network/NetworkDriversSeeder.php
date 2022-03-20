<?php

declare(strict_types=1);

namespace Database\Seeders\Network;

use Domain\Network\Enum\Driver;
use Infrastructure\Seed\Seeder;

class NetworkDriversSeeder extends Seeder
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
