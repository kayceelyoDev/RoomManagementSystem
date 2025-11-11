<div class="flex h-full w-full flex-1 flex-col gap-6 ">

    <div class="flex items-center gap-3">
        <a href="/dashboard/room"
            class="rounded-lg p-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700"
            title="Back to Rooms">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Room Details</h1>
    </div>


    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
        
        
        <div class="border-b border-gray-200 px-6 py-6 dark:border-gray-700">
            <div class="mb-1 text-sm font-medium text-gray-600 dark:text-gray-400">
             {{ $room->roomNumber }}
            </div>
            <h2 class="text-5xl font-bold text-gray-900 dark:text-white">
                {{ $room->roomName }}
            </h2>
            <p class="mt-3 text-base text-gray-600 dark:text-gray-400">
                {{ $room->roomDescription }}
            </p>
        </div>

        <div class="p-6">
   
            <div class="mb-8">
                <h3 class="mb-4 text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">
                    Details
                </h3>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    
                    <div class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-900">
                        <div class="text-xs text-gray-600 dark:text-gray-400">Price</div>
                        <div class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $room->roomPrice }}</div>
                    </div>

    
                    <div class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-900">
                        <div class="text-xs text-gray-600 dark:text-gray-400">Capacity</div>
                        <div class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $room->capacity }} people</div>
                    </div>

   
                    <div class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-900">
                        <div class="text-xs text-gray-600 dark:text-gray-400">Status</div>
                        <div class="mt-1">
                            <span class="inline-flex rounded-full bg-green-600 px-2 py-1 text-xs font-semibold text-white dark:bg-green-500">
                                {{ $room->status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>


            <div>
                <h3 class="mb-4 text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">
                    Gallery
                </h3>
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
                    @foreach ($room->image as $image)
                        <div wire:click="openModal('{{ asset('storage/' . $image->image_path) }}')" 
                             class="group relative aspect-square cursor-pointer overflow-hidden rounded-lg border border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-900">
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                 alt="Room Image"
                                 class="h-full w-full object-cover transition-opacity hover:opacity-75" 
                                 loading="lazy" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    @if($showModal)
        <div wire:click="closeModal" 
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4 animate-fadeIn">
            <div class="relative w-full max-w-7xl" wire:click.stop>
             
                <button wire:click="closeModal" 
                        class="absolute -top-10 right-0 rounded p-1 text-white/80 hover:bg-white/10 hover:text-white">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                
       
                <div class="flex items-center justify-center">
                    <img src="{{ $selectedImage }}" 
                         alt="Room Image" 
                         class="max-h-[85vh] max-w-full rounded-lg object-contain shadow-2xl animate-scaleIn">
                </div>
            </div>
        </div>
    @endif
</div>
