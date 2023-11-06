@extends('layout.pelangganLayout')
@section('container')

<style>
.tombol .btn{
  background-color: #7B551C;
  color: white;
  width:35vh;
  text-align: center;
  transition: transform 0.3s;
}

.tombol .btn:hover{
  transform: scale(1.1); 
}
</style>
@if (count($data) > 0)

<div class="container mt-3 mb-5">
    <h4>Cart</h4>
    <hr>
    <div class="keranjang">
        @foreach ($produk as $menu)
        @php
            $cartItem = $data->where('id_produk', $menu->id)->first();                
            $total = $cartItem->harga * $cartItem->jumlah;
        @endphp
                   <div class="col">
                    <div class="card checkbox-card" style="background: #9d794231; margin:2vh; border-radius:5vh;">
                        <div class="row">
                            <div class="col-2">
                                <img src="../storage/{{ $menu->foto }}" style="width:20vh;">
                            </div>
                            <div class="col-7 pt-3">
                                <div class="row"><h4>{{ $menu->name }}</h4></div>
                                <div class="row"><p>{{ $cartItem->jumlah }}</p></div>
                            </div>
                            <div class="col-2 pt-3">
                                <h5>@currency($cartItem->harga )</h5>
                            </div>
                            <div class="col-1 pt-3">
                                <input type="checkbox" name="check" id="check_{{ $cartItem->id }}" class="item-checkbox" value="{{ $cartItem->id }}">
                            </div>                                                    
                        </div>
                    </div>  
                </div>
                @endforeach
            </div>
            <hr>
            <div class ="tombol d-flex justify-content-end mb-3">
                <button class="btn" onClick="cekout()" style ="background-color:#7B551C;color:white;margin-right: 10px;">Checkout</button>
                <button class="btn" onClick="destroy()" style ="background-color:#231500ad;color:white">Delete</button>
            </div>
    <div class="order-summary d-flex justify-content-end">
        <div class="col-5">
            <div class="card p-3" style="background: #9d794231; border-radius:20px;">
                <h3 class = "mb-4">Order Sumary</h3>
                @php
                    $totalHarga=0
                @endphp
                @foreach ($produk as $menu)    
                @php
                $cartItem = $data->where('id_produk', $menu->id)->first();                
                $total = $cartItem->harga * $cartItem->jumlah;
                @endphp 
                <div class="row">
                    <div class="col">
                        <p>Name</p>
                        <p>Order Total</p>
                        <p>Price</p>
                    </div>
                    <div class="col">
                        <p>{{ $menu->name }}</p>
                        <p>{{ $cartItem->jumlah }}</p>
                        <p>@currency($cartItem->harga)</p>
                    </div>
                </div>
                @php     
                $totalHarga += $cartItem->harga * $cartItem->jumlah;
                @endphp
                @endforeach
                <hr>
                <div class="row">
                    <div class="col ">
                        <h4 class ="fw-bold">Total</h4>
                    </div>
                    <div class="col">
                        <h4 class ="fw-bold">@currency($totalHarga)</h4>
                    </div>
                </div>
                <div class="tombol row-2 d-flex justify-content-end mt-4">
                    <button class="btn checkout-button" onClick="cekotSemua()" style ="border-radius:10px;background-color:#7B551C;color:white">Place Order</button>
                </div>
            </div>
        </div>
    </div>
</div>

@else
<div class="container text-center" style="margin-top: 20vh;">
    <div class="alert" role="alert" style="border-radius: 10px;">
        <h5 class="alert-heading mb-3">Your Cart Is Empty</h5>
        <p style="font-size: 1.2rem;">Come add some items to cart and enjoy our wide range of products.</p>
        <hr>
        <p class="mb-0">Thanks for visiting our store!</p>
    </div>
</div>
{{-- <p class="container">Empty Cart</p> --}}
@endif

@endsection()






