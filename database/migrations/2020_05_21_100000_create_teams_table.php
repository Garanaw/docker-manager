<?php

declare(strict_types=1);

use Infrastructure\Migration\Blueprint;
use Infrastructure\Migration\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schema->create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->string('name');
            $table->boolean('personal_team');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->schema->dropIfExists('teams');
    }
};
