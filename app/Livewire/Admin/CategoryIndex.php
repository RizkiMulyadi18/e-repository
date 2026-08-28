<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $isModalOpen = false;
    public $isDeleteModalOpen = false;

    public $categoryId = null;
    public $deleteCategoryId = null;
    public $name = '';
    public $slug = '';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function openEditModal($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->slug = '';
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:categories,slug,' . $this->categoryId],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'slug.unique' => 'Slug kategori sudah digunakan.',
        ]);

        Category::updateOrCreate(
            ['id' => $this->categoryId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
            ]
        );

        session()->flash('success', $this->categoryId ? 'Kategori berhasil diperbarui! 🎉' : 'Kategori baru berhasil ditambahkan! 🎉');
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteCategoryId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function delete()
    {
        if ($this->deleteCategoryId) {
            $category = Category::findOrFail($this->deleteCategoryId);
            $category->delete();

            session()->flash('success', 'Kategori berhasil dihapus!');
            $this->isDeleteModalOpen = false;
            $this->deleteCategoryId = null;
        }
    }

    public function render()
    {
        $query = Category::withCount('dokumens');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('slug', 'like', '%' . $this->search . '%');
        }

        $categories = $query->latest()->paginate(10);

        return view('livewire.admin.category-index', [
            'categories' => $categories,
        ])->layout('layouts.admin');
    }
}
