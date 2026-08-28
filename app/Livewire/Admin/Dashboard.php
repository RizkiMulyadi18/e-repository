<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Dokumen;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function toggleStatus($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $dokumen->status = ($dokumen->status === 'published') ? 'draft' : 'published';
        $dokumen->save();

        session()->flash('success', 'Status dokumen "' . $dokumen->title . '" berhasil diubah menjadi ' . strtoupper($dokumen->status) . '!');
    }

    public function render()
    {
        $totalDokumen = Dokumen::count();
        $dokumenDraft = Dokumen::where('status', 'draft')->count();
        $totalKategori = Category::count();
        $totalUnduhan = Dokumen::sum('downloads') ?? 0;
        $totalUser = User::count();

        $latestDokumens = Dokumen::with('category', 'user')
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.admin.dashboard', [
            'totalDokumen' => $totalDokumen,
            'dokumenDraft' => $dokumenDraft,
            'totalKategori' => $totalKategori,
            'totalUnduhan' => $totalUnduhan,
            'totalUser' => $totalUser,
            'latestDokumens' => $latestDokumens,
        ])->layout('layouts.admin');
    }
}
