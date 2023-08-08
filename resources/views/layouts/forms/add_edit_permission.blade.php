
<x-intec-input
    label-input-id="name"
    label-text="Descrição"
    input-type="text"
    input-name="name"
    class-one=""
    input-value="{{ $permission->name }}"
    :input-readonly="false"
    placeholder="ex: Ver Módulo"
/>
{{-- <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $permission->name) }}" placeholder="ex: Ver Módulo"> --}}