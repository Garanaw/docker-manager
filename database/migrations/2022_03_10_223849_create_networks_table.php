<?php

declare(strict_types=1);

use Infrastructure\Migration\Blueprint;
use Infrastructure\Migration\Migration;

return new class extends Migration
{
    public function up(): void
    {
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
    }

    public function down(): void
    {
        $this->schema->dropIfExists('networks');
    }
};
