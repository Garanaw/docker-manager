<?php

declare(strict_types=1);

use Database\Seeders\User\PermissionsSeeder;
use Database\Seeders\User\RolesSeeder;
use Infrastructure\Migration\Blueprint;
use Infrastructure\Migration\Migration;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    protected ?string $table = 'permissions';

    protected array $seeders = [
        PermissionsSeeder::class,
        RolesSeeder::class,
    ];

    public function up(): void
    {
        $config = config('permission');
        $tableNames = $config['table_names'];
        $columnNames = $config['column_names'];
        $teams = $config['teams'];

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }
        if ($teams && empty($columnNames['team_foreign_key'] ?? null)) {
            throw new \Exception('Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        $this->schema->create($tableNames['permissions'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 125);       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name', 125); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        $this->schema->create($tableNames['roles'], function (Blueprint $table) use ($teams, $columnNames) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
            $table->string('name', 125);       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name', 125); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();
            $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
            $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
        });

        $this->schema->create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotPermission);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign(PermissionRegistrar::$pivotPermission)
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->unsignedBigInteger($columnNames['team_foreign_key']);
            $table->index($columnNames['team_foreign_key'], 'model_has_permissions_team_foreign_key_index');

            $table->primary(
                [$columnNames['team_foreign_key'], PermissionRegistrar::$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                'model_has_permissions_permission_model_type_primary'
            );
        });

        $this->schema->create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotRole);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign(PermissionRegistrar::$pivotRole)
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_roles_team_foreign_key_index');

                $table->primary(
                    [$columnNames['team_foreign_key'], PermissionRegistrar::$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary'
                );
        });

        $this->schema->create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotPermission);
            $table->unsignedBigInteger(PermissionRegistrar::$pivotRole);

            $table->foreign(PermissionRegistrar::$pivotPermission)
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign(PermissionRegistrar::$pivotRole)
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary([PermissionRegistrar::$pivotPermission, PermissionRegistrar::$pivotRole], 'role_has_permissions_permission_id_role_id_primary');
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
    }

    public function down(): void
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        $this->schema->drop($tableNames['role_has_permissions']);
        $this->schema->drop($tableNames['model_has_roles']);
        $this->schema->drop($tableNames['model_has_permissions']);
        $this->schema->drop($tableNames['roles']);
        $this->schema->drop($tableNames['permissions']);
    }
};
