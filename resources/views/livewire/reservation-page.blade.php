<div class="flex h-full w-full flex-1 flex-col gap-6 p-6">
    <div class="flex items-center justify-between transform transition-all duration-300 hover:translate-x-1">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white transition-colors duration-300">Reservations</h1>
    </div>

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-1 gap-2 sm:max-w-md">
            <div class="relative flex-1 transition-all duration-300 hover:scale-[1.02]">
                <flux:icon.magnifying-glass
                    class="absolute left-3 top-1/2 size-5 -translate-y-1/2 text-gray-400 dark:text-gray-500 transition-transform duration-300 hover:scale-110" />
                <input type="text" placeholder="Search reservations..."
                    class="w-full rounded-lg border border-gray-300 bg-white py-2 pl-10 pr-4 text-gray-900 placeholder-gray-500 
                           transition-all duration-300 
                           focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:scale-[1.01]
                           dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 
                           dark:focus:border-blue-400 dark:focus:ring-blue-400" />
            </div>
            <button
                class="rounded-lg bg-blue-600 px-4 py-2 text-white transition-all duration-300 transform
                       hover:bg-blue-700 hover:scale-105 hover:shadow-lg active:scale-95
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                       dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400 dark:focus:ring-offset-gray-900">
                Search
            </button>
        </div>

        <button wire:navigate href="{{ route('addReservation') }}"
            class="flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-white transition-all duration-300 transform
                   hover:bg-green-700 hover:scale-105 hover:shadow-lg active:scale-95
                   focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 
                   dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-400 dark:focus:ring-offset-gray-900">
            <flux:icon.plus class="size-5 transition-transform duration-300 group-hover:rotate-90" />
            <span>Add Reservation</span>
        </button>
    </div>

    <div
        class="flex-1 overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800
               transition-all duration-300 hover:shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-900">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300
                                   transition-colors duration-300 hover:text-blue-600 dark:hover:text-blue-400">
                            Reservation Id</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300
                                   transition-colors duration-300 hover:text-blue-600 dark:hover:text-blue-400">
                            Guest Name</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300
                                   transition-colors duration-300 hover:text-blue-600 dark:hover:text-blue-400">
                            Check-in Date</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300
                                   transition-colors duration-300 hover:text-blue-600 dark:hover:text-blue-400">
                            Check-in Time</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300
                                   transition-colors duration-300 hover:text-blue-600 dark:hover:text-blue-400">
                            Check-out Date</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300
                                   transition-colors duration-300 hover:text-blue-600 dark:hover:text-blue-400">
                            Check-out Time</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300
                                   transition-colors duration-300 hover:text-blue-600 dark:hover:text-blue-400">
                            Status</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300
                                   transition-colors duration-300 hover:text-blue-600 dark:hover:text-blue-400">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($reservations as $reservation)
                        <tr
                            class="transition-all duration-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:scale-[1.01]">
                            <td
                                class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 transition-colors duration-300">
                                #{{ $reservation->id }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 transition-colors duration-300 hover:text-blue-600 dark:hover:text-blue-400">
                                {{ $reservation->guest_name }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 transition-colors duration-300">
                                {{ $reservation->check_in_date }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 transition-colors duration-300">
                                {{ $reservation->check_in_time }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 transition-colors duration-300">
                                {{ $reservation->check_out_date }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 transition-colors duration-300">
                                {{ $reservation->check_in_time }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex rounded-full px-2 py-1 text-xs font-semibold transition-all duration-300 hover:scale-110
                                             {{ $reservation->status === 'Confirmed'
                                                 ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400'
                                                 : ($reservation->status === 'Pending'
                                                     ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400'
                                                     : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400') }}">
                                    {{ $reservation->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button wire:click="$set('selectedReservation', {{ $reservation->id }})"
                                        class="rounded p-1 text-blue-600 transition-all duration-300 transform
                                               hover:bg-blue-100 hover:scale-110 active:scale-95
                                               dark:text-blue-400 dark:hover:bg-blue-900/30"
                                        title="View Details">
                                        <flux:icon.eye class="size-5" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if ($reservations->isEmpty())
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <flux:icon.calendar
                                        class="size-12 text-gray-400 dark:text-gray-600 transition-transform duration-300 hover:scale-110" />
                                    <p class="text-gray-500 dark:text-gray-400 transition-colors duration-300">No
                                        reservations found</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    @if ($selectedReservation)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm transition-all duration-300"
            wire:click="$set('selectedReservation', null)">

            <div class="relative w-full max-w-2xl mx-4 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl 
                        transform transition-all duration-300 scale-100 hover:scale-[1.01]"
                @click.stop>

                <button wire:click="$set('selectedReservation', null)"
                    class="absolute top-4 right-4 p-2 rounded-full text-gray-400 transition-all duration-300
                           hover:bg-gray-100 hover:text-gray-600 hover:rotate-90 hover:scale-110
                           dark:hover:bg-gray-700 dark:hover:text-gray-300">
                    <flux:icon.x-mark class="size-6" />
                </button>

                <div class="border-b border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <div
                            class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg transition-transform duration-300 hover:rotate-12">
                            <flux:icon.document-text class="size-6 text-blue-600 dark:text-blue-400" />
                        </div>
                        Reservation Details
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Reservation #{{ $selectedReservation }}
                    </p>
                </div>

                <div class="p-6 space-y-6 max-h-[60vh] overflow-y-auto">

                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                            <flux:icon.user
                                class="size-5 text-blue-600 dark:text-blue-400 transition-transform duration-300 hover:scale-110" />
                            Guest Information
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div
                                class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <label
                                    class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Full
                                    Name</label>
                                <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $reservations->where('id', $selectedReservation)->first()->guest_name }}</p>
                            </div>

                            <div
                                class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <label
                                    class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</label>
                                <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $reservations->where('id', $selectedReservation)->first()->guest_email }}</p>
                            </div>

                            <div
                                class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <label
                                    class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Phone</label>
                                <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $reservations->where('id', $selectedReservation)->first()->guest_phone }}</p>
                            </div>

                            <div
                                class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <label
                                    class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Number
                                    of Guests</label>
                                <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $reservations->where('id', $selectedReservation)->first()->number_of_guests }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                            <flux:icon.home
                                class="size-5 text-blue-600 dark:text-blue-400 transition-transform duration-300 hover:scale-110" />
                            Room Information
                        </h3>

                        <div
                            class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800 transition-all duration-300 hover:shadow-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-blue-900 dark:text-blue-100">
                                        {{ $reservations->where('id', $selectedReservation)->first()->room->roomName }}
                                    </p>
                                    <p class="text-xs text-blue-700 dark:text-blue-300 mt-1">
                                        {{ $reservations->where('id', $selectedReservation)->first()->room->roomDescription }}
                                    </p>
                                </div>
                                <span
                                    class="px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full transition-all duration-300 hover:scale-110">
                                    Available
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                            <flux:icon.calendar
                                class="size-5 text-blue-600 dark:text-blue-400 transition-transform duration-300 hover:scale-110" />
                            Booking Details
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div
                                class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <label
                                    class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Check-in</label>
                                <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $reservations->where('id', $selectedReservation)->first()->check_in_date }} |
                                    {{ $reservations->where('id', $selectedReservation)->first()->check_in_time }}</p>
                            </div>

                            <div
                                class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <label
                                    class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Check-out</label>
                                <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $reservations->where('id', $selectedReservation)->first()->check_out_date }} |
                                    {{ $reservations->where('id', $selectedReservation)->first()->check_in_time }}</p>
                            </div>

                            <div
                                class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <label
                                    class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Duration</label>
                                <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $reservations->where('id', $selectedReservation)->first()->stay_duration }}</p>
                            </div>

                            <div
                                class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <label
                                    class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total
                                    Price</label>
                                <p class="mt-1 text-sm font-semibold text-green-600 dark:text-green-400">
                                    {{ $reservations->where('id', $selectedReservation)->first()->price }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                            <flux:icon.information-circle
                                class="size-5 text-blue-600 dark:text-blue-400 transition-transform duration-300 hover:scale-110" />
                            Reservation Status
                        </h3>

                        <div class="flex flex-wrap gap-3">
                            <button wire:click="updateStatus('Confirmed')"
                                class="flex items-center gap-2 px-4 py-2 rounded-lg font-semibold text-sm
                                       transition-all duration-300 transform hover:scale-105 hover:shadow-lg active:scale-95
                                       bg-green-100 text-green-700 hover:bg-green-200
                                       dark:bg-green-900/30 dark:text-green-400 dark:hover:bg-green-900/50">
                                <flux:icon.check-circle class="size-5" />
                                Confirm
                            </button>

                            <button wire:click="updateStatus('Cancelled')"
                                class="flex items-center gap-2 px-4 py-2 rounded-lg font-semibold text-sm
                                       transition-all duration-300 transform hover:scale-105 hover:shadow-lg active:scale-95
                                       bg-red-100 text-red-700 hover:bg-red-200
                                       dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50">
                                <flux:icon.x-circle class="size-5" />
                                Cancel
                            </button>

                            <button wire:click="updateStatus('Pending')"
                                class="flex items-center gap-2 px-4 py-2 rounded-lg font-semibold text-sm
                                       transition-all duration-300 transform hover:scale-105 hover:shadow-lg active:scale-95
                                       bg-yellow-100 text-yellow-700 hover:bg-yellow-200
                                       dark:bg-yellow-900/30 dark:text-yellow-400 dark:hover:bg-yellow-900/50">
                                <flux:icon.clock class="size-5" />
                                Set Pending
                            </button>
                        </div>

                        <div
                            class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800 transition-all duration-300">
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-blue-800 dark:text-blue-300">Current Status:</span>

                                <span
                                    class="inline-flex rounded-full px-2 py-1 text-xs font-semibold transition-all duration-300 hover:scale-110
                                {{ $reservation->status === 'Confirmed'
                                    ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400'
                                    : ($reservation->status === 'Pending'
                                        ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400'
                                        : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400') }}">
                                    {{ $reservations->where('id', $selectedReservation)->first()->status }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

                <div
                    class="border-t border-gray-200 dark:border-gray-700 p-6 flex flex-col sm:flex-row gap-3 justify-end">
                    <button wire:click="$set('selectedReservation', null)"
                        class="px-6 py-2 rounded-lg font-semibold text-sm
                               transition-all duration-300 transform hover:scale-105 active:scale-95
                               bg-gray-100 text-gray-700 hover:bg-gray-200
                               dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                        Close
                    </button>

                    <button wire:click="editReservation({{ $selectedReservation }})"
                        class="px-6 py-2 rounded-lg font-semibold text-sm flex items-center gap-2
                               transition-all duration-300 transform hover:scale-105 hover:shadow-lg active:scale-95
                               bg-blue-600 text-white hover:bg-blue-700
                               dark:bg-blue-500 dark:hover:bg-blue-600">
                        <flux:icon.pencil-square class="size-4" />
                        Update Reservation
                    </button>
                </div>

            </div>
        </div>
    @endif

    @if ($isUpdateModalOpen)
        <div class="fixed inset-0 z-[60] flex items-center justify-center bg-black/60 backdrop-blur-md transition-all duration-300"
            wire:click="$set('isUpdateModalOpen', false)">

            <div class="relative w-full max-w-2xl mx-4 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700
                        transform transition-all duration-300 scale-100 hover:scale-[1.005]"
                @click.stop>

                <button wire:click="$set('isUpdateModalOpen', false)"
                    class="absolute top-4 right-4 p-2 rounded-full text-gray-400 transition-all duration-300
                           hover:bg-gray-100 hover:text-gray-600 hover:rotate-90 hover:scale-110
                           dark:hover:bg-gray-700 dark:hover:text-gray-300">
                    <flux:icon.x-mark class="size-6" />
                </button>

                <div class="border-b border-gray-200 dark:border-gray-700 p-6 bg-gray-50/50 dark:bg-gray-800/50 rounded-t-2xl">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <div
                            class="p-2 bg-blue-600 text-white rounded-lg shadow-lg shadow-blue-500/30 transition-transform duration-300 hover:scale-110">
                            <flux:icon.pencil-square class="size-6" />
                        </div>
                        Update Reservation
                    </h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 ml-14">
                        Editing reservation #{{ $selectedReservation }}
                    </p>
                </div>

                <div class="p-6 max-h-[60vh] overflow-y-auto custom-scrollbar">
                    <form wire:submit.prevent="updateReservation" class="space-y-6">

                        <div class="space-y-4">
                            <h3
                                class="text-sm font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400 flex items-center gap-2">
                                <flux:icon.user class="size-4" /> Guest Details
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="text-xs font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                                    <input type="text" wire:model="guest_name"
                                        class="w-full rounded-lg border-gray-300 bg-white py-2 px-3 text-sm text-gray-900 
                                               transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                               dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:border-blue-400">
                                    @error('guest_name') <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label class="text-xs font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                                    <input type="email" wire:model="guest_email"
                                        class="w-full rounded-lg border-gray-300 bg-white py-2 px-3 text-sm text-gray-900 
                                               transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                               dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:border-blue-400">
                                    @error('guest_email') <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label class="text-xs font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                                    <input type="tel" wire:model="guest_phone"
                                        class="w-full rounded-lg border-gray-300 bg-white py-2 px-3 text-sm text-gray-900 
                                               transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                               dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:border-blue-400">
                                </div>

                                <div class="space-y-1">
                                    <label class="text-xs font-medium text-gray-700 dark:text-gray-300">Guests</label>
                                    <input type="number" min="1" wire:model="number_of_guests"
                                        class="w-full rounded-lg border-gray-300 bg-white py-2 px-3 text-sm text-gray-900 
                                               transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                               dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:border-blue-400">
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-200 dark:border-gray-700">

                        <div class="space-y-4">
                            <h3
                                class="text-sm font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400 flex items-center gap-2">
                                <flux:icon.calendar-days class="size-4" /> Schedule
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="text-xs font-medium text-gray-700 dark:text-gray-300">Check-in Date</label>
                                    <input type="date" wire:model="check_in_date"
                                        class="w-full rounded-lg border-gray-300 bg-white py-2 px-3 text-sm text-gray-900 
                                               transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                               dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:border-blue-400">
                                </div>

                                <div class="space-y-1">
                                    <label class="text-xs font-medium text-gray-700 dark:text-gray-300">Check-in Time</label>
                                    <input type="time" wire:model="check_in_time"
                                        class="w-full rounded-lg border-gray-300 bg-white py-2 px-3 text-sm text-gray-900 
                                               transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                               dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:border-blue-400">
                                </div>

                                <div class="space-y-1">
                                    <label class="text-xs font-medium text-gray-700 dark:text-gray-300">Check-out Date</label>
                                    <input type="date" wire:model="check_out_date"
                                        class="w-full rounded-lg border-gray-300 bg-white py-2 px-3 text-sm text-gray-900 
                                               transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                               dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:border-blue-400">
                                </div>

                                <div class="space-y-1">
                                    <label class="text-xs font-medium text-gray-700 dark:text-gray-300">Reservation
                                        Status</label>
                                    <div class="relative">
                                        <flux:icon.chevron-down
                                            class="absolute right-3 top-1/2 -translate-y-1/2 size-4 text-gray-400 pointer-events-none" />
                                        <select wire:model="status"
                                            class="w-full appearance-none rounded-lg border-gray-300 bg-white py-2 px-3 text-sm text-gray-900 
                                                   transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                                   dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:border-blue-400">
                                            <option value="Confirmed">Confirmed</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div
                    class="border-t border-gray-200 dark:border-gray-700 p-6 flex flex-col sm:flex-row gap-3 justify-end bg-gray-50/50 dark:bg-gray-800/50 rounded-b-2xl">
                    <button wire:click="$set('isUpdateModalOpen', false)"
                        class="px-6 py-2.5 rounded-lg font-semibold text-sm transition-all duration-300 transform hover:scale-105 active:scale-95
                               bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:shadow-sm
                               dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">
                        Cancel
                    </button>

                    <button wire:click="updateReservation"
                        class="flex items-center justify-center gap-2 px-6 py-2.5 rounded-lg font-semibold text-sm text-white
                               bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800
                               transition-all duration-300 transform hover:scale-105 hover:shadow-lg hover:shadow-blue-500/25 active:scale-95
                               dark:from-blue-500 dark:to-blue-600 dark:hover:from-blue-600 dark:hover:to-blue-700">
                        <flux:icon.check class="size-4" />
                        Save Changes
                    </button>
                </div>

            </div>
        </div>
    @endif

</div>