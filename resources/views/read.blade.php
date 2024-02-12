@extends('layout.pelangganLayout')
@section('container')

<style>
.card-title {
    display: flex;
    flex-direction: column;
}

.harga {
    margin-top: 5px; /* Sesuaikan dengan jarak yang diinginkan */
}

.btn{
    transition: transform 0.3s;
}

.btn:hover{
    transform: scale(1.2);
}
</style>

 @if (count($data) > 0)
    <div class="row mb-3">
            @foreach ($data as $menu)
            <div class="col" id="kolmenu">
                <div class="card mb-5">
                    <img src="/storage/{{ $menu->foto }}" class="card-img-top" style ="object-fit:contain">
                    <h5 class="card-title" style ="text-align: start; padding-bottom:2vh;">
                        <div class="row">
                            @if ($menu->stok>0)
                            <div class="col-md-8">
                                {{ $menu->name }}
                                <br>
                            {{ $menu->hargaP }}                            
                            </div>
                            <div class="col-md-2">
                                {{-- <span style="display: flex; justify-content:end"> --}}
                                    <a class="btn" href="{{ url('/customer/shopping-cart/'.$menu->id) }}">+</a>
                                {{-- </span> --}}
                            </div>   
                                                  
                            @else
                            <div class="col d-flex justify-content-center">
                                <button class="btn" disabled>Sold Out</button>
                            </div>
                            @endif
                        </div>
                    </h5> 
                </div>
            </div>
            @endforeach
        </div>
{{-- </table> --}}

@else
<div class="container text-center">
    <div class="alert" role="alert" style="border-radius: 10px;">
        <h3 class="alert-heading mb-3">The Searched Menu Is Not Available</h3>
        <hr>
        <p style="font-size: 1.2rem;">Try To Find Another Menu</p>
    </div>
</div>
@endif
@endsection
