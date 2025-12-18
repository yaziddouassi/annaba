<div class="p-[10px] pt-[0px]">
    <button class="bg-[blue] w-[100px] text-white p-[9px] rounded-[4px]"
   wire:click="annabaCreate()"  >{{ $annabaBtnCreateLabel }} </button>
    &nbsp;
   @if($annabaBtnCreateOther == 'yes')
       <button @click="$dispatch('foo')" wire:click="annabaCreateOther()"
      class="border-[1px] border-black w-[140px] text-black p-[9px] rounded-[4px]">
        {{ $annabaBtnCreateOtherLabel }}
   </button>
   @endif
</div>
