<?php

namespace App\Livewire;

use App\Models\Penjuanlan;
use Livewire\Component;

class Laporan extends Component
{
    public $tglAwal, $tglAkhir;
    public function render()
    {
        $laporan = Penjuanlan::with('pelanggan')->orderBy('tgl_penjualan', 'desc')->get();

        if ($this->tglAwal && $this->tglAkhir !== null) {
            $laporan = Penjuanlan::with('pelanggan')
                ->whereBetween('tgl_penjualan', [$this->tglAwal, $this->tglAkhir])
                ->orderBy('tgl_penjualan', 'desc')
                ->get();
        }

        session()->put('dataToPrint', $laporan);
        return view('livewire.laporan', compact('laporan'));
    }
    public function cari()
    {
        // dd($this->tglAwal, $this->tglAkhir);
        $this->render();
    }
}
