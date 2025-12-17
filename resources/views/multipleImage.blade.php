<div class="w-full"
    x-data="{ 
        isUploading: false, 
        progress: 0, 
        lastPhotoUrl: null 
    }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
>

    <div class="mb-[5px]">
        <span class="text-[darkblue] font-bold">{{$label}}</span>
        <span class="text-[red]">@if($required==true)*@endif</span> 
    </div>

    <div class="w-full flex items-center justify-center">
        <label class="w-full">
            <input 
                type="file" 
                wire:model="annabaMultipleFiles.{{$file}}" 
                accept="image/png,image/jpeg" 
                hidden 
                x-ref="fileInput"
                @change="if($refs.fileInput.files.length){
                    lastPhotoUrl = URL.createObjectURL($refs.fileInput.files[$refs.fileInput.files.length - 1]);
                }"
                @foo.window="lastPhotoUrl=null"
            />
            <div class="flex w-full h-[50px] px-2 flex-col bg-[blue] rounded-full shadow text-white text-[14px] font-semibold leading-4 items-center justify-center cursor-pointer focus:outline-none">
                Add Image
            </div>
        </label>
    </div>

    <!-- ✅ Affichage de la dernière image ajoutée -->
    <template x-if="lastPhotoUrl">
        <div class="mt-4">
            <span class="text-green-600 font-semibold">Dernière image ajoutée :</span>
            <img :src="lastPhotoUrl" alt="Dernière image" class="mt-2 rounded w-[150px] h-auto border shadow">
        </div>
    </template>

    @foreach ($annabaMultipleFiles[$file] as $key => $item)
    <div class="flex bg-[#DDD] text-black border-[2px] border-white mt-[10px] p-[10px] pb-[20px] pt-[20px] rounded-[5px]">
        <div class="w-full">
            @if ($item) 
            {{ $item->getClientOriginalName() }}
            @endif
        </div>
        <div>
            <span class="material-icons text-[red] text-[30px] cursor-pointer"
                  wire:click="annabaDeleteFileByKey('{{$file}}','{{$key}}')">
                delete_forever
            </span>
        </div>
    </div>
    @endforeach

    @error("annabaMultipleFiles.$file")
    <div class="text-[red] pt-[5px]">
        <span class="error">{{ $message }}</span> 
    </div>
    @enderror     

    <!-- Barre de progression -->
    <div x-show="isUploading">
        <progress max="100" x-bind:value="progress" class="h-[10px] bg-[blue] rounded-[5px] w-full"></progress>
    </div>

</div>
