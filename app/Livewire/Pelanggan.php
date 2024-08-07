<?php

namespace App\Livewire;

use App\Models\Pelanggan as ModelsPelanggan;
use Livewire\Component;

class Pelanggan extends Component
{

     public $namaPelanggan, $alamat, $tlp,$dataEdit;



    public function hapus($id) {
        ModelsPelanggan::find($id)->delete();
        $this->reset();
    }
    public function edit($id) {
        $this->dataEdit = ModelsPelanggan::findOrFail($id);
        $this->namaPelanggan = $this->dataEdit->namaPelanggan;
        $this->alamat = $this->dataEdit->alamat;
        $this->tlp = $this->dataEdit->no_tlp;
    }
    public function addData()
    {

            if ($this->dataEdit) {
                $simpan = $this->dataEdit;
            }else{
                $simpan = new ModelsPelanggan();
            }
            $simpan->namaPelanggan = $this->namaPelanggan;
            $simpan->alamat = $this->alamat;
            $simpan->no_tlp = $this->tlp;
            $simpan->save();

        $this->reset();
    }
    public function render()
    {
        $datas = ModelsPelanggan::all();
        return view('livewire.pelanggan',compact('datas'));
    }
}
