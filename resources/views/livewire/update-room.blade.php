<div class="flex h-full w-full flex-1 flex-col gap-6 p-6">

    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Add New Room</h1>
        <button class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            <flux:icon.arrow-left class="size-5" />
            <span>Back</span>
        </button>
    </div>


    <div class="overflow-auto rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
        <form wire:submit.prevent="roomUpdate" class="space-y-6">

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                    Room Images
                </label>
                

                <div class="mb-4 flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-6 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-900 dark:hover:bg-gray-800">
                    <label class="flex cursor-pointer flex-col items-center gap-2">
                        <flux:icon.photo class="size-12 text-gray-400 dark:text-gray-500" />
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Click to upload images</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG up to 10MB (Multiple files allowed)</span>
                        <input 
                            type="file" 
                            class="hidden" 
                            multiple 
                            accept="image/*"
                            wire:model="newImages"
                        />
                    </label>
                </div>


                <div wire:loading wire:target="newImages" class="mb-4 text-center">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Uploading images...</span>
                </div>

      
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                   
                    @if($images && count($images) > 0)
                        @foreach($images as $index => $image)
                        <div class="group relative aspect-square overflow-hidden rounded-lg border border-gray-200 bg-gray-100 dark:border-gray-700 dark:bg-gray-900">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Preview" class="h-full w-full object-cover" />
                            <button 
                                type="button" 
                        
                                wire:click="removeExistingImage({{ $image->id }})"
                                class="absolute right-2 top-2 rounded-full bg-red-500 p-1 text-white opacity-0 transition-opacity hover:bg-red-600 group-hover:opacity-100"
                            >
                                <flux:icon.x-mark class="size-4" />
                            </button>
                            <div class="absolute bottom-2 left-2 rounded bg-blue-500 px-2 py-1 text-xs text-white">
                                Saved
                            </div>
                        </div>
                        @endforeach
                    @endif

                    {{-- New Images Being Uploaded --}}
                    @if(!empty($newImages) && count($newImages) > 0)
                        @foreach($newImages as $index => $newImage)
                        <div class="group relative aspect-square overflow-hidden rounded-lg border border-gray-200 bg-gray-100 dark:border-gray-700 dark:bg-gray-900">
                            <img src="{{ $newImage->temporaryUrl() }}" alt="New Preview" class="h-full w-full object-cover" />
                            <button 
                                type="button" 
                                wire:click="removeNewImage({{ $index }})"
                              
                                class="absolute right-2 top-2 rounded-full bg-red-500 p-1 text-white opacity-0 transition-opacity hover:bg-red-600 group-hover:opacity-100"
                            >
                                <flux:icon.x-mark class="size-4" />
                            </button>
                            <div class="absolute bottom-2 left-2 rounded bg-green-500 px-2 py-1 text-xs text-white">
                                New
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>

                @error('newImages.*')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>


            <div class="grid gap-6 md:grid-cols-2">
    
                <div>
                    <label for="room-name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                        Room Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="room-name"
                        value="{{ $room->roomName }}"
                        wire:model="roomName"
                        placeholder="e.g., Deluxe Suite" 
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-400 dark:focus:ring-blue-400"
                    />
                    @error('roomName')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

            
                <div>
                    <label for="room-number" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                        Room Number <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="room-number"
                         value="{{ $room->roomNumber }}"
                        wire:model="roomNumber"
                        placeholder="e.g., 101" 
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-400 dark:focus:ring-blue-400"
                    />
                    @error('roomNumber')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

 
                <div>
                    <label for="room-rate" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                        Room Rate (per night) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400">₱</span>
                        <input 
                            type="number" 
                            id="room-rate"
                             value="{{ $room->roomPrice }}"
                            wire:model="roomRate"
                            placeholder="0.00" 
                            step="0.01"
                            class="w-full rounded-lg border border-gray-300 bg-white py-2 pl-8 pr-4 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-400 dark:focus:ring-blue-400"
                        />
                    </div>
                    @error('roomRate')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

     
                <div>
                    <label for="room-capacity" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                        Guest Capacity <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="room-capacity"
                         value="{{ $room->capacity }}"
                        wire:model="roomCapacity"
                        placeholder="e.g., 2" 
                        min="1"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-400 dark:focus:ring-blue-400"
                    />
                    @error('roomCapacity')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                
            </div>


        
            <div>
                <label for="room-description" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                    Room Description <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="room-description"
                    wire:model="roomDescription"
                    rows="4"
                    placeholder="Describe the room features, amenities, and highlights..." 
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-400 dark:focus:ring-blue-400"
                >{{ $room->roomDescription }}</textarea>
                @error('roomDescription')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

       
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <button type="button" class="rounded-lg border border-gray-300 bg-white px-6 py-2 text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-gray-400 dark:focus:ring-offset-gray-900">
                    Cancel
                </button>
                <button class="rounded-lg bg-green-600 px-6 py-2 text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-400 dark:focus:ring-offset-gray-900">
                    Save Room
                </button>
            </div>
        </form>
    </div>
</div>