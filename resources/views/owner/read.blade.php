<div class="container">
        <div class="header">
           <h3 style="color: #9D7942;"> MENU </h3>
        </div>
        <div class="row">
        @foreach ($data as $menu)
            <div class="col">
                <div class="card mb-5" style="width: 15rem; background-color: #9d794262; border: none; border-top-right-radius: 6vh; overflow: hidden; box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.3); ">
                    <img src="../storage/{{ $menu->foto }}" class="card-img-top" alt="">
                    <div class="card-body py-3" style="background-color: #9d7942c4; color: white; padding: 5px; ">
                        <h5 class="card-title d-flex justify-content-center">{{ $menu->name }}</h5>
                        <!-- Add other card content here -->
                        <div style="text-align: center; padding-bottom: 10px">
                            <button class="btn" id="btn" onClick="edit({{ $menu->id }})" style ="width: 100px; background-color:#7B551C;color:white">
                                Edit
                            {{-- <a class="btn btn-primary" style="background-color: white; color: #9D7942; border-radius: 10px;">EDIT</a> --}}
                            </button>
                            <button class="btn" id="btn" onclick="destroy({{ $menu->id }})" style ="width:100px;background-color:#7B551C;color:white;margin-left:2vh;">
                                Delete
                            {{-- <a class="btn btn-primary" style="background-color: white; color: #9D7942; border-radius: 10px;">DELETE</a> --}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <hr>
        <div>
            <h4> Edit Stock</h4>
        </div>
        <div class="row">
        @foreach ($data as $menu)
        <div class="col-md-4 m-4">
            <div class="card" style="width: 20rem; height: 8rem; background-color: #9d7942a0;border-radius: 10px;box-shadow: 2px 7px 8px rgba(0, 0, 0, 0.5);">
                <div class="row no-gutters">
                        <div class="col-md-3">
                            <img src="../storage/{{ $menu->foto }}" class="card-img" alt="" style="width: 6rem; height: 6rem;">
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
        </div>
    </div>

