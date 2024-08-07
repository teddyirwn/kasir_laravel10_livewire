<div>
    <div class="container">
        <div class="card">
            <div class="p-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProduk">
                    <i class="fas fa-plus"></i>
                </button>

            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($datas as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                        wire:click='edit("{{ $item->id }}")' data-bs-target="#addProduk">
                                        <i class="fas fa-solid fa-pen" style="color: #ffffff;"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete">
                                        <i class="fas fa-solid fa-trash" style="color: #ffffff;"></i> </a> </button>

                                </td>
                            </tr>
                            <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Produk</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="bg-warning p-3 rounded">Yakin Ingin Manghapus Produk ini</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                                wire:click='hapus("{{ $item->id }}")'>Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </tbody>
                </table>

                <div class="modal fade" id="addProduk" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="nm">Nama Produk</label>
                                    <input type="text" id="nm" name="nama_produk" class="form-control"
                                        wire:model='namaProduk'>
                                </div>
                                <div class="mb-3">
                                    <label for="harga">Harga</label>
                                    <input type="text" id="harga" name="harga" class="form-control"
                                        wire:model='harga'>
                                </div>
                                <div class="mb-3">
                                    <label for="stok">Stok</label>
                                    <input type="text" id="stok" name="stok" class="form-control"
                                        wire:model='stok'>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"
                                    wire:click='addData'>Save</button>
                            </div>

                        </div>
                    </div>
                </div>



            </div>


        </div>
    </div>
</div>
