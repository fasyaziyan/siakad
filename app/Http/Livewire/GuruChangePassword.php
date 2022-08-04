<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Rules\CheckPassword;
use App\Models\Guru;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class GuruChangePassword extends Component
{
    public $oldPassword;
    public $newPassword;
    public $newPasswordConfirmation;

    public function render()
    {
        return view('livewire.guru-change-password');
    }

    protected function rules()
    {
        return [
            'oldPassword' => ['required', new CheckPassword],
            'newPassword' => ['required', 'min:8'],
            'newPasswordConfirmation' => ['required', 'same:newPassword'],
        ];
    }

    protected $messages = [
        'oldPassword.required' => 'Password lama harus diisi',
        'newPassword.required' => 'Password baru harus diisi',
        'newPassword.min' => 'Password baru minimal 8 karakter',
        'newPasswordConfirmation.required' => 'Konfirmasi password baru harus diisi',
        'newPasswordConfirmation.same' => 'Konfirmasi password baru tidak sama',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function changePassword()
    {
        $this->validate();

        $guru = Guru::find(Auth::guard('guru')->user()->nip);
        $guru->password = Hash::make($this->newPassword);
        $guru->update();

        $this->dispatchBrowserEvent('swal:modal', [
            'title' => 'Berhasil',
            'text' => 'Password berhasil diubah',
            'icon' => 'success',
            'timer' => 2000,
        ]);
    }
}
