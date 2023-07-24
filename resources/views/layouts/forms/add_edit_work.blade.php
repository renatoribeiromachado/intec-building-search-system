@include('layouts.alerts.all-errors')

<div class="form-row">
    <div class="form-group col-md-4 mb-2">
        <label for="old_code">Código Antigo</label>
        <input type="text" id="old_code" name="old_code" class="form-control {{ $errors->has('old_code') ? 'is-invalid' : '' }}" value="{{ old('old_code', $work->old_code) }}" placeholder="ex: EC001403">
    </div>
    
    <div class="form-group col-md-4 mb-2">
        <label for="inputPassword4">Revisado em</label>
        <input type="text" id="last_review" name="last_review" class="form-control date {{ $errors->has('last_review') ? 'is-invalid' : '' }}" value="{{ old('last_review', optional($work->last_review)->format('d/m/Y')) }}" placeholder="ex: 03/02/2023">
    </div>
</div>
    
<div class="form-row">
    <div class="form-group col-md-3 mb-2">
        <label for="inputPassword4">Projeto</label>
        <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', $work->name) }}" placeholder="ex: PCH PALMAS">
    </div>
    
    <div class="form-group col-md-3 mb-2">
        <label for="inputPassword4">Valor (informar em centavos)</label>
        <input type="text" id="price" name="price" class="form-control money {{ $errors->has('price') ? 'is-invalid' : '' }}" value="{{ old('price', $work->price) }}" placeholder="ex: 5000000">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-2 mb-2">
        <label for="inputZip">CEP</label>
        <input type="text" id="zip_code" name="zip_code" class="form-control cep" value="{{ old('zip_code', $work->zip_code) }}" placeholder="ex: 14200-000">
    </div>

    <div class="form-group col-md-5 mb-2">
        <label for="inputAddress">Endereço</label>
        <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $work->address) }}" placeholder="ex: Rua Nove de Julho">
    </div>

    <div class="form-group col-md-2 mb-2">
        <label for="inputAddress2">Número</label>
        <input type="text" id="number" name="number" class="form-control" value="{{ old('number', $work->number) }}" placeholder="ex: 302">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4 mb-2">
        <label for="complement">Bairro</label>
        <input type="text" id="district" name="district" class="form-control" value="{{ old('district', $work->district) }}" placeholder="ex: Jd. Primavera">
    </div>

    <div class="form-group col-md-4 mb-2">
        <label for="inputCity">Cidade</label>
        <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $work->city) }}" placeholder="ex: Ribeirão Preto">
    </div>

    <div class="form-group col-md-2 mb-2">
        <label for="state">Estado</label>
        <select id="state" name="state" class="form-control">
        <option selected>-- Selecione --</option>
            <option value="AC" {{ old('state', $work->state) == 'AC' ? 'selected="selected"' : '' }}>AC</option>
            <option value="AP" {{ old('state', $work->state) == 'AP' ? 'selected="selected"' : '' }}>AP</option>
            <option value="AM" {{ old('state', $work->state) == 'AM' ? 'selected="selected"' : '' }}>AM</option>
            <option value="BA" {{ old('state', $work->state) == 'BA' ? 'selected="selected"' : '' }}>BA</option>
            <option value="CE" {{ old('state', $work->state) == 'CE' ? 'selected="selected"' : '' }}>CE</option>
            <option value="DF" {{ old('state', $work->state) == 'DF' ? 'selected="selected"' : '' }}>DF</option>
            <option value="ES" {{ old('state', $work->state) == 'ES' ? 'selected="selected"' : '' }}>ES</option>
            <option value="GO" {{ old('state', $work->state) == 'GO' ? 'selected="selected"' : '' }}>GO</option>
            <option value="MA" {{ old('state', $work->state) == 'MA' ? 'selected="selected"' : '' }}>MA</option>
            <option value="MT" {{ old('state', $work->state) == 'MT' ? 'selected="selected"' : '' }}>MT</option>
            <option value="MS" {{ old('state', $work->state) == 'MS' ? 'selected="selected"' : '' }}>MS</option>
            <option value="MG" {{ old('state', $work->state) == 'MG' ? 'selected="selected"' : '' }}>MG</option>
            <option value="PA" {{ old('state', $work->state) == 'PA' ? 'selected="selected"' : '' }}>PA</option>
            <option value="PB" {{ old('state', $work->state) == 'PB' ? 'selected="selected"' : '' }}>PB</option>
            <option value="PR" {{ old('state', $work->state) == 'PR' ? 'selected="selected"' : '' }}>PR</option>
            <option value="PE" {{ old('state', $work->state) == 'PE' ? 'selected="selected"' : '' }}>PE</option>
            <option value="PI" {{ old('state', $work->state) == 'PI' ? 'selected="selected"' : '' }}>PI</option>
            <option value="RJ" {{ old('state', $work->state) == 'RJ' ? 'selected="selected"' : '' }}>RJ</option>
            <option value="RN" {{ old('state', $work->state) == 'RN' ? 'selected="selected"' : '' }}>RN</option>
            <option value="RS" {{ old('state', $work->state) == 'RS' ? 'selected="selected"' : '' }}>RS</option>
            <option value="RO" {{ old('state', $work->state) == 'RO' ? 'selected="selected"' : '' }}>RO</option>
            <option value="RR" {{ old('state', $work->state) == 'RR' ? 'selected="selected"' : '' }}>RR</option>
            <option value="SC" {{ old('state', $work->state) == 'SC' ? 'selected="selected"' : '' }}>SC</option>
            <option value="SE" {{ old('state', $work->state) == 'SE' ? 'selected="selected"' : '' }}>SE</option>
            <option value="SP" {{ old('state', $work->state) == 'SP' ? 'selected="selected"' : '' }}>SP</option>
            <option value="TO" {{ old('state', $work->state) == 'TO' ? 'selected="selected"' : '' }}>TO</option>
            <option value="AL" {{ old('state', $work->state) == 'AL' ? 'selected="selected"' : '' }}>AL</option>
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-3 mb-2">
        <label for="segment">Segmento de Atuação</label>
        <select id="segment" name="segment_id" class="form-control">
            @foreach ($segments as $segment)
                @if ($loop->index == 0)
                    <option selected>-- Selecione --</option>
                @endif

                <option
                    value="{{ $segment->id }}"
                    @if (old('segment_id', $work->segment_id) == $segment->id) selected @endif
                    >
                    {{ $segment->description }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-3 mb-2">
        <label for="segment_sub_type">Subtipo</label>
        <select id="segment_sub_type" name="segment_sub_type_id" class="form-control">
            @forelse ($segmentSubTypes as $segmentSubType)
                @if ($loop->index == 0)
                    <option value="" selected>-- Selecione primeiro o segmento --</option>
                @endif

                <option
                    value="{{ $segmentSubType->id }}"
                    @if (old('segment_sub_type_id', $work->segment_sub_type_id) == $segmentSubType->id) selected @endif
                    >
                    {{ $segmentSubType->description }}
                </option>
                
                @empty
                <option value="" selected>-- Selecione primeiro o segmento --</option>

            @endforelse
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-3 mb-2">
        <label for="phase">Fase</label>
        <select id="phase" name="phase_id" class="form-control">
            @foreach ($phases as $phase)
                @if ($loop->index == 0)
                    <option selected>-- Selecione --</option>
                @endif

                <option
                    value="{{ $phase->id }}"
                    @if (old('phase_id', $work->phase_id) == $phase->id) selected @endif
                    >
                    {{ $phase->description }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-3 mb-2">
        <label for="stage">Estágio</label>
        <select id="stage" name="stage_id" class="form-control">
            @forelse ($stages as $stage)
                @if ($loop->index == 0)
                    <option value="" selected>-- Selecione primeiro a fase --</option>
                @endif

                <option
                    value="{{ $stage->id }}"
                    @if (old('stage_id', $work->stage_id) == $stage->id) selected @endif
                    >
                    {{ $stage->description }}
                </option>
                
                @empty
                <option value="" selected>-- Selecione primeiro a fase --</option>

            @endforelse
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4 mb-2">
        <label for="started_at">Início da Obra</label>
        <input type="text" id="started_at" name="started_at" class="form-control date {{ $errors->has('started_at') ? 'is-invalid' : '' }}" value="{{ old('started_at', optional($work->started_at)->format('d/m/Y')) }}" placeholder="ex: 03/02/2023">
    </div>
    
    <div class="form-group col-md-4 mb-2">
        <label for="ends_at">Término da Obra</label>
        <input type="text" id="ends_at" name="ends_at" class="form-control date {{ $errors->has('ends_at') ? 'is-invalid' : '' }}" value="{{ old('ends_at', optional($work->ends_at)->format('d/m/Y')) }}" placeholder="ex: 03/04/2023">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12 mb-2">
        <label for="notes">Descrições Complementares</label>
        <textarea type="text" id="notes" name="notes" class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" rows="5" placeholder="ex: Esta obra foi tratada no particular com...">{{ old('notes', $work->notes) }}</textarea>
    </div>
</div>