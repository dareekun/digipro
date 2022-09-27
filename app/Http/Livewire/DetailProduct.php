<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DetailProduct extends Component
{

    public $model_number;
    public $model_id;

    public $new_parts;
    public $uid_delete;

    protected $listeners = [
        'delete_throw' => 'show_delete',
    ];

    public function show_delete($payload) {
        $this->uid_delete = $payload['data'];
        $this->dispatchBrowserEvent('open_dialog_delete');
    }

    public function mount($post) {
        $this->model_id = $post;
        $this->model_number = DB::table('product')->where('id', $post)->value('model_no');
    }

    public function add () {
        DB::table('materials')->insert([
            'part_name' => $this->new_parts,
            'model_no' => $this->model_id
        ]);
        $this->new_parts = NULL;
    }

    public function remove() {
        DB::table('materials')->where('id', $this->uid_delete)->delete();
        $this->dispatchBrowserEvent('hide_dialog_delete');
    }

    public function render()
    {
        $this->foo = DB::table('materials')->where('model_no', $this->model_id)->get();
        return view('livewire.detail-product', ['parts' => $this->foo, 'i' => 1]);
    }
}
