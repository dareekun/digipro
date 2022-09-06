<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ProductControl extends Component
{

    public $section_add;
    public $line_add;
    public $model_add;
    public $packing_add;
    public $time_add;
    public $man_add;

    private $uid_delete;
    public $dummy_render = 0;

    protected $listeners = [
        'uid_delete' => 'change_uid_delete', 
    ];

    public function change_uid_delete($payload){
        $this->uid_delete = $payload['data'];
    }

    public function add() {
        if(DB::table('product')->where('model_no', $this->model_add)->exists()) {
            session()->flash('alerts', ['type' => 'alert-danger', 'message' => 'Model Number Already Exists']);
            $this->model_add = NULL;
            $this->section_add = NULL;
            $this->line_add = NULL;
            $this->packing_add = NULL;
            $this->time_add = NULL;
            $this->man_add = NULL;
        } else {
            DB::table('product')->insert([
                'model_no' => $this->model_add,
                'section' => $this->section_add,
                'line' => $this->line_add,
                'packing' => $this->packing_add,
                'time' => $this->time_add,
                'std_mp' => $this->man_add
        ]);
        $this->dispatchBrowserEvent('close_add_modal');
        session()->flash('alerts', ['type' => 'alert-success', 'message' => 'Product Successfully Added']);
        $this->dummy_render++;
        $this->dispatchBrowserEvent('redraw_table');
        }
    }

    public function delete() {
        DB::table('product')->where('id', $this->uid_delete)->delete();
        session()->flash('alerts', ['type' => 'alert-success', 'message' => 'Deleted Success'.$this->uid_delete]);
        $this->dummy_render++;
        $this->dispatchBrowserEvent('redraw_table');
    }

    public function render()
    {
        $this->foo = DB::table('product')->get();
        return view('livewire.product-control', ['products' => $this->foo, 'i' => 1]);
    }
}