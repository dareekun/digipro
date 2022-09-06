<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class ChangePassword extends Component
{
    public $oldpassword;
    public $newpassword;
    public $confirmpassword;

    protected $rules = [
        'oldpassword'     => 'required',
        'newpassword'     => 'required|min:6',
        'confirmpassword' => 'required|same:newpassword',
    ];

    protected $messages = [
        'oldpassword.required'     => 'Old Password is Required.',
        'newpassword.required'     => 'New Password is Required',
        'newpassword.min'          => 'Minimal 6 Character is Required',
        'confirmpassword.required' => 'Confirm Password is Required',
        'confirmpassword.same'     => "Password didn't Match",
    ];

    public function save() {
        $this->validate();
        $uid     = Auth::user();
        if(Hash::check($this->oldpassword, $uid->password)) {
        DB::table('users')->where('id', $uid->id)->update(
            [
                'password' => bcrypt($this->newpassword),
            ]);
            $this->oldpassword = NULL;
            $this->newpassword = NULL;
            $this->confirmpassword = NULL;
            session()->flash('success', 'Password successfully updated.');
        }else {
            $this->oldpassword = NULL;
            $this->newpassword = NULL;
            $this->confirmpassword = NULL;
            session()->flash('failure', 'Password is Wrong');
        }
    }

    public function render()
    {
        return view('livewire.change-password');
    }
}
