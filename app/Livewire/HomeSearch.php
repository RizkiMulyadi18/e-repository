<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Dokumen;
use Livewire\Component;
use Livewire\WithPagination;

class HomeSearch extends Component
{
    use WithPagination;

    // Variabel publik ini otomatis terhubung ke form di frontend
    public $search = '';
    public $activeCategory = null;

    // Reset halaman ke 1 setiap kali user mengetik search atau ganti kategori
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingActiveCategory()
    {
        $this->resetPage();
    }

    // Fungsi untuk mengubah kategori (toggle)
    public function setCategory($name)
    {
        // Jika diklik kategori yang sama, maka reset (batalkan filter)
        $this->activeCategory = ($this->activeCategory === $name) ? null : $name;
    }

    // Fungsi Reset Filter Total
    public function resetFilters()
    {
        $this->search = '';
        $this->activeCategory = null;
        $this->resetPage();
    }

    public function render()
    {
        // 1. Query Dasar
        $query = Dokumen::with('category')->where('status', 'published');

        // 2. Filter Pencarian (Realtime)
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('author', 'like', '%' . $this->search . '%')
                    ->orWhere('institution', 'like', '%' . $this->search . '%')
                    ->orWhere('abstract', 'like', '%' . $this->search . '%');
            });
        }

        // 3. Filter Kategori
        if ($this->activeCategory) {
            $query->whereHas('category', function ($q) {
                $q->where('name', $this->activeCategory);
            });
        }

        return view('livewire.home-search', [
            'dokumens' => $query->latest()->paginate(6),
            'categories' => Category::all(),
        ]);
    }
}
