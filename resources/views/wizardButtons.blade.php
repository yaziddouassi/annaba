<div class="gap-[10px] p-[10px] pt-[0px]" style="display:flex;flex-wrap : wrap; ">
    @if ($wizardCount > 1)
      <div>
        <button wire:click="conteneurWizardBack()"
        class="bg-black p-[10px] text-white rounded-[4px]">{{$annabaPrecedentLabel}}</button>
      </div>
    @endif

    @if ($wizardCount < $wizardSteps)
       @if(in_array($wizardCount, $wizardStops))
       <div>
         <button wire:click="conteneurWizardCreate()"
         class="bg-[blue] min-w-[80px] text-white p-[10px] rounded-[4px]">{{$annabaBtnCreateLabel}}</button>
        </div>
       @endif
    @endif
    
    @if ($wizardCount < $wizardSteps && $annabaBtnCreateOther == 'yes')
       @if(in_array($wizardCount, $wizardStops))
         @if ($wizardShowOther == true)
         <div>
           <button wire:click="conteneurWizardCreateOther()"
             class="border-[1px]  min-w-[80px] border-black  text-black p-[10px] rounded-[4px]">
              {{$annabaBtnCreateOtherLabel}}
            </button>
          </div>
         @endif
       @endif
    @endif 

       @if ($wizardCount == $wizardSteps)
       <div>
       <button wire:click="conteneurWizardCreate()"
        class="bg-[blue] min-w-[80px] text-white p-[10px] rounded-[4px]">{{$annabaBtnCreateLabel}}</button>
      </div>
       @endif

       @if ($wizardCount == $wizardSteps && $annabaBtnCreateOther == 'yes')
          @if ($wizardShowOther == true)
             <div>
                 <button wire:click="conteneurWizardCreateOther()"
                  class="border-[1px] min-w-[80px] border-black  text-black p-[10px] rounded-[4px]">
                   {{$annabaBtnCreateOtherLabel}}
               </button>
             </div>
          @endif
       @endif


    @if ($wizardCount < $wizardSteps)
       <div>
          <button  wire:click="conteneurWizardNext()"
          class="bg-black p-[10px] text-white rounded-[4px]">{{$annabaSuivantLabel}}</button> 
       </div> 
    @endif

    
</div>