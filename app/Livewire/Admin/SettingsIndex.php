<?php

namespace App\Livewire\Admin;

use App\Settings\GeneralSettings;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingsIndex extends Component
{
    use WithFileUploads;

    public $site_name;
    public $site_logo;
    public $existing_logo;
    public $site_footer;
    public $site_active;
    public $theme_color;
    public $footer_text;
    public $site_address;
    public $site_email;
    public $site_phone;

    public function mount(GeneralSettings $settings)
    {
        $this->site_name = $settings->site_name;
        $this->existing_logo = $settings->site_logo;
        $this->site_footer = $settings->site_footer;
        $this->site_active = (bool) $settings->site_active;
        $this->theme_color = $settings->theme_color ?? 'primary';
        $this->footer_text = $settings->footer_text;
        $this->site_address = $settings->site_address;
        $this->site_email = $settings->site_email;
        $this->site_phone = $settings->site_phone;
    }

    public function updatedSiteActive($value)
    {
        $settings = app(GeneralSettings::class);
        $settings->site_active = (bool) $value;
        $settings->save();

        if ($value) {
            session()->flash('success', 'Website Repositori berhasil DIAKTIFKAN kembali untuk publik! 🟢');
        } else {
            session()->flash('warning', 'Website Repositori DINONAKTIFKAN (Mode Maintenance Aktif)! Pengunjung umum tidak dapat mengakses dokumen. 🚧');
        }
    }

    public function save(GeneralSettings $settings)
    {
        $this->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_footer' => ['nullable', 'string', 'max:255'],
            'site_logo' => ['nullable', 'image', 'max:2048'],
            'site_active' => ['boolean'],
            'theme_color' => ['nullable', 'string'],
            'footer_text' => ['nullable', 'string'],
            'site_address' => ['nullable', 'string'],
            'site_email' => ['nullable', 'email'],
            'site_phone' => ['nullable', 'string'],
        ], [
            'site_name.required' => 'Nama website repositori wajib diisi.',
            'site_logo.image' => 'File logo harus berupa gambar.',
            'site_logo.max' => 'Ukuran logo maksimal 2 MB.',
        ]);

        $settings->site_name = $this->site_name;
        $settings->site_footer = $this->site_footer ?? 'Copyright © 2026';
        $settings->site_active = (bool) $this->site_active;
        $settings->theme_color = $this->theme_color ?? 'primary';
        $settings->footer_text = $this->footer_text;
        $settings->site_address = $this->site_address;
        $settings->site_email = $this->site_email;
        $settings->site_phone = $this->site_phone;

        if ($this->site_logo) {
            $path = $this->site_logo->store('settings', 'public');
            $settings->site_logo = $path;
            $this->existing_logo = $path;
            $this->site_logo = null;
        }

        $settings->save();

        session()->flash('success', 'Pengaturan website berhasil diperbarui! 🎉');
    }

    public function render()
    {
        return view('livewire.admin.settings-index')->layout('layouts.admin');
    }
}
