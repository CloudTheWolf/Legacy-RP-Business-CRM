<?php

namespace App\Http\Livewire\Shared\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AddEditUser extends Component
{
    public $id = null;
    public bool $is_new;
    public string $full_name,
        $username,
        $steamId,
        $cell,
        $towId,
        $role,
        $password;

    public int
        $cid,
        $disable,
        $admin;

    public function mount()
    {
        if(is_numeric($this->id)) {
            $user = User::query()->where('id', '=', $this->id)->firstOrFail();
            $this->full_name = $user->name ?? '';
            $this->cid = $user->cid ?? '';
            $this->cell = $user->cell ?? '';
            $this->username = $user->email ?? '';
            $this->towId = $user->towID ?? '';
            $this->role = $user->role ?? '';
            $this->steamId = $user->steamId ?? '';
            $this->disable = $user->disabled ?? 0;
            $this->admin = $user->IsAdmin ?? 0;
            $this->password = '';
            $this->is_new = false;
        }else {
            $this->full_name = '';
            $this->cid = 0;
            $this->cell = '';
            $this->username = '';
            $this->towId = '';
            $this->role = '';
            $this->steamId = '';
            $this->disable = 0;
            $this->admin = 0;
            $this->password = '';
            $this->is_new = true;
        }
    }

    public function render()
    {
        return view('shared.forms.add-edit-user');
    }

    public function save_user()
    {
            $user = isset($this->id) ? User::query()->where('id','=',$this->id)->first() : new User();
            if(strlen($this->password) > 0)
            {
                $user->password = (Hash::make($this->password));
            }
            $user->name = $this->full_name;
            $user->cid = $this->cid;
            $user->email = $this->username;
            $user->towID = $this->towId;
            $user->role = $this->role;
            $user->steamId = $this->steamId;
            $user->disabled = $this->disable ?? 0;
            $user->IsAdmin = $this->admin ?? 0;
            $user->cell = $this->cell;
            $user->saveOrFail();
            $this->id = $user->id;
            $this->dispatch('saved',['message' => 'saved']);
            $this->mount();

    }

    public function add_user()
    {
        $this->save_user();
        $this->redirect(route('admin-manage-user',['id' => $this->id]),navigate: true);
    }

    public function cid_lookup()
    {
        try {
            $user = Http::withToken(env("OP_FW_API_KEY"))->withoutVerifying()->get(env("OP_FW_REST_URI") . '/characters/id=' . $this->cid . '/data')->json()['data'][0];
            $this->full_name = $user['first_name'] . " " . $user['last_name'];
            $this->username = $user['first_name'] . "." . $user['last_name'];
            $this->cell = $user['phone_number'];
            $this->password = $user['phone_number'];
        } catch(\Exception)
        {
            $this->dispatch('lookup_error');
        }

    }
}
