<div>
    <div class="row mt-2 bg-light border">
        <div class="col-md-12 pt-3">
            <p>
                <input
                    type="checkbox"
                    id="{{ $id }}"
                    name="{{ $inputOneName }}"
                    class="{{ $classOne }}"
                    value="1"
                    >
                <label for="{{ $id }}" class="text-uppercase">
                    <strong>{{ $labelText }}</strong> <code>* Selecione Todos</code>
                </label>
            </p>
            <hr>
        </div>

        @foreach($dataList as $item)
            <div class="col-md-4 pt-3">
                <p class="text-right">
                    <input
                        type="checkbox"
                        id="{{ "{$listInputIdFor}{$item->id}" }}"
                        name="{{ $listInputName }}"
                        class="{{ $classTwo }}"
                        value="{{ $item->id }}"
                        >
                    <label
                        for="{{ "{$listInputIdFor}{$item->id}" }}"
                        class="text-uppercase"
                        >
                        <strong>{{ $item->description }}</strong>
                    </label>
                </p>
            </div>
        @endforeach
    </div>
</div>
