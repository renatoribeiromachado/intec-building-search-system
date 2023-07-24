@extends('layouts.app_customer')

@section('content')

    <div class="px-5 py-2 rounded" > <!-- style="border: 1px solid red;" -->
        
        <form action="{{ route('company.index') }}" method="get">

            <div class="bg-white container px-4 py-3" > <!-- style="border: 1px solid red;" -->
                <h1 class="text-center">PESQUISA DE OBRAS - Filtro</h1>

                <div class="row mb-3">
                    <div class="form-group col">
                        <label for="inputPassword4">Data Inicial</label>
                        <input
                            type="text" id="start_date" name="start_date"
                            class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                            value="{{ old('start_date', request()->start_date) }}" placeholder="ex: 10/05/2023"
                            >
                    </div>

                    <div class="form-group col">
                        <label for="inputEmail4">Data Final</label>
                        <input
                            type="text" id="trading_name" name="trading_name"
                            class="form-control {{ $errors->has('trading_name') ? 'is-invalid' : '' }}"
                            value="{{ old('trading_name', request()->trading_name) }}" placeholder="ex: 15/05/2023"
                            >
                    </div>

                    {{-- <div class="form-group col">
                        <button type="submit" class="btn btn-success btn mt-4 me-1">
                            <i class="fa fa-search"></i> Pesquisar
                        </button>

                        <a
                            href="{{ route('company.index') }}"
                            class="btn btn-warning btn mt-4"
                            title="Limpar a pesquisa"
                            >
                            <i class="fa fa-eraser"></i> Limpar
                        </a>
                    </div> --}}
                </div>
            </div>

            <hr class="my-4">

            <div class="container px-4 py-3"  > <!-- style="border: 1px solid red;" -->
                <h3 class="py-2 border-bottom">Fase 1</h3>
                @foreach($stagesOne as $stageOne)
                    <div class="form-check mb-3">
                        <input
                            type="checkbox"
                            name="phases[]"
                            value="{{ old('phases', $stageOne->id) }}"
                            class="form-check-input"
                            id="phase-one-{{ $loop->index }}"
                            >
                        <label class="form-check-label" for="phase-one-{{ $loop->index }}">
                            {{ $stageOne->description }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="container px-4 py-3"  > <!-- style="border: 1px solid red;" -->
                <h3 class="py-2 border-bottom">Fase 2</h3>
                @foreach($stagesTwo as $stageTwo)
                    <div class="form-check mb-3">
                        <input
                            type="checkbox"
                            name="phases[]"
                            value="{{ old('phases', $stageTwo->id) }}"
                            class="form-check-input"
                            id="phase-one-{{ $loop->index }}"
                            >
                        <label class="form-check-label" for="phase-one-{{ $loop->index }}">
                            {{ $stageTwo->description }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="container px-4 py-3"  > <!-- style="border: 1px solid red;" -->
                <h3 class="py-2 border-bottom">Fase 3</h3>
                @foreach($stagesThree as $stageThree)
                    <div class="form-check mb-3">
                        <input
                            type="checkbox"
                            name="phases[]"
                            value="{{ old('phases', $stageThree->id) }}"
                            class="form-check-input"
                            id="phase-one-{{ $loop->index }}"
                            >
                        <label class="form-check-label" for="phase-one-{{ $loop->index }}">
                            {{ $stageThree->description }}
                        </label>
                    </div>
                @endforeach
            </div>
        </form>
    </div>
@endsection
