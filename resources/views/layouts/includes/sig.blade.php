<div class="col-5 col-md-6 custom-div-2 mt-5 shadow">

<div class="row">
    <div class="col-md-12">
        <p><i class="fa fa-calendar icon"></i><br>
            <a href="#" class="btn btn-outline-link me-1 edit-btn" data-bs-toggle="modal" 
                data-bs-target="#compromissoDia"><strong class="cd">Compromissos do dia</strong></a><br>
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

<!-- Compromisso dia -->
<div class="modal fade" id="compromissoDia" tabindex="-1" role="dialog" aria-labelledby="formCreated">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #ff6b1a">
                <h5 class="modal-title text-white" id="formUpdate">Compromissos do dia (Obra(s) e Empresa(s))</h5>
            </div>
            <div class="modal-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Relator</th>
                            <th>Agendado</th>
                            <th>SiG</th>
                            <th>Cód Obra / Nome da Empresa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            use Illuminate\Support\Facades\Auth;
                            use App\Models\Sig;

                            $user = Auth::user();
                            $sigsToday = Sig::where('user_id', $user->id)
                                            ->whereDate('appointment_date', now()->toDateString())
                                            ->get();
                        @endphp

                        @foreach($sigsToday as $sigToday)
                            <tr>
                                <td>{{ $sigToday->user->name }}</td>
                                <td>{{ date('d/m/Y', strtotime($sigToday->appointment_date)) }}</td>
                                <td>{{ $sigToday->status }}</td>
                                <td>
                                    <?php if(isset($sigToday->work->old_code)): ?>
                                        {{ $sigToday->work->old_code }}
                                    <?php else: ?>
                                        Obra excluída do sistema
                                    <?php endif; ?>
                                </td>
                            </tr>
                        @endforeach

                        @php
                            use App\Models\SigCompany;
                            $sigsCompanyToday = SigCompany::where('user_id', $user->id)
                                   ->whereDate('appointment_date', now()->toDateString())
                                   ->get();
                        @endphp

                        @foreach($sigsCompanyToday as $sigCompanyToday)
                            <tr>
                                <td>{{ $sigCompanyToday->user->name }}</td>
                                <td>{{ date('d/m/Y', strtotime($sigCompanyToday->appointment_date)) }}</td>
                                <td>{{ $sigCompanyToday->status }}</td>
                                <td>
                                    <?php if(isset($sigCompanyToday->company->trading_name)): ?>
                                        {{ $sigCompanyToday->company->trading_name }}
                                    <?php else: ?>
                                        Empresa excluída do sistema
                                    <?php endif; ?>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table> 

            </div>
        </div>
    </div>
</div>

<div class="col-5 col-md-6 custom-div-2 mt-5 shadow">

<div class="row">
    <div class="col-md-12">
        <p><i class="fa fa-calendar icon"></i><br>
            <a href="#" class="btn btn-outline-link me-1 edit-btn" data-bs-toggle="modal" 
                data-bs-target="#proximoCompromisso"><strong class="cd">Próximo compromisso</strong></a><br>
                <span style="color: #ff6b1a;"><strong>Reuniões</span></strong>
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

<!-- Proximos Compromissos -->
<div class="modal fade" id="proximoCompromisso" tabindex="-1" role="dialog" aria-labelledby="formCreated">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #ff6b1a">
                <h5 class="modal-title text-white" id="formUpdate">Próximos Compromissos (Obra(s) e Empresa(s))</h5>
            </div>
            <div class="modal-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Relator</th>
                            <th>Agendado</th>
                            <th>SiG</th>
                            <th>Cód Obra / Nome da Empresa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $user = Auth::user();
                            $sigsNext = Sig::where('user_id', $user->id)
                                            ->whereDate('appointment_date', '!=', now()->toDateString())
                                            ->get();
                        @endphp

                        @foreach($sigsNext as $sigNext)
                            <tr>
                                <td>{{ $sigNext->user->name }}</td>
                                <td>{{ date('d/m/Y', strtotime($sigNext->appointment_date)) }}</td>
                                <td>{{ $sigNext->status }}</td>
                                <td> 
                                    <?php if(isset($sigNext->work->old_code)): ?>
                                        {{ $sigNext->work->old_code }}
                                    <?php else: ?>
                                        Obra excluída do sistema
                                    <?php endif; ?>
                                </td>
                            </tr>
                        @endforeach

                        @php
                            $sigsCompanyNext = SigCompany::where('user_id', $user->id)
                                    ->whereDate('appointment_date', '!=', now()->toDateString())
                                    ->get();
                        @endphp

                        @foreach($sigsCompanyNext as $sigCompanyNext)
                            <tr>
                                <td>{{ $sigCompanyNext->user->name }}</td>
                                <td>{{ date('d/m/Y', strtotime($sigCompanyNext->appointment_date)) }}</td>
                                <td>{{ $sigCompanyNext->status }}</td>
                                <td>
                                    <?php if(isset($sigCompanyNext->company->trading_name)): ?>
                                        {{ $sigCompanyNext->company->trading_name }}
                                    <?php else: ?>
                                        Empresa excluída do sistema
                                    <?php endif; ?>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table> 

            </div>
        </div>
    </div>
</div>