<?php

declare(strict_types=1);

namespace Infrastructure\Seed;

use Infrastructure\Seed\Seeder;
use Infrastructure\Migration\Migration;
use Illuminate\Database\Events\MigrationEnded as Event;
use Illuminate\Foundation\Application;
use Symfony\Component\Console\Output\ConsoleOutput;

class MigrationEnded
{
    public function __construct(private ConsoleOutput $output, private Application $app)
    {
    }

    public function handle(Event $event): void
    {
        if ($event->method !== 'up') {
            return;
        }

        /** @var Migration $migration */
        $migration = $event->migration;
        $name = $this->getMigrationName($migration);

        if ($migration->hasSeeders() === false) {
            $this->note(sprintf('<info>Nothing to seed: </info> %s', $name));
            return;
        }

        $this->seedMigration($migration, $name);
    }

    private function seedMigration(Migration $migration, string $name)
    {
        $this->note(sprintf('<comment>Seeding:</comment>%s', $name));

        $startTime = microtime(true);

        $migration->getSeeders()->each(function ($seederName) use ($migration) {
            $name = $this->getSeederName($seederName);
            $seeder = $this->makeSeeder($seederName, $migration);
            $this->note(sprintf('<info>Running seeder</info>: %s', $name));
            $seeder->run();
        });

        $runTime = round(microtime(true) - $startTime, 2);

        $this->note(sprintf('<info>Seeded:</info> %s (%d seconds)', $name, $runTime));
    }

    private function makeSeeder(string $seederName, Migration $migration): Seeder
    {
        return $this->app->makeWith($seederName, [
            'table' => $migration->getTable(),
        ]);
    }

    private function getMigrationName(Migration $path): string
    {
        return str_replace('.php', '', get_class($path));
    }

    private function getSeederName(string $path): string
    {
        $pieces = explode('/', $path);
        return end($pieces);
    }

    private function note(string $message): void
    {
        $this->output?->writeln($message);
    }
}
