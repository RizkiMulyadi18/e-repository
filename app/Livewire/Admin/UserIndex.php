<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $isModalOpen = false;
    public $isDeleteModalOpen = false;

    public $userId = null;
    public $deleteUserId = null;
    public $name = '';
    public $email = '';
    public $password = '';
    public $role = 'editor';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function openEditModal($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role ?? 'editor';
        $this->password = '';
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = 'editor';
        $this->resetValidation();
    }

    public function save()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $this->userId],
            'role' => ['required', 'in:admin,editor'],
            'password' => $this->userId ? ['nullable', 'string', 'min:6'] : ['required', 'string', 'min:6'],
        ];

        $this->validate($rules, [
            'name.required' => 'Nama lengkap pengguna wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->userId], $data);

        session()->flash('success', $this->userId ? 'Data pengguna berhasil diperbarui! 🎉' : 'Pengguna baru berhasil ditambahkan! 🎉');
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        if ($id == Auth::id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif!');
            return;
        }

        $this->deleteUserId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function delete()
    {
        if ($this->deleteUserId && $this->deleteUserId != Auth::id()) {
            $user = User::findOrFail($this->deleteUserId);
            $user->delete();

            session()->flash('success', 'Pengguna berhasil dihapus!');
            $this->isDeleteModalOpen = false;
            $this->deleteUserId = null;
        }
    }

    public function render()
    {
        $query = User::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        $users = $query->latest()->paginate(10);

        return view('livewire.admin.user-index', [
            'users' => $users,
        ])->layout('layouts.admin');
    }
}
