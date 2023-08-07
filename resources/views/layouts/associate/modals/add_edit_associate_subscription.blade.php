<!--MARCAR TODAS AS REGIÕES-->
<div class="row mt-2 mb-3">
    <div class="col-md-12">
        <label class="control-label text-uppercase">
            <strong>
                <i class="fa fa-check-square-o"></i>
                Regiões do Brasil
            </strong>
            <input type="checkbox" class="regiaoGeral" />
            <code>* Selecione Todas as Regiões</code>
        </label>
    </div>
</div>

<!--NORTE-->
<x-state-checkbox-group
    id="zone-all-1"
    input-one-name="zones[0]"
    class-one="norte checkRegiaoGeral"
    label-text="Norte"
    :data-list="$statesOne"
    class-two="checkNorte checkRegiaoGeral"
    list-input-id-for="state-one-"
    list-input-name="states[]"
/>

<!--NORDESTE-->
<x-state-checkbox-group
    id="zone-all-2"
    input-one-name="zones[0]"
    class-one="nordeste checkRegiaoGeral"
    label-text="Nordeste"
    :data-list="$statesTwo"
    class-two="checkNordeste checkRegiaoGeral"
    list-input-id-for="state-two-"
    list-input-name="states[]"
/>

<!--CENTRO-OESTE-->
<x-state-checkbox-group
    id="zone-all-3"
    input-one-name="zones[0]"
    class-one="centro-oeste checkRegiaoGeral"
    label-text="Centro-Oeste"
    :data-list="$statesThree"
    class-two="checkCentroOeste checkRegiaoGeral"
    list-input-id-for="state-three-"
    list-input-name="states[]"
/>

<!--SUDESTE-->
<x-state-checkbox-group
    id="zone-all-4"
    input-one-name="zones[0]"
    class-one="sudeste checkRegiaoGeral"
    label-text="Sudeste"
    :data-list="$statesFour"
    class-two="checkSudeste checkRegiaoGeral"
    list-input-id-for="state-four-"
    list-input-name="states[]"
/>

<!--SUL-->
<x-state-checkbox-group
    id="zone-all-5"
    input-one-name="zones[0]"
    class-one="sul checkRegiaoGeral"
    label-text="Sul"
    :data-list="$statesFive"
    class-two="checkSul checkRegiaoGeral"
    list-input-id-for="state-five-"
    list-input-name="states[]"
/>

<!--SEGMENTO E ATUAÇÕES-->
<div class="row mt-4">
    <div class="col-md-12">
        <label class="control-label text-uppercase">
            <strong>
                <i class="fa fa-check-square-o"></i>
                Segmentos de Atuação
            </strong>
        </label>
    </div>
</div>

<!--INDUSTRIAL-->
<x-state-checkbox-group
    id="segment-sub-type-all-1"
    input-one-name="segment-sub-types[0]"
    class-one="industrial"
    label-text="Industrial"
    :data-list="$segmentSubTypeOne"
    class-two="Ind"
    list-input-id-for="segment-sub-type-one-"
    list-input-name="segment_sub_types[]"
/>

<!--COMERCIAL-->
<x-state-checkbox-group
    id="segment-sub-type-all-2"
    input-one-name="segment-sub-types[0]"
    class-one="comercial"
    label-text="Comercial"
    :data-list="$segmentSubTypeTwo"
    class-two="Com"
    list-input-id-for="segment-sub-type-two-"
    list-input-name="segment_sub_types[]"
/>

<!--RESIDENCIAL-->
<x-state-checkbox-group
    id="segment-sub-type-all-3"
    input-one-name="segment-sub-types[0]"
    class-one="residential"
    label-text="Residencial"
    :data-list="$segmentSubTypeThree"
    class-two="Res"
    list-input-id-for="segment-sub-type-three-"
    list-input-name="segment_sub_types[]"
/>


@push('scripts')

    <script>
        /*INDUSTRIAL*/
        const industrialCheckbox = document.querySelector('.industrial');
        const checkboxesInd = document.querySelectorAll('.Ind');
        industrialCheckbox.addEventListener('click', function() {
            const isChecked = industrialCheckbox.checked;
            checkboxesInd.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });
        
        /*COMERCIAL*/
        const commercialCheckbox = document.querySelector(".comercial");
        const comCheckboxes = document.querySelectorAll(".Com");
        commercialCheckbox.addEventListener("click", function () {
            const isChecked = commercialCheckbox.checked;
            comCheckboxes.forEach((checkbox) => {
                checkbox.checked = isChecked;
            });
        });
        
        /*RESIDENCIAL*/
        const residentialCheckbox = document.querySelector('.residential');
        const checkboxesRes = document.querySelectorAll('.Res');
        residentialCheckbox.addEventListener('click', function() {
            const isChecked = residentialCheckbox.checked;
            checkboxesRes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        /*REGIÃO GERAL*/
        const geralCheckbox = document.querySelector('.regiaoGeral');
        const checkboxesGeral = document.querySelectorAll('.checkRegiaoGeral');
        geralCheckbox.addEventListener('click', function() {
            const isChecked = geralCheckbox.checked;
            checkboxesGeral.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        /*REGIÃO NORTE*/
        const norteCheckbox = document.querySelector('.norte');
        const checkboxesNor = document.querySelectorAll('.checkNorte');
        norteCheckbox.addEventListener('click', function() {
            console.log('asdfasdfasdfa !!!!!')
            const isChecked = norteCheckbox.checked;
            checkboxesNor.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        /*REGIÃO NORDESTE*/
        const nordesteCheckbox = document.querySelector('.nordeste');
        const checkboxesNordeste = document.querySelectorAll('.checkNordeste');
        nordesteCheckbox.addEventListener('click', function() {
            const isChecked = nordesteCheckbox.checked;
            checkboxesNordeste.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        /*REGIÃO CENTRO-OESTE*/
        const centroCheckbox = document.querySelector('.centro-oeste');
        const checkboxesCen = document.querySelectorAll('.checkCentroOeste');
        centroCheckbox.addEventListener('click', function() {
            const isChecked = centroCheckbox.checked;
            checkboxesCen.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        /*REGIÃO SULDESTE*/
        const sudesteCheckbox = document.querySelector('.sudeste');
        const checkboxesSudeste = document.querySelectorAll('.checkSudeste');
        sudesteCheckbox.addEventListener('click', function() {
            const isChecked = sudesteCheckbox.checked;
            checkboxesSudeste.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        /*REGIÃO SUL*/
        const sulCheckbox = document.querySelector('.sul');
        const checkboxesSul = document.querySelectorAll('.checkSul');
        sulCheckbox.addEventListener('click', function() {
            const isChecked = sulCheckbox.checked;
            checkboxesSul.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });
    </script>

@endpush