{{--  @inputVidep($tabfiles['file1'],'tabfiles.file1','Video1','*') --}}
<div class="w-full"
            x-data="{ isUploading: false, progress: 0 , videoPreviewUrl: null}"
            x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false"
            x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">

           

            <div class="mb-[5px]">
                <span class="text-[darkblue] font-bold">{{$label}}</span><span class="text-[red]">@if($required==true)*@endif</span> 
             </div>
        
            <div class="w-[100%]  flex items-center justify-center">
                <label class="w-[100%]">
                    <input type="file" wire:model="annabaFiles.{{$file}}" accept="video/*" hidden
                    x-ref="videoInput"
                   @change="if ($refs.videoInput.files.length) {
                    videoPreviewUrl = URL.createObjectURL($refs.videoInput.files[0]);
                   }"
                  @foo.window="videoPreviewUrl=null"
                    />
                    <div class="flex w-[100%] h-[50px] px-2 flex-col bg-[blue] rounded-full shadow text-[white] text-[14px] font-semibold leading-4 items-center justify-center cursor-pointer focus:outline-none">Choose Video</div>
                  </label>
            </div>

            
            <template x-if="videoPreviewUrl">
                 <div class="mt-4 w-full">
                    <span class="text-green-600 font-semibold">Aperçu de la vidéo :</span>
                    <video class="mt-2 w-full max-w-[500px] rounded shadow border" controls :src="videoPreviewUrl"></video>
                 </div>
            </template>

            <!-- Progress Bar -->
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


</div>
