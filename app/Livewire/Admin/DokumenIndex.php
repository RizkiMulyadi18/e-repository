<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DokumenIndex extends Component
{
    use WithPagination, WithFileUploads;

    // Filter & Search
    public $search = '';
    public $categoryFilter = '';
    public $statusFilter = '';

    // Modal State & Form Fields
    public $isModalOpen = false;
    public $isDeleteModalOpen = false;
    public $dokumenId = null;
    public $deleteDokumenId = null;

    public $title = '';
    public $slug = '';
    public $abstract = '';
    public $author = '';
    public $year = '';
    public $institution = '';
    public $status = 'published';
    public $category_id = '';
    public $file;
    public $existingFilePath = null;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->year = date('Y');
        $firstCategory = Category::first();
        if ($firstCategory) {
            $this->category_id = $firstCategory->id;
        }
        $this->isModalOpen = true;
    }

    public function openEditModal($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $this->dokumenId = $dokumen->id;
        $this->title = $dokumen->title;
        $this->slug = $dokumen->slug;
        $this->abstract = trim(strip_tags(html_entity_decode($dokumen->abstract)));
        $this->author = $dokumen->author;
        $this->year = $dokumen->year;
        $this->institution = $dokumen->institution;
        $this->status = $dokumen->status;
        $this->category_id = $dokumen->category_id;
        $this->existingFilePath = $dokumen->file_path;
        $this->file = null;

        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->dokumenId = null;
        $this->title = '';
        $this->slug = '';
        $this->abstract = '';
        $this->author = '';
        $this->year = date('Y');
        $this->institution = '';
        $this->status = 'published';
        $this->category_id = '';
        $this->file = null;
        $this->existingFilePath = null;
        $this->resetValidation();
    }

    public function save()
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:dokumens,slug,' . $this->dokumenId],
            'abstract' => ['required', 'string'],
            'author' => ['required', 'string', 'max:255'],
            'year' => ['required', 'digits:4', 'integer'],
            'institution' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:draft,published'],
            'category_id' => ['required', 'exists:categories,id'],
            'file' => $this->dokumenId ? ['nullable', 'file', 'mimes:pdf', 'max:51200'] : ['required', 'file', 'mimes:pdf', 'max:51200'],
        ];

        $this->validate($rules, [
            'title.required' => 'Judul dokumen wajib diisi.',
            'slug.unique' => 'Slug sudah digunakan, silakan ubah judul.',
            'abstract.required' => 'Abstrak / ringkasan wajib diisi.',
            'author.required' => 'Nama penulis wajib diisi.',
            'year.required' => 'Tahun wajib diisi 4 digit angka.',
            'institution.required' => 'Nama institusi / fakultas wajib diisi.',
            'category_id.required' => 'Pilih salah satu kategori.',
            'file.required' => 'File dokumen format PDF wajib diunggah.',
            'file.mimes' => 'Format file harus berupa PDF.',
            'file.max' => 'Ukuran file maksimal 50 MB.',
        ]);

        $filePath = $this->existingFilePath;
        if ($this->file) {
            $filePath = $this->file->store('dokumens', 'public');
        }

        Dokumen::updateOrCreate(
            ['id' => $this->dokumenId],
            [
                'title' => $this->title,
                'slug' => $this->slug,
                'abstract' => trim(strip_tags(html_entity_decode($this->abstract))),
                'author' => $this->author,
                'year' => $this->year,
                'institution' => $this->institution,
                'status' => $this->status,
                'category_id' => $this->category_id,
                'file_path' => $filePath,
            ]
        );

        session()->flash('success', $this->dokumenId ? 'Dokumen berhasil diperbarui! 🎉' : 'Dokumen baru berhasil disimpan! 🎉');
        $this->closeModal();
    }

    public function toggleStatus($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $dokumen->status = ($dokumen->status === 'published') ? 'draft' : 'published';
        $dokumen->save();

        session()->flash('success', 'Status dokumen "' . $dokumen->title . '" berhasil diubah menjadi ' . strtoupper($dokumen->status) . '!');
    }

    public function confirmDelete($id)
    {
        $this->deleteDokumenId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function delete()
    {
        if ($this->deleteDokumenId) {
            $dokumen = Dokumen::findOrFail($this->deleteDokumenId);
            $dokumen->delete();

            session()->flash('success', 'Dokumen berhasil dihapus!');
            $this->isDeleteModalOpen = false;
            $this->deleteDokumenId = null;
        }
    }

    public function render()
    {
        $query = Dokumen::with('category', 'user');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('author', 'like', '%' . $this->search . '%')
                    ->orWhere('institution', 'like', '%' . $this->search . '%')
                    ->orWhere('abstract', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->categoryFilter) {
            $query->where('category_id', $this->categoryFilter);
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $dokumens = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('livewire.admin.dokumen-index', [
            'dokumens' => $dokumens,
            'categories' => $categories,
        ])->layout('layouts.admin');
    }
}
