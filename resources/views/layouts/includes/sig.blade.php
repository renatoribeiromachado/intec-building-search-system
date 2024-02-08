<div class="col-5 col-md-6 custom-div-2 mt-5 shadow">

<div class="row">
    <div class="col-md-12">
        <p><i class="fa fa-calendar icon"></i><br>
            <strong class="cd">Compromissos do dia</strong><br>
            <span style="color: #ff6b1a;"><strong>Reuniões do Dia</span></strong>
        </p>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <p><i class="fa fa-calendar"></i> {{ date('d/m/Y') }}</p>
    </div>
    <div class="col-md-6">
        <p><i class="fa fa-clock-o"></i> {{ date('H:i:s') }}</p>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <p><i class="fa fa-user"></i> <strong class="cd">{{ auth()->user()->name }}</strong></p>
    </div>
    <div class="col-md-6">
        <p><i class="fa fa-map-marker"></i> <strong class="cd">São Paulo</strong></p>
    </div>
</div>

</div>

<div class="col-5 col-md-6 custom-div-2 mt-5 shadow">

<div class="row">
    <div class="col-md-12">
        <p><i class="fa fa-calendar icon"></i><br>
            <strong class="cd">Próximo compromisso</strong><br>
            <span style="color: #ff6b1a;"><strong>Reuniões</span></strong>
        </p>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <p><i class="fa fa-calendar"></i> 11/01/2023</p>
    </div>
    <div class="col-md-6">
        <p><i class="fa fa-clock-o"></i> 10:00</p>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <p><i class="fa fa-user"></i> <strong class="cd">{{ auth()->user()->name }}</strong></p>
    </div>
    <div class="col-md-6">
        <p><i class="fa fa-map-marker"></i> <strong class="cd">São Paulo</strong></p>
    </div>
</div>

</div>