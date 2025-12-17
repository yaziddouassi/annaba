<?php

namespace Annaba\Annaba\Utils;
use Illuminate\Support\Str;

class CrudCreator
{

    public $piece1;
    public $piece2;

    public function getContenu($a,$b,$c,$d,$e) {
   
     $this->piece1 ="<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Js;
use Annaba\Annaba\Livewire\AnnabaCreator;

class $e extends AnnabaCreator
{
  
    use WithFileUploads;
 
    public \$annabaUrlStorage ;
    public \$annabaModel = \"$a\";
    public \$annabaModelName =  \"$b\";
    public \$annabaModelClass = \"$c\";
    
    public \$annabaNullables = [];
    public \$annabaRecord = null;
    public \$annabaFields = ['name' => null];
    public \$annabaPasswords = [];
    public \$annabaMultiples = [];
    public \$annabaFiles =  [];
    public \$annabaMultipleFiles = [];

    public function mount() {
        \$this->annabaUrlStorage =  config('annaba.urlstorage');
    }

    public function annabaCreate() {
        \$this->annabaCreateOther();
    }

    public function annabaCreateOther() {
       
        \$validated = \$this->validate([ 
            'annabaFields.name' => ['required'],
        ],[], 
        \$this->annabaRename()
    );

    
        \$this->annabaInsert();
        \$this->annabaRecord->save() ;
        \$this->annabaReset();
        \$this->js(\"const notyf = new Notyf({ position: {x: 'right',y: 'top'}});
        notyf.success('Record created');\"); 
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
            <div 
            class=\"grid max-[600px]:grid-cols-1
              max-[1000px]:grid-cols-2 grid-cols-3 p-[10px] gap-[10px]\">
                
                @include('annaba::inputText',
                ['field' => 'name',
                'label' => 'Nom',
                'required' =>true,
                ])
            
            </div>

            @include('annaba::formButtons')
 </div>
";
    return $this->piece2 ;
}



}