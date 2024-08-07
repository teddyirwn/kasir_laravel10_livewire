<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header py-3">

                    <h6 class="text-primary">Cari Berdasarkan Tanggal</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <input type="date" class="form-control" wire:model='tglAwal'>
                    </div>
                    <div class="mb-3">
                        <input type="date" class="form-control" wire:model='tglAkhir'>
                    </div>
                    <div class="mb-3">
                        <button wire:click='cari' class="btn btn-primary w-100">Cari</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="text-primary">Laporan Penjualan</h6>
                    <a href="/cetak-laporan" class="btn btn-primary">Cetak</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Penjualan</th>
                                <th>Nama Pelanggan</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporan as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->tgl_penjualan}}</td>
                                    <td>{{$item->pelanggan->namaPelanggan}}</td>
                                    <td>{{$item->total_harga}}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
