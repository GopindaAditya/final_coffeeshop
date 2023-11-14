{{-- <table class="table table-success table-striped container mt-5">
    <tr>
        <th>Nama</th>
        <th>Desc</th>
        <th>Harga</th>
        <th>Stok</th>        
    </tr>
    @foreach ($data as $menu)
        <tr>
            <td>{{ $menu->name }}</td>
            <td>{{ $menu->desc }}</td>
            <td>{{ $menu->harga }}</td>
            <td><button class="btn btn-primary btn-sm" id="btn" onClick="minStok({{ $menu->id }})">-</button>
                {{ $menu->stok }}
                <button class="btn btn-primary btn-sm" id="btn" onClick="addStok({{ $menu->id }})">+</button></td>            
            <td>            
        </tr>
    @endforeach
</table> --}}
<div class="header">
    <h3 style="color: #9D7942;">Update Stock</h3>
</div>
@if (count($data) > 0)
<div class="row">
    @foreach ($data as $menu)
    <div class="col-md-4 m-4">
        <div class="card" style="width: 20rem; height: 8rem; background-color: #9d7942a0;border-radius: 10px;box-shadow: 2px 7px 8px rgba(0, 0, 0, 0.5);">
            <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="../storage/{{ $menu->foto }}" class="card-img" alt="" style="width: 7rem;">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h4 style="font-size:24px;font-weight:bold;color:#FFF;">{{ $menu->name }}</h4>
                            <!-- Add buttons here -->
                            <div style="border: none; padding: 10px; display: inline-block; border-radius: 5px; color: white; text-align: center;">
                                <button class="btn" onClick="minStok({{ $menu->id }})" style="background-color: #7B551C; color: white; width: 30px; height: 30px; vertical-align: middle;">
                                    <a style="display: flex; justify-content: center; align-items: center; height: 100%;">-</a>
                                </button>
                                {{ $menu->stok }}
                                <button class="btn" onClick="addStok({{ $menu->id }})" style="background-color: #7B551C; color: white; width: 30px; height: 30px; vertical-align: middle;">
                                    <a style="display: flex; justify-content: center; align-items: center; height: 100%;">+</a>
                                </button>
                            </div>                         
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @endforeach

    @else
<div class="container text-center">
    <div class="alert" role="alert" style="border-radius: 10px;">
        <h3 class="alert-heading mb-3">The Searched Menu Is Not Available</h3>
        <hr>
        <p style="font-size: 1.2rem;">Try To Find Another Menu</p>
    </div>
</div>
@endif
    </div>

