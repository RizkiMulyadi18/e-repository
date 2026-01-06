<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    // --- Pastikan variabel-variabel ini ADA ---
    public string $site_name;
    public ?string $site_logo;
    public string $site_footer;
    public bool $site_active;
    public string $theme_color;

    public ?string $footer_text;
    public ?string $site_address;
    public ?string $site_email;
    public ?string $site_phone;
    // ------------------------------------------

    public static function group(): string
    {
        return 'general';
    }
}