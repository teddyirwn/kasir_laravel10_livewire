<?php

namespace App\Livewire;

use App\Models\Produk as ModelsProduk;
use Livewire\Component;

class Produk extends Component
{
    public $namaProduk, $harga, $stok,$dataEdit;



    public function hapus($id) {
        ModelsProduk::find($id)->delete();
        $this->reset();
    }
    public function edit($id) {
        $this->dataEdit = ModelsProduk::findOrFail($id);
        $this->namaProduk = $this->dataEdit->nama_produk;
        $this->harga = $this->dataEdit->harga;
        $this->stok = $this->dataEdit->stok;
    }
    public function addData()
    {
        $existingProduct = ModelsProduk::where('nama_produk', $this->namaProduk)->first();

        if ($existingProduct) {
            $existingProduct->harga = $this->harga;
            if ($this->dataEdit) {
                $existingProduct->stok = $this->stok;

            }else{
                $existingProduct->stok += $this->stok;
            }
            $existingProduct->save();
        } else {
            if ($this->dataEdit) {
                $simpan = $this->dataEdit;
            }else{
                $simpan = new ModelsProduk();
            }
            $simpan->nama_produk = $this->namaProduk;
            $simpan->harga = $this->harga;
            $simpan->stok = $this->stok;
            $simpan->save();
        }
        $this->reset();
    }
    public function render()
    {
        $datas = ModelsProduk::all();
        return view('livewire.produk', compact('datas'));
    }
}
