<div>
   <div class="w-full mb-[5px]">
      <span class="text-[darkblue] font-bold">{{$label}}</span><span class="text-[red]">@if($required==true)*@endif</span> 
   </div>
   <div>
      <textarea 
         wire:model="annabaFields.{{$field}}" 
         class="w-full min-h-[120px] p-3 border-[darkblue] border-[1px] resize-y"
         rows="5"
      ></textarea>
   </div>

   @error("annabaFields.$field")
   <div class="text-[red] pt-[5px]">
        <span class="error">{{ $message }}</span> 
   </div>
   @enderror
</div>
