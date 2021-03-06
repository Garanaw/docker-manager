<?php

declare(strict_types=1);

namespace Infrastructure\Seed;

use Illuminate\Cache\Repository as Cache;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Seeder as BaseSeeder;
use Illuminate\Support\Carbon;
use Symfony\Component\Console\Output\ConsoleOutput;

abstract class Seeder extends BaseSeeder
{
    protected Carbon $now;

    public function __construct(
        protected DatabaseManager $db,
        protected ConsoleOutput $output,
        protected Cache $cache,
        protected string $table
    ) {
        $this->now = Carbon::now();
    }

    protected function note($message): void
    {
        $this->output?->writeln($message);
    }

    public function getTable(): ?string
    {
        return $this->table;
    }

    protected function resetTable(?string $table = null): void
    {
        $table = $table ?? $this->getTable();

        if (is_null($table)) {
            return;
        }

        $this->db->table($table)->delete();
        $resetAutoIncrementStm = 'ALTER TABLE '.$table.' AUTO_INCREMENT = 1;';
        $this->db->statement($resetAutoIncrementStm);
        $this->note('<info>Table reset</info>: ' . $table);
    }

    public abstract function run(): void;

    protected abstract function getData(): array;
}
