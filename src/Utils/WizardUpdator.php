<?php

namespace Annaba\Annaba\Utils;
use Illuminate\Support\Str;

class WizardUpdator
{

    public $piece1;
    public $piece2;

    public function getContenu($a,$b,$c,$d,$e) {
   
     $this->piece1 ="<?php

namespace App\Livewire\Annaba;

use Livewire\Component;

use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Js;
use Annaba\Annaba\Livewire\WizardUpdate;

class $e extends WizardUpdate
{
  
    use WithFileUploads;
 
    public \$annabaUrlStorage ;
    public \$annabaModel = \"$a\";
    public \$annabaModelName =  \"$b\";
    public \$annabaModelClass = \"$c\";
    public \$annabaSuivantLabel = 'Suivant';
    public \$annabaPrecedentLabel = 'Precedent';
    public \$annabaBtnModifierLabel = 'Modifier';
    
    public \$annabaRecord = null;
    public \$annabaNullables = [];
    public \$annabaFields = ['name' => null,'prenom' => null];
    public \$annabaPasswords = [];
    public \$annabaMultiples = [];
    public \$annabaFiles =  [];
    public \$annabaMultipleFiles = [];
    public \$wizardStops =  []; 

    public function mount(\$id) {

        \$this->annabaUrlStorage =  config('annaba.urlstorage');
        \$this->annabaInit(\$id); 
        \$this->wizardInit(2,['First','Second']);

    }


    public function wizardValidation(\$a) {

        if (\$a == 1) {
            \$validated = \$this->validate([ 
                'annabaFields.name' => ['required'],
            ],[],
            \$this->annabaRename());

            \$this->checkIfMultipleFileIsNotNull([]);
        }

        if (\$a == 2) {
            \$validated = \$this->validate([ 
                'annabaFields.prenom' => ['required'],
            ],[],
            \$this->annabaRename());

            \$this->checkIfMultipleFileIsNotNull([]);
        }

    }


    public function annabaUpdate()
    {

    \$this->annabaChanger();

    \$this->annabaRecord->save() ;
    \$this->js(\"const notyf = new Notyf({ position: {x: 'right',y: 'top'}});
        notyf.success('Record updated');\"); 
    }

    public function wizardUpdate() {
        \$this->annabaUpdate();
    }

    public function render()
    {
        return view('$d');
    }
} ";

    return $this->piece1 ;

    }


    public function getView() {

    $this->piece2 ="<div>
            @include('annaba::wizardTop')

            <div 
            class=\"grid max-[600px]:grid-cols-1
              max-[1000px]:grid-cols-2 grid-cols-3 p-[10px] gap-[10px]\">
                
                @if (\$wizardCount == 1)
                    @include('annaba::inputText',
                    ['field' => 'name',
                    'label' => 'Name',
                    'required' =>true,
                     ])
                @endif
        
                @if (\$wizardCount == 2) 
                   @include('annaba::inputText',
                   ['field' => 'prenom',
                  'label' => 'Prenom',
                  'required' =>true])
                @endif
            
            </div>

            @include('annaba::wizardUpdateButtons')
 </div>
";
    return $this->piece2 ;
}


}