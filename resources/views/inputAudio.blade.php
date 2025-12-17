<div class="w-full"
            x-data="{ isUploading: false, progress: 0 , audioPreviewUrl: null}"
            x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false"
            x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">

           

            <div class="mb-[5px]">
                <span class="text-[darkblue] font-bold">{{$label}}</span><span class="text-[red]">@if($required==true)*@endif</span> 
             </div>
        
            <div class="w-[100%]  flex items-center justify-center">
                <label class="w-[100%]">
                    <input type="file" wire:model="annabaFiles.{{$file}}"  accept="audio/*" hidden
                     x-ref="audioInput"
                   @change="if ($refs.audioInput.files.length) {
                    audioPreviewUrl= URL.createObjectURL($refs.audioInput.files[0]);
                   }"
                  @foo.window="audioPreviewUrl=null"
                    />
                    <div class="flex w-[100%] h-[50px] px-2 flex-col bg-[blue] rounded-full shadow text-[white] text-[14px] font-semibold leading-4 items-center justify-center cursor-pointer focus:outline-none">Choose Audio</div>
                  </label>
            </div>


            <!-- ✅ Aperçu audio du dernier fichier sélectionné -->
    <template x-if="audioPreviewUrl">
        <div class="mt-4 w-full">
            <span class="text-green-600 font-semibold">Dernier audio ajouté :</span>
            <audio class="mt-2 w-full" controls :src="audioPreviewUrl"></audio>
        </div>
    </template>


            <div x-show="isUploading">
              <progress max="100" x-bind:value="progress" class="h-[10px] bg-[blue] rounded-[5px]"></progress>
          </div>

            

         <div class="pt-[5px]">
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

            <!-- Progress Bar -->
           
        
</div>
