<div x-data="{content : $wire.entangle('annabaFields.{{$field}}'),

init() {
 this.changerValeur() ;

$watch('content', value => {
       this.changerValeur() ;
    });

},

changerValeur() {

var nameField = document.getElementById('annaba-checkbox-{{$field}}');
if($wire.annabaFields.{{$field}} == null) {
        this.content = 0 ;
        }

if($wire.annabaFields.{{$field}} == false) {
        this.content = 0 ;
        }

if($wire.annabaFields.{{$field}} == true) {
        this.content = 1 ;
        }
if($wire.annabaFields.{{$field}} == 0) {
        nameField.checked = false; 
        }
if($wire.annabaFields.{{$field}} == 1) {
        nameField.checked = true; 
        }

}

}">
    <div class="w-full mb-[5px]">
       <span class="text-[darkblue] font-bold">{{$label}}</span>
    </div>
    <div>
       <input type="checkbox" wire:model="annabaFields.{{$field}}" 
       id="annaba-checkbox-{{$field}}"  class="bg-[#E8E8E8]">
    </div>
 </div>