<x-app-layout>

    <nav aria-label="breadcrumb" class="pt-4">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
			<li class="breadcrumb-item active" aria-current="page">Configurações Globais</li>
		</ol>
	</nav>

    <h2 class="font-semibold text-xl text-gray-800 leading-tight my-4 ml-4" style="font-size:2rem;color:#13528C;">
        {{ __("Proprietário da Aplicação") }}
    </h2>

    <div class="bg-white sm:rounded-lg max-w-full mx-auto px-4 py-4 lg:px-8 shadow-md">
        <form action="{{ route('update.project.owner', $company->uuid) }}" method="POST" role="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">
                {{-- <div class="col-lg-2">
                    <div class="form-group {{ $errors->has('company_image') ? 'has-error' : '' }} text-center">
            
                        <img src="{{ $company->image_public_link }}" class="rounded img-fluid mx-auto" alt="Logotipo ou outra imagem que identifique a marca da empresa" height="200">
                        <br>
                        <input type="file" class="form-control-file form-control-sm mx-auto" name="company_image" style="max-width:250px;">
            
                        @if($errors->has('company_image'))
                        <span class="form-text">
                            {!! $errors->first('company_image') !!}
                        </span>
                        @endif
                    </div>
                </div> --}}

                <div class="col-lg-12">
                    @include('layouts/forms/add_edit_settings')
                </div>
            </div>
            
            @can('editar-unidade')
                <div class="text-right">
                    <x-jet-button>
                        {{ __('Salvar') }}
                    </x-jet-button>
                </div>
            @endcan
        </form>
    </div>

    @push('scripts')

      <script src="{{ asset('vendor/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script>
      <script>
        $(document).ready(function () {
          // jquery mask
          $('.creci').mask('00000');
          $('.cep').mask('00000-000');
          $('.cnpj').mask('00.000.000/0000-00', {reverse: false});

          var SPMaskBehavior = function (val) {
          return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
          },
          spOptions = {
          onKeyPress: function(val, e, field, options) {
              field.mask(SPMaskBehavior.apply({}, arguments), options);
              }
          };
      
          $('.phone').mask(SPMaskBehavior, spOptions);
          // end jquery mask
        })       
      </script>

    @endpush

</x-app-layout>