<a class="btn btn-default" role="button" data-toggle="collapse" href="#layer" title="Atur Layer" aria-controls="terdekat"><i class="fas fa-layer-group"></i></a>

<div class="collapse" id="layer" style="font-size: 110%">

    <div class="row">

    <div class="col-md-3">
        <div class="custom-control custom-checkbox custom-control-inline">
            <input type="checkbox" class="custom-control-input" id="semua" onclick="ceklis()">
            <label class="custom-control-label" for="semua"><b style="color: #353535">Show All</b></label>
        </div>
    </div>

        <div class="col-md-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="nagari" name="layerpeta" onchange="layernagari()">
                <label class="custom-control-label" for="nagari"><b style="color: #353535">Nagari Border</b></label>
            </div>
        </div>

        <div class="col-md-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="jorong" name="layerpeta" onchange="layerjorong()">
                <label class="custom-control-label" for="jorong"><b style="color: #353535">Jorong Area</b></label>
            </div>
        </div>

        <div class="col-md-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="rumah" name="layerpeta" onchange="layerrumah()">
                <label class="custom-control-label" for="rumah"><b style="color: #353535">House Building</b></label>
            </div>
        </div>

        <div class="col-md-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="umkm" name="layerpeta" onchange="layerumkm()">
                <label class="custom-control-label" for="umkm"><b style="color: #353535">MSME Building</b></label>
            </div>
        </div>

        <div class="col-md-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="pendidikan" name="layerpeta" onchange="layerpendidikan()">
                <label class="custom-control-label" for="pendidikan"><b style="color: #353535">Educational Building</b></label>
            </div>
        </div>

        <div class="col-md-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="kantor" name="layerpeta" onchange="layerkantor()">
                <label class="custom-control-label" for="kantor"><b style="color: #353535">Office Building</b></label>
            </div>
        </div>

        <div class="col-md-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="kesehatan" name="layerpeta" onchange="layerkesehatan()">
                <label class="custom-control-label" for="kesehatan"><b style="color: #353535">Health Building</b></label>
            </div>
        </div>

        <div class="col-md-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="ibadah" name="layerpeta" onchange="layeribadah()">
                <label class="custom-control-label" for="ibadah"><b style="color: #353535">Worship Building</b></label>
            </div>
        </div>

    </div>

</div>