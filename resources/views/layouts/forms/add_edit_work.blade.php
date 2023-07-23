<div class="form-row">
    <div class="form-group col-md-4 mb-2">
        <label for="old_code">Código Antigo</label>
        <input type="text" id="old_code" name="old_code" class="form-control {{ $errors->has('old_code') ? 'is-invalid' : '' }}" value="{{ old('old_code', $work->old_code) }}" placeholder="ex: EC001403">
    </div>

    {{-- <div class="form-group col-md-4 mb-2">
        <label for="inputEmail4">Nome Fantasia</label>
        <input type="text" id="trading_name" name="trading_name" class="form-control {{ $errors->has('trading_name') ? 'is-invalid' : '' }}" value="{{ old('trading_name', $work->trading_name) }}" placeholder="ex: Minha Empresa">
    </div> --}}
    
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
