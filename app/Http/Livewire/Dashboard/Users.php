<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class Users extends Component
{
    use WireToast;
    use WithPagination;

    public $search;
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $itemsPerPage = 15;
    public $userId;
    public $name;
    public $email;
    public $password;
    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'page' => ['except' => 1, 'as' => 'p'],
        'sortField' => ['as' => 'sf'],
        'sortDirection' => ['as' => 'sd'],
        'itemsPerPage' => ['as' => 'ipp'],
    ];
    protected $listeners = ['save'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->search = request()->query('s', $this->search);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sortDirection = 'desc';
        }
        $this->sortField = $field;
    }

    public function openForm($userId)
    {
        $user = User::where('id', $userId)->firstOrFail();
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|between:5,64|email|unique:users,email,' . $this->userId,
        ]);

        DB::transaction(function () {
            $user = User::updateOrCreate(
                ['id' => $this->userId],
                [
                    'name' => trim($this->name),
                    'email' => $this->email,
                ]
            );

            if ($this->password) {
                $user->update([
                    'password' => Hash::make($this->password),
                ]);
            }

            $user->save();

            toast()
            ->success($this->name . ' сохранен.')
            ->push();

            $this->closeForm();
            $this->dispatchBrowserEvent('close');
        });
    }

    public function remove($itemId)
    {
        $user = User::find($itemId);


        $user_name = $user->name;
        $user->delete();

        $this->reset();

        toast()
        ->success('User "' . $user_name . '" was deleted.')
        ->push();
    }

    public function closeForm()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.dashboard.users', [
            'users' => User::when($this->search, function ($query) {
                $query->whereLike(['name', 'id', 'email'], $this->search);
            })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->itemsPerPage),
        ])
            ->layout('components.layouts.dashboard.app');
    }
}
