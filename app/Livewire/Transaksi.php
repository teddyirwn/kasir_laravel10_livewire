<?php

namespace App\Livewire;

use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjuanlan;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Transaksi extends Component
{
    public $quantities = [];
    public $selectedProducts = [];
    public $cartItems = [];
    public $bayar;
    public $kembalian, $selecPelanggan;
    public $totalBelanja = 0;

    public function addToCart($productId)
    {
        // Mendapatkan kuantitas dari input sesuai dengan ID produk
        $quantity = $this->quantities[$productId] ?? 1;

        $product = Produk::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        if ($product->stok < $quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }

        $existingItem = null;
        if ($this->cartItems !== null) {
            foreach ($this->cartItems as &$cartProduct) {
                if ($cartProduct['id'] == $productId) {
                    $cartProduct['jumlah'] += $quantity;
                    $existingItem = $cartProduct;
                    break;
                }
            }
        }

        if (!$existingItem) {
            $item = [
                'id' => $productId,
                'nama_produk' => $product->nama_produk,
                'harga' => $product->harga,
                'stok' => $product->stok,
                'jumlah' => $quantity,
            ];

            $this->cartItems[] = $item;
        }

        $product->stok -= $quantity;
        $product->save();

        $this->quantities[$productId] = 1;

        session()->put('cart', $this->cartItems);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function hapus($productId)
    {
        // Cari produk yang akan dihapus dari keranjang
        $removedProduct = null;

        foreach ($this->cartItems as $key => $cartProduct) {
            if ($cartProduct['id'] == $productId) {
                // Simpan produk yang akan dihapus
                $removedProduct = $this->cartItems[$key];

                // Hapus produk dari keranjang
                unset($this->cartItems[$key]);

                // Mengembalikan stok ke produk di database
                $product = Produk::find($productId);
                $product->stok += $removedProduct['jumlah'];
                $product->save();

                break;
            }
        }

        // Jika produk tidak ditemukan dalam keranjang
        if (!$removedProduct) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan dalam keranjang.');
        }

        // Menyimpan perubahan keranjang ke sesi
        session()->put('cart', $this->cartItems);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function refreshTotal()
    {
        $this->totalBelanja = 0;
        if ($this->cartItems !== null) {
            foreach ($this->cartItems as $key => $cartProduct) {
                $this->totalBelanja += $cartProduct['harga'] * $cartProduct['jumlah'];
            }
        }
    }

    public function calculateChange()
    {
        if ($this->bayar != null) {
            $this->kembalian = $this->bayar - $this->totalBelanja;

            // Pastikan kembalian tidak negatif
            $this->kembalian = max(0, $this->kembalian);
            // dd($this->bayar, $this->totalBelanja, $this->kembalian);
        } else {
            // Jika $bayar null (tidak diinput), atur kembalian ke 0
            $this->kembalian = 0;
        }
    }
    public function bayarr()
    {
        if ($this->bayar < $this->totalBelanja) {
            return redirect()->back()->with('error', 'Pembayaran Kurang dari total Produk');
        }
        if ($this->selecPelanggan == null) {
            return redirect()->back()->with('error', 'Silahkan pilih pelanggan terlebih dahulu');
        }
        $this->calculateChange();

        $penjualan = new Penjuanlan();
        $penjualan->tgl_penjualan = Carbon::now()->toDateTimeString();
        $penjualan->total_harga = $this->totalBelanja;
        $penjualan->bayar = $this->bayar;
        $penjualan->kembalian = $this->kembalian;
        $penjualan->pelanggan_id = $this->selecPelanggan;
        $penjualan->save();

        $penjualanId = $penjualan->id;

        foreach ($this->cartItems as $key => $value) {
            $produkID = $value['id'];
            $harga = $value['harga'];
            $jumlah = $value['jumlah'];
            $subtotal = $value['harga'] * $value['jumlah'];

            $Dpenjualan = new DetailPenjualan();
            $Dpenjualan->penjualan_id = $penjualanId;
            $Dpenjualan->produk_id = $produkID;
            $Dpenjualan->jumlah_produk = $jumlah;
            $Dpenjualan->subtotal = $subtotal;
            $Dpenjualan->harga = $harga;
            $Dpenjualan->save();
        }
        session()->forget('cart');
         return redirect()->back()->with('success', 'Transaksi Berhasil dilakukan');
    }

    public function render()
    {
        $produks = Produk::all();
        $pelanggan = Pelanggan::all();
        $this->cartItems = session()->get('cart');
        $this->refreshTotal();
        $this->calculateChange();
        // Menghitung Kembalian belanja

        if ($this->cartItems == null) {
            $this->bayar = 0;
            $this->kembalian = 0;
        }

        return view('livewire.transaksi', compact('produks', 'pelanggan'));
    }
}
