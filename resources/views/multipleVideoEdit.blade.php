<div class="w-full"
            x-data="{ isUploading: false, progress: 0 ,  lastVideoUrl: null}"
            x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false"
            x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">

           

            <div class="mb-[5px]">
                <span class="text-[darkblue] font-bold">{{$label}}</span><span class="text-[red]">@if($required==true)*@endif</span> 
             </div>
        
            <div class="w-[100%]  flex items-center justify-center">
                <label class="w-[100%]">
                    <input type="file" wire:model="annabaMultipleFiles.{{$file}}" accept="video/*" hidden
                    x-ref="fileInput"
                    @change="if ($refs.fileInput.files.length) {
                    lastVideoUrl = URL.createObjectURL($refs.fileInput.files[$refs.fileInput.files.length - 1]);
                    }"
                    @foo.window="lastVideoUrl=null"
                    />
                    <div class="flex w-[100%] h-[50px] px-2 flex-col bg-[blue] rounded-full shadow text-[white] text-[14px] font-semibold leading-4 items-center justify-center cursor-pointer focus:outline-none">Add Video</div>
                  </label>
            </div>
        

           <!-- ✅ Aperçu de la dernière vidéo sélectionnée -->
    <template x-if="lastVideoUrl">
        <div class="mt-4 w-full">
            <span class="text-green-600 font-semibold">Dernière vidéo ajoutée :</span>
            <video class="mt-2 rounded w-full max-w-[400px] border shadow" controls :src="lastVideoUrl"></video>
        </div>
    </template> 
           
            @foreach ($annabaMultipleFiles[$file] as $key => $item)
           <div class="flex bg-[#DDD] text-black border-[2px] border-white mt-[10px]
          p-[10px] pb-[20px] pt-[20px] rounded-[5px]">
                <div class="w-full">
                    @if ($item) 
                    {{ $item->getClientOriginalName() }}
                     @endif
                </div>
                <div>
                    <span class="material-icons text-[red]
                     text-[30px] cursor-pointer"
                     wire:click="annabaDeleteFileByKey('{{$file}}','{{$key}}')">
                        delete_forever
                    </span>
                </div>
           </div>
         @endforeach

         @if ($annabaMultipleFileRecords != [])
         @foreach ($annabaMultipleFileRecords[$file] as $key => $item)
         <div class="pt-[5px] flex">
             <div class="w-full">
                 @if ($item) 
                   <video width="100%" class="max-h-[50vh]" controls
                        src="{{$annabaUrlStorage}}{{ $item}}">
                     </video>  
                  @endif
             </div>
             <div class="">
                 <span class="material-icons text-[red]
                  text-[30px] cursor-pointer"
                  wire:click="annabaDeleteFileRecordByKey('{{$file}}','{{$key}}')">
                     delete_forever
                 </span>
             </div>
        </div>
        @endforeach
        @endif


         @error("annabaMultipleFileErrors.$file")
         <div class="text-[red] pt-[5px]">
              <span class="error">{{ $message }}</span> 
         </div>
         @enderror    
        
         @error("annabaMultipleFiles.$file")
         <div class="text-[red] pt-[5px]">
              <span class="error">{{ $message }}</span> 
         </div>
         @enderror     

            <!-- Progress Bar -->
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress" class="h-[10px] bg-[blue] rounded-[5px]"></progress>
            </div>
        
</div>
