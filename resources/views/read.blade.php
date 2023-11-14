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

{{-- <table class="table table-success table-striped container mt-5"> --}}
    {{-- <div class="header">
        <h4>
            Menu
        </h4>
    </div> --}}
 @if (count($data) > 0)
    <div class="row mb-3">
            @foreach ($data as $menu)
            <div class="col w-50">
                <div class="card mb-5">
                    <img src="/storage/{{ $menu->foto }}" class="card-img-top" style ="object-fit: contain">
                    {{-- <h5 class="card-title">{{ $menu->name }}<span>{{ $menu->harga }}</span><a class="btn" href="{{ url('/customer/shopping-cart/'.$menu->id) }}">+</a></h5> --}}
                    <h5 class="card-title" style ="text-align: start; padding-bottom:2vh;">
                        {{ $menu->name }}
                        <div class="row">
                            @if ($menu->stok>0)

                            <div class="col-md-8">{{ $menu->hargaP }}</div>                            
                            <div class="col-md-1">
                                <a class="btn" href="{{ url('/customer/shopping-cart/'.$menu->id) }}">+</a>
                            </div>
                            @else
                            <div class="col d-flex justify-content-center">
                                <button class="btn" disabled>Sold Out</button>
                            </div>
                            @endif
                        </div>
                        {{-- <div class="harga" style="text-align: start">{{ $menu->harga }}<a class="btn" href="{{ url('/customer/shopping-cart/'.$menu->id) }}">+</a></div> --}}
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
