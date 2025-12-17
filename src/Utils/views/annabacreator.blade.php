<div>   
          <div
            class="grid max-[600px]:grid-cols-1
              max-[1000px]:grid-cols-2 grid-cols-3 p-[10px] gap-[10px]">
                
                @include('annaba::inputText',
                ['field' => 'name',
                'label' => 'Nom',
                'required' =>true,
                ])
            </div>

            @include('annaba::formButtons')
</div>