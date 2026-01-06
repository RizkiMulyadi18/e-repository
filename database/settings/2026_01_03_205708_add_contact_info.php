<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_address', 'Konoha, Desa Api');
        $this->migrator->add('general.site_email', 'repository@konoha.ac.id');
        $this->migrator->add('general.site_phone', '(0645) 123456');
    }
};