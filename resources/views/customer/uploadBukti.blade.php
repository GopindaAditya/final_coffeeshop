<form id="inputForm">
    @csrf
        <div class="form-group text-start mb-4">
            <label for="foto"></label>
            <input type="file" name="foto" id="foto" class="form-control">
        </div>        
        <div class="modal-footer form-group mt-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="uploadBukti()">Save</button>
        </div>
    </div>
</form>