<?php

declare(strict_types=1);

use Infrastructure\Migration\Blueprint;
use Infrastructure\Migration\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schema->create('team_invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->string('email');
            $table->string('role')->nullable();
            $table->timestamps();

            $table->unique(['team_id', 'email']);
        });
    }

    public function down(): void
    {
        $this->schema->dropIfExists('team_invitations');
    }
};
