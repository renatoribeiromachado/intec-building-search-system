
<div class="form-row mb-3">
    <div class="form-group col-md-12">
        <label for="phase">Fase</label>
        <select id="phase" name="phase_id" class="form-control">

            @foreach ($phases as $phase)
                @if ($loop->index == 0)
                    <option selected>-- Selecione --</option>
                @endif

                <option
                    value="{{ $phase->id }}"
                    @if (old('phase_id', $phase->id) == $stage->phase_id) selected @endif
                    {{-- {{ old('phase_id', $phase->phase_id) == $phase->id ? 'selected="selected"' : '' }} --}}
                    >
                    {{ $phase->description }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <label for="description">Descrição</label>
        <input type="text" id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" value="{{ old('description', $stage->description) }}" placeholder="ex: ALVENARIA">
    </div>
</div>