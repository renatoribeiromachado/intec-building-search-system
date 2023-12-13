@extends('layouts.app_customer')

@section('content')

<div class="container-flui bg-light p-5 rounded">
    <div class='container'>
        @include('layouts.alerts.success')
        <div class='row'>
            <div class='col-md-12'>
                <div class='alert alert-info'>
                    <h3> <i class='fa fa-exclamation'></i> Pop-up</h3>
                </div>
            </div>
        </div>
        
        @foreach($popup as $data)
            <form action='{{ route('popup.update', $data->id) }}' method='post'>
                @csrf
                @method('PUT')
                <div class='row mt-3'>
                    <div class='col-md-12'>
                        <label>Titulo</label>
                        <input type='text' name='title' class='form-control' value="{{ $data->title }}">
                    </div>
                    <div class='col-md-12 mt-3'>
                        <label>Mensagem</label>
                        <textarea name='description' class='form-control' rows="5">{{ $data->description }}</textarea>
                    </div>
                    <div class='col-md-2 mt-3'>
                        <label>Status</label>
                        <select name='status' class='form-control'>
                            <option value='{{ $data->status }}'>
                                @if($data->status == 1)
                                    Habilitado
                                @elseif($data->status == 0)
                                    Desabilitado
                                @endif
                            </option>
                            <option value='1'>Habilitado</option>
                            <option value='0'>Desabilitado</option>
                        </select>
                    </div>
                </div>

                <div class='modal-footer'>
                    <button type='submit' class='btn btn-success'>Atualizar</button>
                </div>
            </form>
        @endforeach
    </div>
</div>
@endsection
