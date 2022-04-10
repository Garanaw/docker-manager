<?php

declare(strict_types=1);

use Database\Seeders\Network\NetworkDriversSeeder;
use Infrastructure\Migration\Blueprint;
use Infrastructure\Migration\Migration;

return new class extends Migration
{
    protected ?string $table = 'network_drivers';
    protected array $seeders = [
        NetworkDriversSeeder::class,
    ];

    public function up(): void
    {
        $this->schema->create($this->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('creatable')->default(true);
            $table->timestamps();
        });


        $this->schema->create('networks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('network_id')->nullable();
            $table->string('scope');
            $table->foreignId('network_driver_id')->constrained();
            $table->boolean('is_active')->default(false);
            $table->string('description')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->schema->create('network_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('network_id')->constrained();
            $table->boolean('attachable')->default(true);
            $table->foreignId('copy_from_id')->nullable()->references('id')->on('networks');
            $table->boolean('ipv6')->default(true);
            $table->timestamps();
        });

        $this->schema->create('network_subnets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('network_id')->constrained();
            $table->ipAddress('gateway');
            $table->string('subnet')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->schema->dropIfExists('networks_system');
    }
};
