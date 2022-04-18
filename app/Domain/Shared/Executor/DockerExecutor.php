<?php

declare(strict_types=1);

namespace App\Domain\Shared\Executor;

use Symfony\Component\Process\Process;

class DockerExecutor
{
    private string $processOutput = '';

    public function execute(DockerCommand $command): string
    {
        $process = Process::fromShellCommandline($command->buildCommand(), null, null, null, null);

        $process->run(function ($type, $line) {
            $this->processOutput .= $line;
        });

        $this->checkExitCode($process);

        return $this->processOutput;
    }

    private function checkExitCode(Process $process): void
    {
        if ($process->getExitCode() !== 0) {
            throw new \RuntimeException(
                sprintf(
                    'Docker command failed with exit code %d: %s',
                    $process->getExitCode(),
                    $this->processOutput
                )
            );
        }
    }
}
