<?php

declare(strict_types=1);

use Infrastructure\Migration\Blueprint;
use Infrastructure\Migration\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schema->create('network_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('network_id')->constrained();
            $table->boolean('attachable')->default(true);
            $table->foreignId('copy_from_id')->nullable()->references('id')->on('networks');
            $table->ipAddress('gateway')->nullable();
            $table->boolean('ipv6')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->schema->dropIfExists('network_settings');
    }
};
