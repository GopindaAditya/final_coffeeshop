<form id="inputForm">
    @csrf
        <div class="form-group text-center">
            @if (!$data->bukti_tf)
                <label for="">Belum Melakukan Pembayaran</label>
            @endif
            <img src="../storage/{{ $data->bukti_tf }}" alt="" style=" width: 10rem; height: 15rem;">                        
        </div>        
        <div class="modal-footer form-group mt-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>            
        </div>
    </div>
</form>