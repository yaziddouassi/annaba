<div class="w-full"
    x-data="{ isUploading: false, progress: 0 , showFile : true, imagePreviewUrl: null}"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress">

    <div class="mb-[5px]">
        <span class="text-[darkblue] font-bold">{{$label}}</span><span class="text-[red]">@if($required==true)*@endif</span> 
     </div>

    <div class="w-[100%]  flex items-center justify-center" x-show="$wire.annabaFile0pens.{{$file}}">
        <label class="w-[100%]">
            <input type="file" wire:model="annabaFiles.{{$file}}" accept="image/png,image/jpeg" hidden 
            x-ref="imageInput"
                   @change="if ($refs.imageInput.files.length) {
                    imagePreviewUrl= URL.createObjectURL($refs.imageInput.files[0]);
                   }"
                  @foo.window="imagePreviewUrl=null" 
            />
            <div class="flex w-[100%] h-[50px] px-2 flex-col bg-[blue] rounded-full shadow text-[white] text-[14px] font-semibold leading-4 items-center justify-center cursor-pointer focus:outline-none">Choose Image</div>
          </label>
    </div>


     <template x-if="imagePreviewUrl">
        <div class="mt-4">
            <span class="text-green-600 font-semibold">Dernière image ajoutée :</span>
            <img :src="imagePreviewUrl" alt="Dernière image" class="mt-2 rounded w-[150px] h-auto border shadow">
        </div>
    </template>

     <!-- Progress Bar -->
     <div x-show="isUploading">
        <progress max="100" x-bind:value="progress" class="h-[10px] bg-[blue] rounded-[5px]"></progress>
    </div>
    
    
    <div class="mt-[-4px]  min-h-[50px]"  x-show="!$wire.annabaFile0pens.{{$file}}">
    
        <div class="text-right relative text-[red] text-[32px] font-[arial] pr-[5px] z-[100]">
           <span @click="$wire.annabaFile0pens.{{$file}}=true" class="cursor-pointer">C</span><span @click="$wire.annabaFile0pens.{{$file}}=true" class="text-[#CCC] cursor-pointer">lo</span ><span @click="$wire.annabaFile0pens.{{$file}}=true" class="cursor-pointer">se</span>
        </div>
        <div class="mt-[-44px]">
            @if ($annabaRecord != null)
            <div class="border-[1px] border-black">
            <img src="{{$annabaUrlStorage}}{{ $annabaRecord[$file]}}" width="100%" 
            class="min-h-[50px] max-h-[50vh]"
            alt="Image not found!"> 
            </div>
            @endif

        </div>  
      </div>


    <div class="pt-[5px]" x-show="$wire.annabaFile0pens.{{$file}}">
                  @if ($annabaFiles[$file])
                   <div class="bg-[#DDD] text-black border-[2px] border-white mt-[10px]
                   p-[10px] pb-[20px] pt-[20px] rounded-[5px]">
                  {{ $annabaFiles[$file]->getClientOriginalName() }}
                  </div>
              @endif
             </div>
    

    @error("annabaFiles.$file")
    <div class="text-[red] pt-[5px]">
         <span class="error">{{ $message }}</span> 
    </div>
    @enderror
  
   
</div>
