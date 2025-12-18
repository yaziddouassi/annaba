<div class="gap-[10px] p-[10px] pt-[0px]" style="display:flex;flex-wrap : wrap; ">
    @if ($wizardCount > 1)
      <div>
        <button wire:click="conteneurWizardBack()"
        class="bg-black p-[11px] text-white rounded-[4px]">{{$annabaPrecedentLabel}}</button>
      </div>
    @endif

    
    @if ($wizardCount < $wizardSteps)
       @if(in_array($wizardCount, $wizardStops))
       <div>
         <button wire:click="conteneurWizardUpdate()"
         class="bg-[blue] min-w-[80px] text-white p-[11px] rounded-[4px]">{{$annabaBtnModifierLabel}}</button>
        </div>
       @endif
    @endif
    
    
       @if ($wizardCount == $wizardSteps)
       <div>
       <button wire:click="conteneurWizardUpdate()"
        class="bg-[blue] min-w-[80px] text-white p-[11px] rounded-[4px]">{{$annabaBtnModifierLabel}}</button>
      </div>
       @endif

    @if ($wizardCount < $wizardSteps)
       <div>
          <button  wire:click="conteneurWizardNext()"
          class="bg-black p-[11px] text-white rounded-[4px]">{{$annabaSuivantLabel}}</button> 
       </div> 
    @endif

    
</div>