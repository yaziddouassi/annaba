<div>
     @include('annaba::wizardTop')

        <div id="conteneur"
        class="grid max-[600px]:grid-cols-1
          max-[1000px]:grid-cols-2 grid-cols-3 p-[10px] gap-[10px]">

          @if ($wizardCount == 1)
           @include('annaba::inputText',
             ['field' => 'name',
              'label' => 'Name',
              'required' =>true,
            ])
        @endif
        
        @if ($wizardCount == 2) 
         
        @include('annaba::inputText',
        ['field' => 'prenom',
        'label' => 'Prenom',
        'required' =>true])
       @endif
        </div>

        @include('annaba::wizardUpdateButtons')
</div>
