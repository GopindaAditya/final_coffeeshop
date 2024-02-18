@extends('layout.pelangganLayout')
@section('container')

<style>
    .input-group .btn{
     box-shadow: none;
      text-align: end;
    }
    
    .input-group .bi{
        transition: transform 0.3s;
    }
    
    .input-group .bi:hover{
      transform: scale(1.3); 
    }

    #profil{
        margin-top: 2vh;
    }

    @media(max-width: 475px){
        #profil{
            margin-top: 10vh;
        }
    }

</style>

<div class="container" id="profil">
    <div class="text-center">
      <h1 style ="color:#7B551C">Hello {{ $data->name }}</h1>
  </div>

    <div class="container">
        <form class="d-flex justify-content-center mb-5">
            @csrf
            <div class="card p-3 w-75" style="box-shadow: 2px 6px 10px rgba(0, 0, 0, 0.5); border-radius: 2vh;">
                <div class="pict mt-4 mb-4 d-flex justify-content-center">
                    {{-- <img src="img/profile.JPG"
                    class="rounded-circle img-fluid" style="width: 35vh;" /> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="#00000088" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                      </svg>
                    </div>
                <div class="row mb-3">
                    <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                        <div class="input-group w-75">
                            <input type="text" class="form-control" id="name" value="{{ $data->name }}" disabled>
                            <button class="btn" type="button" style ="background-color: #E9ECEF">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#7B551C" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                        <div class="input-group w-75">
                            <input type="email" class="form-control" id="email" value="{{ $data->email }}" disabled>
                            <button class="btn" type="button" style ="background-color: #E9ECEF">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#7B551C" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                        <div class="input-group w-75">
                            <textarea class="form-control" id="alamat" disabled>{{ $data->alamat }}</textarea>
                            <button class="btn" type="button" style ="background-color: #E9ECEF">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#7B551C" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                        <div class="input-group w-75">
                            <input type="text" class="form-control" id="telepon" value="{{ $data->telepon }}" disabled>
                            <button class="btn" type="button" style ="background-color: #E9ECEF">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#7B551C" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class ="d-flex justify-content-end" id="button"></div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('button').on('click', function(event) {
            event.preventDefault();

            var input = $(this).closest('div.row').find('input, textarea');

            $("#button").html(
                '<button class="btn mt-3" onclick="update()" style="background-color:#7B551C; color: white;">Save Changes</button>'
                );
            input.prop('disabled', false);
        });
    });
</script>
@endsection
