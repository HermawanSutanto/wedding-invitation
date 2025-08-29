<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight playfair-display">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($invitation)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    {{-- Kolom Kiri --}}
                    <div class="lg:col-span-2 space-y-8">
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-shadow duration-300 hover:shadow-xl">
                            <div class="p-4 bg-gray-50 border-b">
                                <h3 class="font-bold text-gray-700 uppercase tracking-wider text-sm">Your Wedding Invitation</h3>
                            </div>
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <img src="{{ $invitation->hero_image ? asset('storage/' . $invitation->hero_image) : 'https://images.unsplash.com/photo-1595736250103-05992f055955' }}" 
                                         alt="Wedding Image" class="w-full md:w-1/3 h-48 object-cover rounded-xl">
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <p class="text-xs text-gray-500 uppercase font-semibold">Wedding Invitation for:</p>
                                            <span class="text-xs font-semibold inline-block py-1 px-3 uppercase rounded-full {{ $invitation->status == 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                                {{ $invitation->status }}
                                            </span>
                                        </div>
                                        <h4 class="text-3xl lg:text-4xl font-bold text-gray-800 playfair-display my-2">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h4>
                                        @if($invitation->events->first())
                                        <div class="text-sm text-gray-600 mt-3">
                                            <p><strong class="font-semibold text-gray-700">Event Date:</strong> {{ \Carbon\Carbon::parse($invitation->events->first()->event_date)->isoFormat('D MMMM YYYY') }}</p>
                                            @if(\Carbon\Carbon::parse($invitation->events->first()->event_date)->isFuture())
                                                <p class="text-xs text-gray-500">({{ \Carbon\Carbon::parse($invitation->events->first()->event_date)->diffInDays(now()) }} days left)</p>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-6 space-y-4 pt-6 border-t">
                                    @include('dashboard.link-generator', ['invitation' => $invitation])
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-shadow duration-300 hover:shadow-xl">
                             <div class="p-4 bg-gray-50 border-b">
                                <h3 class="font-bold text-gray-700 uppercase tracking-wider text-sm">Guest Statistics (RSVP)</h3>
                            </div>
                            <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                                <div class="p-6 bg-blue-50 rounded-xl">
                                    <p class="text-4xl font-bold text-blue-600">{{ $totalRsvp }}</p>
                                    <p class="text-sm text-gray-500 mt-1 font-semibold">Total Confirmations</p>
                                </div>
                                <div class="p-6 bg-green-50 rounded-xl">
                                    <p class="text-4xl font-bold text-green-600">{{ $attendingCount }}</p>
                                    <p class="text-sm text-gray-500 mt-1 font-semibold">Will Attend</p>
                                </div>
                                <div class="p-6 bg-red-50 rounded-xl">
                                    <p class="text-4xl font-bold text-red-600">{{ $notAttendingCount }}</p>
                                    <p class="text-sm text-gray-500 mt-1 font-semibold">Not Attending</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-lg p-6 transition-shadow duration-300 hover:shadow-xl">
                            <h3 class="font-bold text-gray-700 mb-4 uppercase tracking-wider text-sm">Quick Actions</h3>
                            <div class="flex flex-col space-y-3">
                                <a href="{{ route('invitation.public.show', $invitation->slug) }}" target="_blank" class="quick-action-btn bg-green-500 hover:bg-green-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    View Invitation
                                </a>
                                <a href="{{ route('invitation.edit', $invitation) }}" class="quick-action-btn bg-blue-500 hover:bg-blue-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit Invitation
                                </a>
                                <a href="{{ route('invitation.index') }}" class="quick-action-btn bg-gray-600 hover:bg-gray-700">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    Manage Invitations
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Kartu jika belum punya undangan --}}
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl">
                    <div class="p-8 text-center text-gray-900">
                        <h3 class="text-xl font-semibold mb-2">Welcome, {{ Auth::user()->name }}!</h3>
                        <p class="text-gray-600 mb-6">You don't have an invitation yet. Lets create your first!</p>
                        <a href="{{ route('templates.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-semibold text-white uppercase tracking-widest hover:bg-indigo-700">
                            + Create Your First Invitation
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>