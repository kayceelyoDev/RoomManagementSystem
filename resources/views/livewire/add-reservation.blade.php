<div class="flex h-full w-full flex-col gap-6 p-6 bg-gray-50 dark:bg-gray-900">

    <!-- Header -->
    <div class="flex items-center justify-between transform transition-all duration-300 hover:translate-x-1">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white transition-colors duration-300">Add New
                Reservation</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 transition-colors duration-300">
                Select a room and check availability
            </p>
        </div>
        <flux:button wire:navigate href="{{ url('/dashboard/reservation') }}" variant="ghost"
            class="transition-all duration-300 hover:scale-105 hover:shadow-lg">
            <flux:icon.arrow-left class="size-4" />
            Back
        </flux:button>
    </div>

    <!-- Main Container -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 min-h-[700px]">

        <!-- LEFT COLUMN -->
        <div class="flex flex-col gap-6">

            <!-- Room Selection Card -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 h-full 
                        transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 transition-colors duration-300">
                    Select Room</h2>

                <div class="space-y-4 max-h-[350px] overflow-y-auto pr-2">
                    @foreach ($rooms as $room)
                        <div wire:click="$set('selectedRoom', {{ $room->id }})"
                            class="cursor-pointer rounded-lg border border-gray-200 dark:border-gray-700 p-4 
                                   transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg
                                   {{ $selectedRoom === $room->id
                                       ? 'ring-2 ring-blue-500 bg-blue-50 dark:bg-blue-900/20 scale-[1.02]'
                                       : 'hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30
                                                transition-all duration-300 hover:rotate-12 hover:scale-110">
                                        <flux:icon.home
                                            class="size-5 text-blue-600 dark:text-blue-400 transition-colors duration-300" />
                                    </div>
                                    <div>
                                        <h3
                                            class="font-semibold text-gray-900 dark:text-white transition-colors duration-300 
                                                   hover:text-blue-600 dark:hover:text-blue-400">
                                            {{ $room->roomNumber }} | {{ $room->roomName }}
                                        </h3>
                                        <p
                                            class="text-sm text-gray-600 dark:text-gray-400 transition-colors duration-300">
                                            {{ $room->roomDescription }} · {{ $room->capacity }} Guests ·
                                            <span
                                                class="font-semibold text-blue-600 dark:text-blue-400">₱{{ $room->roomPrice }}</span>/night
                                        </p>
                                    </div>
                                </div>
                                <flux:badge color="{{ $room->status === 'available' ? 'green' : 'red' }}" size="sm"
                                    class="transition-all duration-300 hover:scale-110">
                                    {{ $room->status }}
                                </flux:badge>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($selectedRoom)
                    <div
                        class="mt-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800
                                transition-all duration-500 transform scale-100 hover:scale-[1.02]">
                        <p class="text-sm text-blue-800 dark:text-blue-300 flex items-center gap-1">
                            <flux:icon.check-circle
                                class="size-4 transition-transform duration-300 hover:rotate-[360deg]" />
                            Room {{ $selectedRoom }} selected
                        </p>
                    </div>
                @endif
            </div>

            <!-- Guest Information Form -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6
                        transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 transition-colors duration-300">
                    Guest Information</h2>

                @if ($errorMessage)
                    <div
                        class="mb-4 p-3 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-900 dark:text-red-300
                                transition-all duration-300 hover:shadow-lg">
                        {{ $errorMessage }}
                    </div>
                @endif

                @if (session()->has('success'))
                    <div
                        class="mb-4 p-3 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-300
                                transition-all duration-300 hover:shadow-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit.prevent="addReservation" class="space-y-4">
                    <div class="transition-all duration-300 hover:translate-x-1">
                        <flux:input wire:model="guestName" label="Full Name" placeholder="Enter guest name" required
                            class="transition-all duration-300 focus:scale-[1.01]" />
                    </div>

                    <div class="transition-all duration-300 hover:translate-x-1">
                        <flux:input wire:model="guestEmail" type="email" label="Email"
                            placeholder="guest@example.com" required
                            class="transition-all duration-300 focus:scale-[1.01]" />
                    </div>

                    <div class="transition-all duration-300 hover:translate-x-1">
                        <flux:input wire:model="guestPhone" type="tel" label="Phone Number"
                            placeholder="+63 912 345 6789" required
                            class="transition-all duration-300 focus:scale-[1.01]" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="transition-all duration-300 hover:translate-y-[-2px]">
                            <flux:input wire:model="checkInDate" type="date" label="Check-in Date" required
                                class="transition-all duration-300 focus:scale-[1.01]" />
                        </div>
                        <div class="transition-all duration-300 hover:translate-y-[-2px]">
                            <flux:input wire:model="checkInTime" type="time" label="Check-in Time" required
                                class="transition-all duration-300 focus:scale-[1.01]" />
                        </div>
                        <div class="transition-all duration-300 hover:translate-y-[-2px]">
                            <flux:input wire:model="checkOutDate" type="date" label="Check-out Date" required
                                class="transition-all duration-300 focus:scale-[1.01]" />
                        </div>
                        <div class="gap-4 transition-all duration-300 hover:translate-x-1">
                            <flux:input wire:model="numberOfGuests" type="number" label="Guests" min="1"
                                required class="transition-all duration-300 focus:scale-[1.01]" />
                        </div>

                    </div>


                    <flux:button type="submit" variant="primary"
                        class="w-full transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl 
                               active:scale-95">
                        Create Reservation
                    </flux:button>
                </form>
            </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="flex flex-col gap-6">

            <!-- Calendar Component -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 flex flex-col h-full
                        transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">

                <!-- Header -->
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white transition-colors duration-300">
                        {{ \Illuminate\Support\Carbon::create($currentYear, $currentMonth, 1)->format('F Y') }}
                    </h2>
                    <div class="flex gap-2">
                        <flux:button wire:click="previousMonth" variant="ghost" size="sm" square
                            class="transition-all duration-300 hover:scale-110 hover:bg-blue-50 dark:hover:bg-blue-900/20 
                                   active:scale-95">
                            <flux:icon.chevron-left />
                        </flux:button>
                        <flux:button wire:click="nextMonth" variant="ghost" size="sm" square
                            class="transition-all duration-300 hover:scale-110 hover:bg-blue-50 dark:hover:bg-blue-900/20 
                                   active:scale-95">
                            <flux:icon.chevron-right />
                        </flux:button>
                    </div>
                </div>

                <!-- Weekday Headers -->
                <div
                    class="grid grid-cols-7 gap-2 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">
                    @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                        <div
                            class="transition-all duration-300 hover:text-blue-600 dark:hover:text-blue-400 hover:scale-110">
                            {{ $day }}
                        </div>
                    @endforeach
                </div>

                <!-- Calendar Grid -->
                <div class="grid grid-cols-7 gap-2">
                    @foreach ($calendarDays as $index => $day)
                        @if ($day instanceof \Illuminate\Support\Carbon)
                            @php
                                $isToday = $day->isToday();
                                $isSelected = $selectedDate === $day->format('Y-m-d');

                                // Get the latest reservation for this day (exclude cancelled)
                                $reservationForDay = $reservations
                                    ->where('check_in_date', '<=', $day->format('Y-m-d'))
                                    ->where('check_out_date', '>=', $day->format('Y-m-d'))
                                    ->where('status', '!=', 'Cancelled') // ignore cancelled
                                    ->sortByDesc('created_at') // latest first
                                    ->first();

                                $bgColor =
                                    'bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600';

                                if ($isToday && !$reservationForDay) {
                                    $bgColor = 'bg-blue-500 text-white font-semibold hover:bg-blue-600';
                                }

                                if ($reservationForDay) {
                                    if ($reservationForDay->status === 'Pending') {
                                        $bgColor =
                                            'bg-yellow-400 dark:bg-yellow-500 text-gray-900 dark:text-gray-900 font-medium hover:bg-yellow-500';
                                    } elseif ($reservationForDay->status === 'Confirmed') {
                                        $bgColor =
                                            'bg-green-600 dark:bg-green-900 text-white font-medium hover:dark:bg-red-800';
                                    }
                                }
                            @endphp

                            <div wire:click="selectDate({{ $day->day }})"
                                class="aspect-square flex items-center justify-center rounded-lg cursor-pointer 
                                       transition-all duration-300 transform hover:scale-110 hover:shadow-lg 
                                       active:scale-95 {{ $bgColor }} 
                                       {{ $isSelected ? 'ring-2 ring-blue-600 ring-offset-2 scale-105' : '' }}">
                                {{ $day->day }}
                            </div>
                        @else
                            <div class="aspect-square"></div>
                        @endif
                    @endforeach
                </div>

                <!-- Legend -->
                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 flex flex-wrap gap-4 text-xs">
                    <div class="flex items-center gap-2 transition-all duration-300 hover:scale-110 cursor-pointer">
                        <div
                            class="w-3 h-3 rounded-full bg-blue-500 transition-transform duration-300 hover:rotate-180">
                        </div>
                        <span class="text-gray-600 dark:text-gray-400">Today</span>
                    </div>
                    <div class="flex items-center gap-2 transition-all duration-300 hover:scale-110 cursor-pointer">
                        <div
                            class="w-3 h-3 rounded-full bg-yellow-400 transition-transform duration-300 hover:rotate-180">
                        </div>
                        <span class="text-gray-600 dark:text-gray-400">Pending</span>
                    </div>
                    <div class="flex items-center gap-2 transition-all duration-300 hover:scale-110 cursor-pointer">
                        <div
                            class="w-3 h-3 rounded-full dark:bg-red-900 transition-transform duration-300 hover:rotate-180">
                        </div>
                        <span class="text-gray-600 dark:text-gray-400">Confirmed</span>
                    </div>
                    <div class="flex items-center gap-2 transition-all duration-300 hover:scale-110 cursor-pointer">
                        <div
                            class="w-3 h-3 rounded-full bg-red-500 transition-transform duration-300 hover:rotate-180">
                        </div>
                        <span class="text-gray-600 dark:text-gray-400">Other</span>
                    </div>
                </div>

                @if ($selectedRoom)
                    <div
                        class="mt-4 p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700
                                transition-all duration-300 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-600">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                            <flux:icon.home
                                class="size-4 text-blue-600 dark:text-blue-400 transition-transform duration-300 hover:scale-125" />
                            Reservations for Room {{ $selectedRoom }}
                        </h3>

                        @if ($roomReservations->isEmpty())
                            <p
                                class="text-xs text-gray-600 dark:text-gray-400 flex items-center gap-1 transition-all duration-300 hover:text-gray-800 dark:hover:text-gray-200">
                                No reservations for this room.
                            </p>
                        @else
                            <ul class="space-y-2 max-h-60 overflow-y-auto">
                                @foreach ($roomReservations as $reservation)
                                    <li
                                        class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg flex flex-col md:flex-row md:justify-between gap-2 md:gap-0 items-start md:items-center
                                               transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-600 hover:shadow-md hover:scale-[1.02]">
                                        <div class="flex items-center gap-2">
                                            <flux:icon.user
                                                class="size-4 text-blue-500 dark:text-blue-300 transition-transform duration-300 hover:scale-125" />
                                            <span
                                                class="text-sm text-gray-900 dark:text-white transition-colors duration-300 hover:text-blue-600 dark:hover:text-blue-400">
                                                {{ $reservation->guest_name }}
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <flux:icon.calendar
                                                class="size-4 text-green-500 dark:text-green-300 transition-transform duration-300 hover:scale-125" />
                                            <span
                                                class="text-xs text-gray-600 dark:text-gray-300 transition-colors duration-300">
                                                {{ $reservation->check_in_date }} - {{ $reservation->check_out_date }}
                                            </span>
                                        </div>
                                        <flux:badge
                                            color="{{ $reservation->status === 'Pending' ? 'yellow' : ($reservation->status === 'Confirmed' ? 'green' : 'red') }}"
                                            size="sm" class="transition-all duration-300 hover:scale-110">
                                            {{ ucfirst($reservation->status) }}
                                        </flux:badge>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif

            </div>

        </div>
    </div>
</div>
