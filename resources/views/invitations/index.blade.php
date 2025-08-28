<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Undangan Saya') }}
            </h2>
            @if($invitations->isEmpty())
                <a href="{{ route('templates.index') }}" class="inline-flex items-center px-4 py-2 ...">
                    + Buat Undangan Baru
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mempelai</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Acara</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($invitations as $invitation)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{-- Ambil tanggal dari acara pertama --}}
                                                {{ \Carbon\Carbon::parse($invitation->events->first()->event_date)->isoFormat('D MMMM YYYY') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $invitation->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ ucfirst($invitation->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('invitation.public.show', $invitation->slug) }}" class="text-indigo-600 hover:text-indigo-900">Lihat</a>
                                            <a href="{{ route('invitation.edit', $invitation) }}" class="ml-4 text-blue-600 hover:text-blue-900">Edit</a>
                                            {{-- 2. GANTI LINK HAPUS DENGAN FORM INI --}}
                                            <form class="inline" action="{{ route('invitation.destroy', $invitation) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus undangan ini secara permanen? Semua data terkait akan hilang.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="ml-4 text-red-600 hover:text-red-900">Hapus</button>
                                            </form>                                        
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center">
                                            <p class="text-gray-500">Anda belum memiliki undangan. <a href="{{ route('templates.index') }}" class="text-indigo-600 hover:underline">Buat sekarang!</a></p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>