<?php

declare(strict_types=1);

namespace Infrastructure\Network\Repositories;

use Domain\Network\Dto\CreateNetworkDto;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Infrastructure\Network\Models\Network;
use Infrastructure\Network\Models\NetworkDriver;
use Infrastructure\Network\Models\NetworkSetting;
use Illuminate\Database\DatabaseManager;

class NetworkWriter
{
    public function __construct(
        private Network $model,
        private NetworkDriver $driverModel,
        private DatabaseManager $db
    ) {
    }

    public function create(CreateNetworkDto $dto): Network
    {
        return $this->db->transaction(function () use ($dto): Network {
            return $this->saveSettings(
                $dto,
                $this->saveNetwork($dto)
            );
        });
    }

    private function saveNetwork(CreateNetworkDto $dto): Network
    {
        $driver = $this->getNetworkDriverByName($dto->getDriver()->name);

        if ($driver === null) {
            throw new ModelNotFoundException('Driver not found');
        }

        $this->model->fill(array_merge($dto->networkDataToArray(), [
            'network_driver_id' => $driver->getId(),
        ]));

        /** @var Network|false $network */
        $network = $dto->getUser()
            ->networks()
            ->save($this->model);

        if ($network === false) {
            throw new \RuntimeException('Network creation failed');
        }

        return $network;
    }

    private function saveSettings(CreateNetworkDto $dto, Network $network): Network
    {
        $settings =  new NetworkSetting([
            'gateway' => $dto->getGateway(),
            'ipv6' => $dto->isIpv6(),
            'attachable' => $dto->isAttachable(),
        ]);

        $network->settings()->save($settings);

        return $network;
    }

    public function getNetworkDriverByName(string $name): ?NetworkDriver
    {
        return $this->driverModel
            ->newQuery()
            ->where('name', '=', $name)
            ->firstOrFail();
    }
}
