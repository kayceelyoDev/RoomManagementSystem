<div class="min-h-screen p-6 transition-colors duration-300">
    {{-- The Master doesn't talk, he acts. --}}

    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Front Desk Check-In</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage arriving guests and process payments</p>
        </div>
        <div class="flex gap-3 mt-4 md:mt-0">
            <div class="relative">
                <input wire:model.live="search" type="text" placeholder="Search guest name or ID..."
                    class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg 
                           bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 
                           focus:ring-blue-500 focus:border-blue-500 w-64 placeholder-gray-400 dark:placeholder-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-2.5"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <button
                class="flex items-center gap-2 px-4 py-2 rounded-lg border transition-colors
                           bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 
                           text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Filter
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($reservations as $res)
            <div wire:click="selectReservation({{ $res['id'] }})"
                class="relative overflow-hidden rounded-xl shadow-sm border p-5 cursor-pointer transition duration-200 group
                    bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700 
                    hover:shadow-md hover:border-blue-400 dark:hover:border-blue-500">

                <div class="flex justify-between items-start mb-4 pl-3">
                    <div>
                        <h3
                            class="font-bold text-lg text-gray-800 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            {{ $res['guest_name'] }}
                        </h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Res ID: #{{ $res['id'] }}</p>
                    </div>
                    <span
                        class="px-2 py-1 text-xs font-semibold rounded-full 
    {{ $res['status'] === 'Confirmed'
        ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300'
        : ($res['status'] === 'Cancelled'
            ? 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300'
            : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300') }}">
                        {{ $res['status'] }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-300 pl-3">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span>Rm {{ $res->room->roomName }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $res['check_in_date'] }}</span>
                    </div>
                </div>

                <div
                    class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center pl-3">
                    <span
                        class="text-xs font-medium {{ match ($res->room->status) {
                            'Available' => 'text-green-600 dark:text-green-400',
                            'Occupied' => 'text-red-600 dark:text-red-400',
                            'Reserved' => 'text-orange-500 dark:text-orange-400',
                            'Maintenance' => 'text-gray-600 dark:text-gray-400',
                            'Cleaning' => 'text-blue-500 dark:text-blue-400',
                            default => 'text-gray-500',
                        } }}">
                        ● {{ $res->room->status }}
                    </span>
                    <span
                        class="text-sm font-bold text-gray-900 dark:text-white">${{ number_format($res['price'], 2) }}</span>
                </div>
            </div>
        @endforeach
    </div>

    @if ($showCheckInModal && $selectedReservation)
        <div wire:transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50 dark:bg-black/70 backdrop-blur-sm p-4">

            <div wire:transition.scale.origin.center
                class="w-full max-w-5xl overflow-hidden rounded-2xl shadow-2xl flex flex-col md:flex-row h-auto max-h-[90vh]
                    bg-white dark:bg-gray-800 transition-colors duration-300">

                <div
                    class="w-full md:w-1/2 p-8 border-r border-gray-200 dark:border-gray-700 overflow-y-auto
                        bg-gray-50 dark:bg-gray-900/50">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Reservation Details</h2>

                    <div
                        class="flex items-center gap-4 mb-6 p-4 rounded-xl border 
                            bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700">
                        <div
                            class="h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 font-bold text-lg">
                            {{ substr($selectedReservation['guest_name'], 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 dark:text-white">
                                {{ $selectedReservation['guest_name'] }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">ID Verified: Pending</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-y-6 gap-x-4 mb-8 text-gray-800 dark:text-gray-200">
                        <div>
                            <label class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase">Check
                                In</label>
                            <p class="font-medium">{{ $selectedReservation['check_in_date'] }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase">Check
                                Out</label>
                            <p class="font-medium">{{ $selectedReservation['check_out_date'] }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase">Room
                                Type</label>
                            <p class="font-medium">{{ $selectedReservation->room->roomName }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase">Assigned
                                Room</label>
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-xs font-medium {{ match ($res->room->status) {
                                        'Available' => 'text-green-600 dark:text-green-400',
                                        'Occupied' => 'text-red-600 dark:text-red-400',
                                        'Reserved' => 'text-orange-500 dark:text-orange-400',
                                        'Maintenance' => 'text-gray-600 dark:text-gray-400',
                                        'Cleaning' => 'text-blue-500 dark:text-blue-400',
                                        default => 'text-gray-500',
                                    } }}">
                                    ● {{ $res->room->status }}
                                </span>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="w-full md:w-1/2 p-8 flex flex-col justify-between bg-white dark:bg-gray-800">
                    <div>
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Payment & Confirm</h2>
                            <button wire:click="closeCheckInModal"
                                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="space-y-3 mb-8">
                            <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                <span>Room Charge</span>
                                <span>${{ number_format($selectedReservation['price'], 2) }}</span>
                            </div>


                            <div
                                class="border-t border-dashed border-gray-300 dark:border-gray-600 pt-3 flex justify-between items-center">
                                <span class="font-bold text-lg text-gray-800 dark:text-white">Total Due</span>
                                <span
                                    class="font-bold text-2xl text-blue-600 dark:text-blue-400">${{ number_format($selectedReservation['price'], 2) }}</span>
                            </div>
                        </div>

                        <div
                            class="p-4 rounded-xl border mb-6 transition-colors
                                bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-700">
                            <label
                                class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-2">Payment
                                Method</label>
                            <div class="grid grid-cols-3 gap-2 mb-4">
                                @foreach (['cash' => 'Cash'] as $method => $label)
                                    <button wire:click="$set('paymentMethod', '{{ $method }}')"
                                        class="py-2 rounded-lg text-sm font-medium border transition-colors
                                    {{ $paymentMethod === $method
                                        ? 'bg-blue-600 text-white border-blue-600 dark:bg-blue-500 dark:border-blue-500'
                                        : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                        {{ $label }}
                                    </button>
                                @endforeach
                            </div>

                            <label
                                class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-2">Amount
                                Tendered</label>
                            <div class="relative">
                                <span
                                    class="absolute left-3 top-2.5 text-gray-500 dark:text-gray-400 font-bold">$</span>
                                <input wire:model.live="amountTendered" type="number" step="0.01"
                                    class="w-full pl-8 pr-4 py-2 rounded-lg text-lg font-bold border transition-colors
                                       bg-white dark:bg-gray-800 
                                       text-gray-800 dark:text-white
                                       border-gray-300 dark:border-gray-600 
                                       focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div
                                class="mt-4 flex justify-between items-center px-3 py-2 rounded border
                                    bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Change /
                                    Balance</span>
                                <span
                                    class="font-bold text-lg {{ $this->change > 0 ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-gray-500' }}">
                                    ${{ number_format($this->change, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button wire:click="closeCheckInModal"
                            class="w-1/3 py-3 border rounded-xl font-bold transition-colors
                               border-gray-300 dark:border-gray-600 
                               text-gray-700 dark:text-gray-300 
                               hover:bg-gray-50 dark:hover:bg-gray-700">
                            Cancel
                        </button>
                        <button wire:click="createCheckin"
                            class="w-2/3 py-3 rounded-xl font-bold text-lg shadow-lg flex items-center justify-center gap-2 transition-all
                               text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-500
                               disabled:opacity-50 disabled:cursor-not-allowed"
                            {{ $amountTendered < $this->balance && $paymentMethod === 'cash' ? 'disabled' : '' }}>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Confirm Check-In
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
