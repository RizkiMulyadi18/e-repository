<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Kita isi dengan teks default agar tidak kosong
        $this->migrator->add('general.footer_text', 'Arsip digital Universitas Konoha yang menyimpan, melestarikan, dan menyebarluaskan karya intelektual civitas akademika.');
    }
};