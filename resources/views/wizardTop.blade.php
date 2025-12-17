<div class="p-[10px]">
    <div class=" bg-[#EEE] flex flex-wrap justify-evenly">

      @foreach ($wizardLabels as $key => $item)

         @if ($wizardCount > $key)
         <div class="w-1/3 min-[1000px]:w-1/6 min-w-[100px] pt-[10px] pb-[10px]">
          <div class="w-[48px] m-auto">
              <svg width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="24" cy="24" r="24" fill="green" />
                  <path d="M17 24.586L21.293 28.879L33.879 16.293L36 18.414L21.293 33.121L15.879 27.707L17 24.586Z" fill="white"/>
                </svg>
          </div>
          <div class="text-center">
           {{$item}}
          </div>
       </div>
         @endif

         @if ($wizardCount <= $key)
         <div class="w-1/3 min-[1000px]:w-1/6 min-w-[100px] pt-[10px] pb-[10px]">
          <div class="w-[48px] m-auto">
            <svg width="48" height="48" xmlns="http://www.w3.org/2000/svg">
              <circle cx="24" cy="24" r="22" stroke="black" stroke-width="2" fill="none" />
              <text x="50%" y="50%" text-anchor="middle" dy=".35em" font-size="18" font-family="Arial">
                {{$key}}
              </text>
            </svg>
          </div>
          <div class="text-center">
            {{$item}}
          </div>
       </div>
         @endif
          
      @endforeach

     
      
 
    </div>
 </div>