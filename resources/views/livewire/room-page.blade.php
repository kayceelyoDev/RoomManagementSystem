<div class="flex h-full w-full flex-1 flex-col gap-6 p-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Rooms</h1>
    </div>

    <!-- Search and Add Section -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <!-- Search -->
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

        <!-- Add Room Button -->

        @if (in_array(auth()->user()->role, ['admin', 'supper_admin']))
            <a href="{{ route('addroom') }}"
                class="flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-400 dark:focus:ring-offset-gray-900">
                <flux:icon.plus class="size-5" />
                <span>Add Room</span>
            </a>
        @endif

    </div>

    <!-- Rooms Table -->
    <div
        class="flex-1 overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-900">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">
                            Room Number</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">
                            Room Name</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">
                            Availability</th>

                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                    @foreach ($rooms as $room)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $room->roomNumber }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $room->roomName }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex rounded-full px-2 py-1 text-xs font-semibold text-white ">{{ $room->status }}</span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('viewRoom', $room->id) }}"
                                        class="rounded p-1 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700"
                                        title="View">
                                        <flux:icon.eye class="size-5" />
                                    </a>
                                    <a href="{{ route('roomUpdate',$room->id) }}"
                                        class="rounded p-1 text-blue-600 hover:bg-blue-100 dark:text-blue-400 dark:hover:bg-blue-900/30"
                                        title="Edit">
                                        <flux:icon.pencil class="size-5" />
                                    </a>

                                    <button
                                        class="rounded p-1 text-red-600 hover:bg-red-100 dark:text-red-400 dark:hover:bg-red-900/30"
                                        title="Delete">
                                        <flux:icon.trash class="size-5" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <!-- Sample Row 2 - Occupied & Cleaning -->



                    <!-- Empty State (show when no rooms) -->
                    <tr class="hidden">
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <flux:icon.home class="size-12 text-gray-400 dark:text-gray-600" />
                                <p class="text-gray-500 dark:text-gray-400">No rooms found</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
