<div class="flex h-full w-full flex-1 flex-col gap-6 p-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Rooms</h1>
    </div>

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-1 gap-2 sm:max-w-md">
            <div class="relative flex-1">
                <flux:icon.magnifying-glass
                    class="absolute left-3 top-1/2 size-5 -translate-y-1/2 text-gray-400 dark:text-gray-500" />
                <input type="text" placeholder="Search rooms..."
                    class="w-full rounded-lg border border-gray-300 bg-white py-2 pl-10 pr-4 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-400 dark:focus:ring-blue-400" />
            </div>
            <button
                class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400 dark:focus:ring-offset-gray-900">
                Search
            </button>
        </div>

        @if (in_array(auth()->user()->role, ['admin', 'supper_admin']))
            <a href="{{ route('addroom') }}"
                class="flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-400 dark:focus:ring-offset-gray-900">
                <flux:icon.plus class="size-5" />
                <span>Add Room</span>
            </a>
        @endif
    </div>

    @if($rooms->count() > 0)
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($rooms as $room)
                <div class="group flex flex-col justify-between rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition-all hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
                    
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Room Number
                            </p>
                            <h3 class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $room->roomNumber }}
                            </h3>
                        </div>
                        <span class="inline-flex rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">
                            {{ $room->status }}
                        </span>
                    </div>

                    <div class="mt-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Room Name</p>
                        <p class="font-medium text-gray-900 dark:text-gray-200">{{ $room->roomName }}</p>
                    </div>

                    <hr class="my-4 border-gray-100 dark:border-gray-700" />

                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('viewRoom', $room->id) }}"
                            class="flex items-center justify-center rounded-lg bg-gray-100 p-2 text-gray-600 transition-colors hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600"
                            title="View Details">
                            <flux:icon.eye class="size-5" />
                        </a>

                        @if (in_array(auth()->user()->role, ['admin', 'supper_admin']))
                            <a href="{{ route('roomUpdate', $room->id) }}"
                                class="flex items-center justify-center rounded-lg bg-blue-50 p-2 text-blue-600 transition-colors hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-400 dark:hover:bg-blue-900/40"
                                title="Edit">
                                <flux:icon.pencil class="size-5" />
                            </a>

                            <button wire:click="deleteRoom({{ $room->id }})"
                                class="flex items-center justify-center rounded-lg bg-red-50 p-2 text-red-600 transition-colors hover:bg-red-100 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/40"
                                title="Delete">
                                <flux:icon.trash class="size-5" />
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-1 flex-col items-center justify-center rounded-xl border border-dashed border-gray-300 bg-gray-50 py-12 dark:border-gray-700 dark:bg-gray-800/50">
            <div class="flex flex-col items-center gap-3 text-center">
                <div class="rounded-full bg-gray-100 p-3 dark:bg-gray-800">
                    <flux:icon.home class="size-8 text-gray-400 dark:text-gray-500" />
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">No rooms found</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Get started by creating a new room.</p>
                </div>
            </div>
        </div>
    @endif
</div>