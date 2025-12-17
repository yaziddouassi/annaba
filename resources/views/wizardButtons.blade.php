<div class="gap-[10px] p-[10px]" style="display:flex;flex-wrap : wrap; ">
    @if ($wizardCount > 1)
      <div>
        <button wire:click="conteneurWizardBack()"
        class="bg-black p-[9px] w-[80px]  text-white rounded-[2px]">BACK</button>
      </div>
    @endif

    
    
    @if ($wizardCount < $wizardSteps)
       @if(in_array($wizardCount, $wizardStops))
       <div>
         <button wire:click="conteneurWizardCreate()"
         class="bg-[blue] w-[80px] text-white p-[9px] rounded-[2px]">Créer</button>
        </div>
       @endif
    @endif
    
    @if ($wizardCount < $wizardSteps)
       @if(in_array($wizardCount, $wizardStops))
         @if ($wizardShowOther == true)
         <div>
           <button wire:click="conteneurWizardCreateOther()"
             class="border-[1px]  border-black  text-black p-[9px] rounded-[2px]">
              Créer un autre
            </button>
          </div>
         @endif
       @endif
    @endif 

       @if ($wizardCount == $wizardSteps)
       <div>
       <button wire:click="conteneurWizardCreate()"
        class="bg-[blue] w-[80px] text-white p-[9px] rounded-[2px]">Créer</button>
      </div>
       @endif

       @if ($wizardCount == $wizardSteps)
          @if ($wizardShowOther == true)
             <div>
                 <button wire:click="conteneurWizardCreateOther()"
                  class="border-[1px]  border-black  text-black p-[9px] rounded-[2px]">
                   Créer un autre
               </button>
             </div>
          @endif
       @endif


    @if ($wizardCount < $wizardSteps)
       <div>
          <button  wire:click="conteneurWizardNext()"
          class="bg-black p-[9px] w-[80px] text-white rounded-[2px]">NEXT</button> 
       </div> 
    @endif

    
</div>