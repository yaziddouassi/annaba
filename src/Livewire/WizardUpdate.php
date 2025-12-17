<?php

namespace Annaba\Annaba\Livewire;

header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class WizardUpdate extends Component
{
    
    public $wizardCount = 1;
    public $wizardSteps = 0 ;
    public $wizardLabels = array() ;
    public $annabaFile0pens =  [];
    public $annabaMultipleFileRecords =  [];
    public $annabaMultipleFileErrors =  [];


    public function wizardInit($steps,$labels)
    {
        $this->wizardSteps = $steps;
       
        foreach ($labels as $key => $value) {
            $this->wizardLabels[$key + 1] = $value;
        }
    }

    public function wizardValidation($a) {}
    public function wizardUpdate(){}
    public function wizardCreateOther(){}


    public function conteneurWizardBack()
    {
        $this->wizardCount = $this->wizardCount - 1 ;
    }


    public function conteneurWizardNext()
    {
        $this->wizardValidation($this->wizardCount);
        $this->wizardCount = $this->wizardCount + 1 ;
    }

    
    public function conteneurWizardUpdate()
    {
        $this->wizardValidation($this->wizardCount);
        $this->wizardUpdate();
        $this->wizardCount = 1 ;
        $this->rezetannabaFile0pens();
        $this->rezetannabaFiles();
    }


    public function rezetannabaFile0pens() {

        foreach ($this->annabaFile0pens as $key => $value) {
            $this->annabaFile0pens[$key] = null ;
        }
    }

    public function rezetannabaFiles() {

        foreach ($this->annabaFiles as $key => $value) {
            $this->annabaFiles[$key] = null ;
        }
    }


    public function checkIfMultipleFileIsNotNull($a) {

        $tab1s = [] ;
        $tab2s = [] ;
    
        foreach ($this->annabaMultipleFiles as $key => $value) {
        if (in_array($key, $a)) {  
            $this->annabaMultipleFileErrors[$key] = 1;
            $tab1s["annabaMultipleFileErrors.$key"] = 'required';
            $tab2s["annabaMultipleFileErrors.$key"] = $key;
    
                if ($value == []) {
                    if ($this->annabaMultipleFileRecords[$key] == []) {
                      $this->annabaMultipleFileErrors[$key] = null;
                    }
                }
    
                if (in_array($key, $this->annabaNullables)) {
                    $this->annabaMultipleFileErrors[$key] = 1; 
                }
            
            }
        }


        if ($a != [] && $tab1s != [] && $tab2s != []) {
            $validated2 = $this->validate(
                $tab1s
                ,[], 
               $tab2s
              ); 
        }
    
        
    }


    public function annabaChanger() {
        
       

        foreach ($this->annabaFields as $key => $value) {
            if (in_array($key,$this->annabaRecord->getFillable())) {
               $this->annabaRecord[$key] = $value ;
               }
            }

         foreach ($this->annabaPasswords as $key => $value) {
            if ($value != '' && $value != null && $value != []) {
                if (in_array($key,$this->annabaRecord->getFillable())) {
                    $this->annabaRecord[$key] = Hash::make($value);
                    }
               }
            }    

         foreach ($this->annabaMultiples as $key => $value) {
            if (in_array($key,$this->annabaRecord->getFillable())) {
               $this->annabaRecord[$key] = $value ;
             }
        }
    
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
        $mergedArray = array_merge($temp, $this->annabaMultipleFileRecords[$cle]);
        $this->annabaRecord[$cle] = $mergedArray ;  

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


    public function annabaInit($id) {

      $this->annabaRecord = $this->annabaModelClass::find($id);
        if($this->annabaRecord == null) {
         return $this->redirect($this->annabaRouteListe, navigate: true);
        }
       foreach ($this->annabaFields as $cle => $fields) {
        if (in_array($cle,$this->annabaRecord->getFillable())) {
           $this->annabaFields[$cle] =  $this->annabaRecord[$cle];
          }
       } 
       
       foreach ($this->annabaMultiples as $cle => $fields) {
        if (in_array($cle,$this->annabaRecord->getFillable())) {
        $this->annabaMultiples[$cle] = $this->annabaRecord[$cle] ;
       } 
    }

    foreach ($this->annabaMultipleFiles as $cle => $fields) {
        if (in_array($cle,$this->annabaRecord->getFillable())) {
        $this->annabaMultipleFileRecords[$cle] = $this->annabaRecord[$cle] ;
       } 
    }


   }


   public function annabaDeleteFileByKey($a,$b) {
    unset($this->annabaMultipleFiles[$a][$b]);
 }

 public function annabaDeleteFileRecordByKey($a,$b) {
   unset($this->annabaMultipleFileRecords[$a][$b]);
 }


    public function render()
    {
        return view('annaba::livewire.wizardcreator');
    }
}