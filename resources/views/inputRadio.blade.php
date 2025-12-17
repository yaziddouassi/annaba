<div>
    <div class="w-full mb-[5px]">
       <span class="text-[darkblue] font-bold">{{$label}}</span><span class="text-[red]">@if($required==true)*@endif</span> 
    </div>

    
    @foreach ($collection as $key => $item)
    <div>
    <label>
        <input type="radio" wire:model="annabaFields.{{$field}}" value="{{$item}}">
        {{$labels[$key]}}
    </label>
    </div>
    @endforeach
    
    

    @error("annabaFields.$field")
    <div class="text-[red] pt-[5px]">
         <span class="error">{{ $message }}</span> 
    </div>
    @enderror
 
 </div>