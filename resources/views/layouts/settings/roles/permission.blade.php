@extends('layouts.app_customer_create')

@section('content')

    <div class="bg-light p-5 rounded">
        <h1>PERMISSÕES DE USUÁRIOS</h1>

        @php
            $tabindex = 1
        @endphp

        <form
            id="permissionRoleForm"
            name="permissionRoleForm"
            class="form-horizontal pt-4"
            action="{!! $permissionRoleSyncRoute !!}"
            method="post"
            role="form"
            enctype="multipart/form-data"
            >
            @csrf
            @method('PUT')

            <div class="max-w-full mx-auto py-0 mb-3 lg:px-4">
                <div class="row">
                    <div class="col">
                        <h2 class="" style="font-size:40px">{{ $role->name }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col clearfix">
                        <button
                            type="submit"
                            class="btn btn-primary float-end"
                            >
                            Salvar
                        </button>
            
                        <input type="hidden" name="role" value="{{ $role->id }}">
                    </div>
                </div>
            </div>

            @php 
                $disabled = true
            @endphp

            @foreach ($permissions as $permission)
                @if (! $role->permissions->contains($permission->id))
                    @php 
                        $disabled = false
                    @endphp
                @endif
            @endforeach

            <table class="table">
                @foreach ($permissions as $permission)
                    @if ($role->permissions->contains($permission->id))

                        <tr>
                            <td class="text-center" style="width: 45px;">
                                {{ $permission->id }}
                            </td>
                            <td>
                                <label class="" for="permission[{{ $loop->iteration }}][permission_id]" style="font-weight:normal;">
                                    <input
                                        id="permission[{{ $loop->iteration }}][permission_id]"
                                        type="checkbox"
                                        name="permission[{{ $loop->iteration }}][permission_id]"
                                        value="{{ $permission->id }}" {{ $permission->selected ? 'checked="checked"' : '' }}
                                        > &nbsp; {{ $permission->name }}
                                </label>
                            </td>
                        </tr>

                    @else

                        <tr>
                            <td class="text-center" style="width: 45px;">
                                {{ $permission->id }}
                            </td>
                            <td>
                                <label class="" for="permission[{{ $loop->iteration }}][permission_id]" style="font-weight:normal;">
                                    <input
                                        id="permission[{{ $loop->iteration }}][permission_id]"
                                        type="checkbox"
                                        name="permission[{{ $loop->iteration }}][permission_id]"
                                        value="{{ $permission->id }}"
                                        > &nbsp; {{ $permission->name }}
                                </label>
                            </td>
                        </tr>

                    @endif
                @endforeach
            </table>
        </form>
    </div>
@endsection