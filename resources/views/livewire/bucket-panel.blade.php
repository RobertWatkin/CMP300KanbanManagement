 <div class="flex overflow-x-scroll px-2 h-full">
     <div class="flex flex-col md:flex-row md:justify-end h-full mx-auto md:ml-4">
         @foreach($board->buckets()->get() as $bucket)
         <div class="flex-none flex-col space-y-2 text-left w-48 mx-2">
             <livewire:bucket-component :bucket="$bucket" :key="$bucket->id" />
         </div>
         @endforeach
         <div class="flex-none min-w-24 float-right text-center mx-3 pt-4">
             <button type="button" wire:click="newBucket" wire:loading.attr="disabled" class="bg-gray-100 hover:bg-gray-400 text-gray-800 py-1 pl-2 pr-3 border-2 border-r-2 rounded-full inline-flex items-center">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                 </svg>
                 <span class="">New Bucket</span>
             </button>
         </div>
     </div>
 </div>