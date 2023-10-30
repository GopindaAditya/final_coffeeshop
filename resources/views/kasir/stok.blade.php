<form id="editForm">
    @csrf    
    <div class="p2">
        <div class="form-group text-start">
            <label for="name" class="m-2">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" readonly>
        </div>
        <div class="form-group text-start">
            <label for="harga" class="m-2">Harga</label>
            <input type="text" name="harga" id="harga" class="form-control" value="{{ $data->harga }}" readonly>
        </div>
        <div class="form-group text-start">
            <label for="stok">Stok</label>
            <input type="text" name="stok" id="stok" class="form-control" value="{{ $data ->stok }}">
        </div>
        <div class="form-group text-start">
            <label for="desc">Keterangan</label>
            <input type="text" name="desc" id="desc" class="form-control" value="{{ $data ->desc }}" readonly>
        </div>
        <div class="form-group text-start mt-2">
            <button type="button" class="btn btn-primary" onClick="updateStok({{ $data->id }})">Save Changes</button>
        </div>
    </div>    
</form>
