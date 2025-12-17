<?php

namespace Annaba\Annaba\Livewire;

header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class WizardCreator extends Component
{
    
    public $wizardCount = 1;
    public $wizardSteps = 0 ;
    public $wizardLabels = array() ;

    
    public function annabaReset()
    {
        foreach ($this->annabaFields as $key => $value) {
            $this->annabaFields[$key] = null ;
         }

         foreach ($this->annabaPasswords as $key => $value) {
            $this->annabaPasswords[$key] = null ;
         }

        foreach ($this->annabaMultiples as $key => $value) {
            $this->annabaMultiples[$key] = [] ;
         }

         foreach ($this->annabaMultipleFiles as $key => $value) {
            $this->annabaMultipleFiles[$key] = [] ;
         }

         foreach ($this->annabaFiles as $key => $value) {
            $this->annabaFiles[$key] = null ;
         }
    }



    public function wizardInit($steps,$labels)
    {
        $this->wizardSteps = $steps;
       
        foreach ($labels as $key => $value) {
            $this->wizardLabels[$key + 1] = $value;
        }
    }

 
    public function conteneurWizardBack()
    {
        $this->wizardCount = $this->wizardCount - 1 ;
    }


    public function conteneurWizardNext()
    {
        $this->wizardValidation($this->wizardCount);
        $this->wizardCount = $this->wizardCount + 1 ;
    }

    
    public function conteneurWizardCreate()
    {
        
        $this->wizardValidation($this->wizardCount);
        $this->wizardCreate();
        $this->wizardCount = 1 ;
    }
    
    public function conteneurWizardCreateOther()
    {
        
        $this->wizardValidation($this->wizardCount);
        $this->wizardCreateOther();
        $this->wizardCount = 1 ;
    }

    
    public function annabaInsert()
    {
        $this->annabaRecord = new $this->annabaModelClass;

       foreach ($this->annabaFields as $key => $value) {
           if (in_array($key,$this->annabaRecord->getFillable())) {
              $this->annabaRecord[$key] = $value ;
            }
       }

       foreach ($this->annabaPasswords as $key => $value) {
        if (in_array($key,$this->annabaRecord->getFillable())) {
           $this->annabaRecord[$key] = Hash::make($value) ;
         }
     }

       foreach ($this->annabaMultiples as $key => $value) {
        if (in_array($key,$this->annabaRecord->getFillable())) {
           $this->annabaRecord[$key] = $value ;
         }
       }
      
       $now = now();
       $this->annabaRecord['created_at'] = $now;
       $this->annabaRecord['updated_at'] = $now;

       $this->annabaUpload();
      
    }


    public function annabaUpload()
    {
     $randomString = Str::random(10);
     $randomString;
     
     foreach ($this->annabaFiles as $key => $value) {
      
      if($this->annabaFiles[$key] != null) {
      $ext = $this->annabaFiles[$key]->getClientOriginalName();
      $name1 = time(). '-'. $randomString .'-'.$ext;
      $folder = $this->annabaModel . '/'  .$key ;
      $name2 = $folder. '/' . $name1;
      $this->annabaFiles[$key]->storeAs($folder,$name1, 'public');
      $this->annabaRecord[$key] =  $name2;
        }

     }


     foreach ($this->annabaMultipleFiles as $cle => $item) {
         
        $temp = [] ;
        foreach ($item as $key => $value) {
          $ext = $value->getClientOriginalName();
          $name1 = time(). '-'. $randomString .'-'.$ext;
          $folder = $this->annabaModel . '/'  .$cle  ;
          $name2 = $folder. '/' . $name1;
          $value->storeAs($folder,$name1, 'public');
          array_push($temp, $name2);
        }

        $this->annabaRecord[$cle] =  $temp;  

       }


 }


 public function annabaRename() {
    $tabValidation = [];

    // Loop through annabaFields
    foreach ($this->annabaFields as $key => $value) {
        $tabValidation["annabaFields.$key"] = $key;
    }

    foreach ($this->annabaPasswords as $key => $value) {
        $tabValidation["annabaPasswords.$key"] = $key;
    }

    foreach ($this->annabaMultiples as $key => $value) {
        $tabValidation["annabaMultiples.$key"] = $key;
    }
    
    foreach ($this->annabaMultipleFiles as $key => $value) {
        $tabValidation["annabaMultipleFiles.$key"] = $key;
    }

    // Loop through annabaFiles
    foreach ($this->annabaFiles as $cle => $item) {
        $tabValidation["annabaFiles.$cle"] = $cle;
    }

    return $tabValidation;
}


public function annabaDeleteFileByKey($a,$b) {
    unset($this->annabaMultipleFiles[$a][$b]);
 }

    public function render()
    {
        return view('annaba::livewire.wizardcreator');
    }
}