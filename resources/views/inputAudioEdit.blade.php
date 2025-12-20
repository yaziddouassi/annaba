<div class="w-full"
            x-data="{ 
                isUploading: false, 
                progress: 0, 
                videoPreviewUrl: null,
                hasNewUpload: false,
                cle : '{{$file}}',
                oldVideoUrl: '',

                init() {
                  console.log($wire.annabaRecordBis)
                  this.updateOldVideoUrl();
                  
                  // Écouter les changements de Livewire
                  this.$watch('$wire.annabaRecordBis', () => {
                      this.updateOldVideoUrl();
                  });
                  
                  this.$watch('$wire.annabaUrlStorage', () => {
                      this.updateOldVideoUrl();
                  });
                },
                
                updateOldVideoUrl() {
                    if ($wire.annabaRecordBis && $wire.annabaRecordBis[this.cle]) {
                        this.oldVideoUrl = $wire.annabaUrlStorage + $wire.annabaRecordBis[this.cle];
                        console.log('URL mise à jour:', this.oldVideoUrl);
                    }
                }
            }"
            x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false; $wire.annabaHasNewUpload[cle] = true"
            x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress"
            >
          
            <div class="mb-[5px]">
                <span class="text-[darkblue] font-bold">{{$label}}</span><span class="text-[red]">@if($required==true)*@endif</span> 
            </div>
        
            <!-- Bouton d'upload -->
            <div class="w-[100%] flex items-center justify-center">
                <label class="w-[100%]">
                    <input type="file" 
                           wire:model="annabaFiles.{{$file}}" 
                           accept="audio/*"
                           hidden 
                           x-ref="videoInput"
                           @change="if ($refs.videoInput.files.length) {
                               $wire.annabaPreviewUrl[cle] = URL.createObjectURL($refs.videoInput.files[0]);
                               $wire.annabaHasNewUpload[cle] = true;
                           }"
                    />
                    <div class="flex w-[100%] h-[50px] px-2 flex-col border-[1px] border-black rounded-full 
                    shadow text-black text-[14px] font-semibold leading-4 items-center justify-center
                    cursor-pointer focus:outline-none">
                        Choisir un audio
                    </div>
                </label>
            </div>
        
            @if ($annabaFiles[$file])
            <!-- Aperçu de la nouvelle vidéo avec bouton effacer -->
            <template x-if="$wire.annabaPreviewUrl[cle] && $wire.annabaHasNewUpload[cle]">
                <div class="mt-4 w-full">
                    <audio class="mt-2 w-full" controls :src="$wire.annabaPreviewUrl[cle]"></audio>
                </div>
            </template>
            @endif


            <!-- Progress Bar -->
            <div x-show="isUploading" class="mt-2">
                <progress max="100" x-bind:value="progress" class="w-full h-[10px] bg-[blue] rounded-[5px]"></progress>
            </div>

            <!-- Affichage de l'ancienne vidéo (seulement si pas de nouveau upload) -->
            @if ($annabaRecord != null && isset($annabaRecord[$file]))
            <template x-if="!$wire.annabaPreviewUrl[cle] && !$wire.annabaHasNewUpload[cle] && oldVideoUrl">
                <div class="mt-[5px]">
                     <figure>
                      <audio controls class="pt-[8px] w-full"
                        x-bind:src="oldVideoUrl">
                      </audio>
                     </figure>
                </div>
            </template>
            @endif

            <!-- Nom du fichier uploadé -->
            <div class="pt-[5px]" x-show="$wire.annabaPreviewUrl[cle]">
                @if ($annabaFiles[$file])
                    <div class="bg-[#DDD] text-black border-[2px] border-white mt-[10px] p-[10px] pb-[20px] pt-[20px] rounded-[5px]">
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