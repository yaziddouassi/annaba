<div>
    <div class="w-full mb-[5px]">
       <span class="text-[darkblue] font-bold">{{$label}}</span><span class="text-[red]">@if($required==true)*@endif</span> 
    </div>

    <div>
        <select type="text" wire:model="annabaFields.{{$field}}"
         class="w-full  bg-[#E8E8E8] h-[50px]
        border-[darkblue] border-[1px]">
            <option value=""></option>
            @foreach ($collection as $key => $item)
                <option value="{{$item}}">{{$labels[$key]}}</option>
            @endforeach
        </select> 
    </div>


    @error("annabaFields.$field")
    <div class="text-[red] pt-[5px]">
         <span class="error">{{ $message }}</span> 
    </div>
    @enderror

 </div>