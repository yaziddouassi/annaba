<div x-data="{content : $wire.entangle('annabaMultiples.{{$field}}'),

init() {

if(this.content == null) {
       this.content = [] ;
       }

$watch('content', value => {
       if(this.content == null) {
       this.content = [] ;
       }

       console.log(this.content)
    });
console.log(this.content)



}



}">
    <div class="w-full mb-[5px]">
       <span class="text-[darkblue] font-bold">{{$label}}</span><span class="text-[red]">@if($required==true)*@endif</span> 
    </div>
    
    @foreach ($collection as $key => $item)
    <div>
    <label>
        <input type="checkbox" wire:model="annabaMultiples.{{$field}}" value="{{$item}}">
        {{$labels[$key]}}
    </label>
    </div>
    @endforeach

 
    @error("annabaMultiples.$field")
    <div class="text-[red] pt-[5px]">
         <span class="error">{{ $message }}</span> 
    </div>
    @enderror
 
 </div>