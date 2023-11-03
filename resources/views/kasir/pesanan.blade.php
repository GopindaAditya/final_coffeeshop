<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Transaction Id</th>
                <th>Menu Id</th>
                <th>Price</th>
                <th>Total</th>
                <th>Transfer Proof</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $previousPenjualanId = null; @endphp
            @foreach ($penjualanData as $data)
                @foreach ($data['detail_penjualan'] as $detail)
                    @if ($data['penjualan']->id != $previousPenjualanId)
                        <tr>
                            <td>{{ $data['customer']->name }}</td>
                            <td>{{ $data['penjualan']->id }}</td>
                            @php $previousPenjualanId = $data['penjualan']->id; @endphp
                            <td>{{ $detail->id_menu }}</td>
                            <td>{{ $detail->harga_penjualan }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td><button class="btn" style ="background-color:#7B551C;color:white" onclick="showBukti({{ $data['penjualan']->id }})">View</button></td>
                            <td><button class="btn" id="btn" onClick="confirm({{ $data['penjualan']->id }})" style ="background-color:#7B551C;color:white">Confirm</button></td>
                        </tr>
                    @else
                        <tr>
                            <td></td>
                            <td></td>
                            <td>{{ $detail->id_menu }}</td>
                            <td>{{ $detail->harga_penjualan }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td></td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>
    
</div>
