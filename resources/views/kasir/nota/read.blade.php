@if (count($pen) > 0)
    <table class="table table-success table-striped container mt-5">
        <tr>
            <th>Id Transaksi</th>
            <th>Id Pelanggan</th>
            <th>Kasir</th>
            <th>Action</th>
        </tr>
        @foreach ($pen as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->id_pelanggan }}</td>
                <td>{{ $data->id_kasirs }}</td>
                <td>
                    <button class="btn btn-warning" id="btn" onClick="cetakNota({{ $data->id }})">Cetak
                        nota</button>
                </td>
            </tr>
        @endforeach
    </table>
@else
    <p class="container">nota kosong</p>
@endif
