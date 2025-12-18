<div class="w-full">
    <div class="mb-[5px]">
       <span class="text-[darkblue] font-bold">{{$label}}</span><span class="text-[red]">@if($required==true)*@endif</span> 
    </div>
    <div>
       <input type="date" wire:model="annabaFields.{{$field}}" class="w-full rounded-[4px] h-[50px]
      border-[darkblue] border-[1px]"

      @if($min != false)
        min="{{$min}}"
      @endif
      @if($max != false)
        max="{{$max}}"
      @endif
      >
    </div>

    @error("annabaFields.$field")
    <div class="text-[red] pt-[5px]">
         <span class="error">{{ $message }}</span> 
    </div>
    @enderror

 </div>