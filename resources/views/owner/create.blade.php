<form id="inputForm">
    @csrf
    <div class="p2">
        <div class="form-group text-start">
            <label for="name" class="m-2">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="">
        </div>
        <div class="form-group text-start">
            <label for="harga">Price</label>
            <input type="text" name="harga" id="harga" class="form-control">
        </div>
        <div class="form-group text-start">
            <label for="stok">Stock</label>
            <input type="text" name="stok" id="stok" class="form-control">
        </div>
        <div class="form-group text-start">
            <label for="Kategori">Categories</label>
            <select class="form-select" aria-label="Default select example" id="kategori">
                {{-- <option selected>Pilih </option> --}}
                <option value="Baverages">Baverages</option>
                <option value="Latte">Latte</option>
                <option value="Cappucino">Cappucino</option>
                <option value="Cold Brew">Cold Brew</option>
              </select>
        </div>        
        <div class="form-group text-start">
            <label for="desc">Details</label>
            <input type="text" name="desc" id="desc" class="form-control">
        </div>        
        <div class="form-group text-start">
            <label for="foto">Photo Product</label>
            <input type="file" name="foto" id="foto" class="form-control">
        </div>        
        <div class="modal-footer form-group mt-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="addProduk()">Save</button>
        </div>
    </div>
</form>