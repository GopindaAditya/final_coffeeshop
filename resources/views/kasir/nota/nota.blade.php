@extends('layout.navbar')
@section('container')
<div class="text-center">
    <h1>Nota Penjualan</h1>
</div>
<div id="read" class="mt-3"></div>

<script>
    $(document).ready(function(){
        read()
    })
    
    function read() {
        $.get("{{ route('nota.read') }}", {}, function(data, status){            
            $("#read").html(data);
        })
    }

    function stok(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('/kasir/nota/cetak') }}/" + id,
                method: "GET", 
                data: {},
                success: function(data, status) {
                    $("#staticBackdropLabel").html("update Menu");
                    $("#page").html(data);
                    $("#staticBackdrop").modal("show");
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
</script>
@endsection