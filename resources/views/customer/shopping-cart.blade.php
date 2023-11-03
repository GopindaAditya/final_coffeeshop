@extends('layout.pelangganLayout')
@section('container')

<style>
  body {
    background-color: #eee;
  }
  
  .card {
    border: none;
    border-radius: 8vh;
    /* top: 5vh;  */
    padding:20px;
    text-align: center;
    position: relative;
    box-shadow: 2px 6px 10px rgba(0, 0, 0, 2);
    width: 90%; /* Menggunakan persentase untuk lebar */
    max-width: 500px; /* Batasi lebar maksimum */
    /* margin: 0 auto; Tengahkan kartu */
  }
  
  .form-group input[type="text"] {
    border: none;
    border-bottom: 1px solid transparent;
    box-shadow: none;
    outline: none;
  }
  
  .form-group label {
    text-align: center;
  }
  
  .form-group input[type="text"] {
    text-align: center;
  }
  
  @media screen and (max-width: 768px) {
    .card {
      width: 95%; /* Misalnya, mengubah lebar pada layar kecil */
    }
  }

  .body-card .btn{
  background-color: #7B551C;
  color: white;
  width: 30px;
  height: 30px;
  text-align: center;
  transition: transform 0.3s; /* Efek transisi untuk perubahan skala */
}

.form-group .btn{
  background-color: #7B551C;
  color: white;
  width:35vh;
  text-align: center;
  transition: transform 0.3s;
}

.body-card .btn:hover, .form-group .btn:hover{
  transform: scale(1.2); 
}

</style>
  
<form id="addCart">
  @csrf
<div class="container d-flex justify-content-center mt-5">
  <div class="card" style="width: 120vh; height:85vh;background-color:#b99450af">
    <section >
      <div class="container">
        <div class="row" >
          <div class="col d-flex justify-content-center" style="margin-top:10vh">
            <div class="card text-black" style ="top:15vh;">
              <div class="card-body " style="text-align: center;">
                <h4 style ="font-weight:bold">{{ $data->name }}</h4>
                <div class="form-group" style ="margin-top: -5vh;">
                  <label style ="text-align:center" for="harga"></label>
                  <input type="text" name="harga" id="harga" class="form-control" value="{{ $data->harga }}" readonly data-harga="{{ $data->harga }}">
              </div>
              </div>
              <div class="body-card">
                <div class="d-flex flex-row mb-3 justify-content-center">
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
                <div class="row">
                  <div class="col d-flex align-items-center justify-content-center">
                    <button class="btn" onClick="kurangJumlah()" >
                      <a style="display: flex; justify-content: center; align-items: center; height: 100%;">-</a>
                    </button>
                    <input type="number" placeholder="" value="1" name="jumlah" id="jumlah" class="form-control" style="border:none; width: 60px; text-align: center; line-height: 30px;font-weight:bold;margin-left:10px;" readonly>
                    <button class="btn" onClick="tambahJumlah()">
                      <a style="display: flex; justify-content: center; align-items: center; height: 100%;">+</a>
                    </button>
                  </div>
                  <div id="stok" data-stok="{{ $data->stok }}"><p class="text-muted">Stock : {{ $data->stok }}</p></div readonly>
                </div>                      
              </div>
              <div class="form-group text-center mt-1 pb-3">        
                </button>
                <button type="button" class="btn" onClick="addCart({{ $data->id }})">Add to Cart</button>
              </div>
            </div>
          </div>
            <div class="col" style="position: absolute; top: -5%; left: 25%;">
              <img src="/storage/{{ $data->foto }}" class="card-img-top" style="transform: translateX(-50%);object-fit: cover;width:50%;">
            </div>
          </div>
        </div>
      </div>
    </section>
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

function tambahJumlah() {
  event.preventDefault(); // Prevent the default button behavior
  var input = document.getElementById('jumlah');
  var currentValue = parseInt(input.value);

  // Increment the current value by 1
  input.value = currentValue + 1;
}

function kurangJumlah() {
  event.preventDefault(); // Prevent the default button behavior
  var input = document.getElementById('jumlah');
  var currentValue = parseInt(input.value);

  // Ensure the current value is greater than the minimum value (if you have a minimum)
  if (currentValue > 1) {
    input.value = currentValue - 1;
  }
}

function addCart(id) {
    var name = $("#name").val();
    var harga = $("#harga").val();
    var stok = $("#stok").data("stok"); // Mengambil stok dari atribut data
    console.log('Stok:',stok)
    var jumlah = $("#jumlah").val();

    if (parseInt(jumlah) > parseInt(stok)) {
        // Jumlah melebihi stok, tampilkan pesan kesalahan
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Out Of Stock',
        });
    } else {
        var formData = new FormData();
        formData.append('name', name);
        formData.append('harga', harga);
        formData.append('stok', stok);
        formData.append('jumlah', jumlah);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url('/customer/addCart') }}/" + id,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Added To Cart!',
                    showConfirmButton: false,
                    timer: 1500
                });
                $(".btn-close").click();
                $("#read").html(response);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                Swal.fire({
                        icon: 'error',
                        title: 'Out Of Cart',
                        showConfirmButton: false,
                        timer: 1500
                    });
            }
        });
    }
}



</script>

@endsection()