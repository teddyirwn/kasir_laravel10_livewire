<div>
    <div class="container">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-8">
                <div class="card shadow mb-4 p-3">
                    <div class="d-flex gap-2 align-items-center">
                        <h5>Transaksi</h5>
                        <button type="button" class="btn btn-info text-white" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Pilih Baraang
                        </button>

                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Sub Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>


                                @if ($cartItems != null)


                                    @foreach ($cartItems as $produk)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $produk['nama_produk'] }}</td>
                                            <td>{{ $produk['harga'] }}</td>

                                            <td>
                                                <input type="number" style="width: 70px; height: 30px;"
                                                    class="rounded border form-control" value="{{ $produk['jumlah'] }}"
                                                    readonly>
                                            </td>
                                            <td>Rp.
                                                {{ number_format($produk['harga'] * $produk['jumlah'], 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <button wire:click='hapus({{ $produk['id'] }})'
                                                    class="btn btn-danger">Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="total">Total Harga</label>
                            <input type="text" wire:model='totalBelanja' class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="pelanggan">Pelanggan</label>
                            <select wire:model='selecPelanggan' name="pelanggan" id="pelanggan" class="form-select">
                                <option value="1"> Select Pelanggan</option>
                                @foreach ($pelanggan as $item)
                                    <option value="{{ $item->id }}"> {{ $item->namaPelanggan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="total">Bayar</label>
                            <input type="text" wire:model="bayar" wire:change='calculateChange' class="form-control"
                                placeholder="Jumlah Bayar">

                        </div>

                            <div class="mb-3">
                                <label for="total">Kembalian</label>
                                <input type="text" wire:model='kembalian' class="form-control" readonly>
                            </div>

                        <div class="mb-3">
                            <button class="btn btn-primary" wire:click='bayarr'> Bayar</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($produks as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>
                                        <input wire:model="quantities.{{ $item->id }}" type="number"
                                            style="width: 70px;" class="rounded border" value="1">
                                    </td>
                                    <td>
                                        <button wire:click="addToCart({{ $item->id }})"
                                            class="btn btn-primary">Pilih</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
</div>
