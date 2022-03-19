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
    }

    public function down(): void
    {
        $this->schema->dropIfExists($this->getTable());
    }
};
