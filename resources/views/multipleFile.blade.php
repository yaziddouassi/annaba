<div class="w-full"
            x-data="{ isUploading: false, progress: 0 }"
            x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false"
            x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">

           

            <div class="mb-[5px]">
                <span class="text-[darkblue] font-bold">{{$label}}</span><span class="text-[red]">@if($required==true)*@endif</span> 
             </div>
        
            <div class="w-[100%]  flex items-center justify-center">
                <label class="w-[100%]">
                    <input type="file" wire:model="annabaMultipleFiles.{{$file}}"  hidden />
                    <div class="flex w-[100%] h-[50px] px-2 flex-col bg-[blue] rounded-full shadow text-[white] text-[14px] font-semibold leading-4 items-center justify-center cursor-pointer focus:outline-none">Add File</div>
                  </label>
            </div>
        
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress" class="h-[10px] bg-[blue] rounded-[5px]"></progress>
            </div>
           
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

         @if (session('status'))
         <div class="alert alert-success">
             {{ session('status') }}
         </div>
     @endif
        
         @error("annabaMultipleFiles.$file")
    <div class="text-[red] pt-[5px]">
         <span class="error">{{ $message }}</span> 
    </div>
    @enderror   

            <!-- Progress Bar -->
           
        
</div>
