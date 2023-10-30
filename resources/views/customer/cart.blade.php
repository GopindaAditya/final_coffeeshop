<form id="addCart">
    @csrf
    <div class="p2">
        <div class="form-group text-start">
            <label for="name" class="m-2">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" disabled>
        </div>
        <div class="form-group text-start">
            <label for="harga">Price</label>
            <input type="text" name="harga" id="harga" class="form-control" value="{{ $data->harga }}" readonly data-harga="{{ $data->harga }}">
        </div>
        <div class="form-group text-start">
            <label for="stok">Stock</label>
            <input type="text" name="stok" id="stok" class="form-control" value="{{ $data->stok }}"
                disabled>
        </div>
        <div class="form-group text-start">
            <label for="jumlah">Total items</label>
            <input type="text" name="jumlah" id="jumlah" class="form-control">
        </div>
        <div class="d-flex flex-row mb-3">
            <div class="form-check mx-3">            
                <input class="form-check-input" type="radio" name="ukuran" id="small" value="small" checked>
                <label class="form-check-label" for="small">
                    small
                </label>
            </div>
            <div class="form-check ">
                <input class="form-check-input" type="radio" name="ukuran" id="medium" value="medium">
                <label class="form-check-label" for="medium">
                    medium
                </label>
            </div>
            <div class="form-check mx-3">
                <input class="form-check-input" type="radio" name="ukuran" id="large" value="large">
                <label class="form-check-label" for="large">
                    large
                </label>
            </div>
        </div>
    </div>
    <div class="form-group text-start mt-2">        
        <button type="button" class="btn btn-primary" onClick="addCart({{ $data->id }})">add cart</button>
    </div>
    </div>
</form>
<script>
    $(document).ready(function() {    
    function hitungHarga() {
        var ukuran = $("input[name='ukuran']:checked").val();
        var jumlah = $("#jumlah").val();
        var idProduk = {{ $data->id }}; 
        
        $.ajax({
            url: "/hitung-harga", 
            method: "POST",
            data: {
                ukuran: ukuran,
                jumlah: jumlah,
                idProduk: idProduk,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {                
                $("#harga").val(response.harga);
            }
        });
    }

    $("input[name='ukuran']").change(hitungHarga);
    $("#jumlah").on("input", hitungHarga);
});

</script>