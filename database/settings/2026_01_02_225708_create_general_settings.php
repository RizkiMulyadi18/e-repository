<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'E-Repository Konoha');
        $this->migrator->add('general.site_logo', null);
        $this->migrator->add('general.site_footer', 'Copyright © 2026 Universitas Konoha');
        $this->migrator->add('general.site_active', true);
        $this->migrator->add('general.theme_color', 'primary');
    }
};
