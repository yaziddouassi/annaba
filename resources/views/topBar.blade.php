<div class="max-[799px]:hidden pt-[2px] pl-[2px] pr-[2px] ">

   <div class="h-[60px] bg-[#ddd] text-white grid grid-cols-2">
        
      <div class="text-[darkblue] flex pl-[5px] pt-[12px] text-[20px]">
         <span class="material-icons text-[30px] pt-[2px]" style="display:block">
            account_circle
            </span>
            <span style="display:block">
               &nbsp; {{ucfirst($user->name)}}
            </span>
        
        </div>

      <div class="text-right pt-[8px] pr-[4px]">
         <a href="/admin/crud-generator" wire:navigate >
         <button class="bg-[darkblue] border border-white w-[80px] rounded-[3px] p-[7px] text-[20px]">
            CRUD
         </button></a>&nbsp;
         <a href="/admin/chart-generator" wire:navigate >
         <button class="border border-[darkblue] text-[darkblue] w-[90px] rounded-[3px] p-[7px] text-[20px]">
              <span>
               CHARTS
            </span>  
         </button> 
        </a>
      </div>
   </div> 
</div>
