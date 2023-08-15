
<div class="form-row mb-3">
    <div class="form-group col-md-12">
        <label for="segment">Segmento</label>
        <select id="segment" name="segment_id" class="form-control">
            @foreach ($segments as $segment)
                @if ($loop->index == 0)
                    <option selected>-- Selecione --</option>
                @endif

                <option
                    value="{{ $segment->id }}"
                    @if (old('segment_id', $segment->id) == $segmentSubType->segment_id) selected @endif
                    >
                    {{ $segment->description }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <label for="description">Descrição</label>
        <input
            type="text"
            id="description"
            name="description"
            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
            value="{{ old('description', $segmentSubType->description) }}"
            placeholder="ex: ALVENARIA"
            >
    </div>
</div>