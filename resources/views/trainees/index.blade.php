@extends('layouts.app')

@section('title', 'Trainees List')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 pb-4 border-b border-border-dark/50">
        <h2 class="text-3xl font-bold text-gray-100 mb-4 md:mb-0">All Trainees</h2>
        <a href="{{ route('trainees.create') }}" class="flex items-center gap-1 px-4 py-2 bg-accent-orange/90 hover:bg-accent-orange text-gray-900 font-semibold rounded-lg transition-all duration-200 shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add New Trainee
        </a>
    </div>

    
    <div class="bg-primary-dark/50 p-6 rounded-xl shadow-lg overflow-x-auto border border-border-dark/70">
        <table class="min-w-full divide-y divide-border-dark">
            <thead class="bg-primary-dark/80">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">
                        Full Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider hidden sm:table-cell">
                        Gender
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider hidden lg:table-cell">
                        Trade / Level
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider hidden xl:table-cell">
                        Guardian
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-dark">
                @forelse($trainees as $trainee)
                <tr class="hover:bg-primary-dark/60 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-300">
                        {{ $trainee->traineeId }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-white">{{ $trainee->tFirstName }} {{ $trainee->tLastName }}</div>
                        <div class="text-xs text-gray-400 sm:hidden">{{ $trainee->trade->TradeName ?? 'N/A' }} (L{{ $trainee->Level }})</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 hidden sm:table-cell">
                        {{ $trainee->tGender }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                        <div class="text-sm text-accent-purple font-medium">{{ $trainee->trade->TradeName ?? 'N/A' }}</div>
                        <div class="text-xs text-gray-500">Level: {{ $trainee->Level }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 hidden xl:table-cell">
                        {{ $trainee->parent->pFirstName ?? 'N/A' }} {{ $trainee->parent->pLastName ?? '' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{ route('trainees.show', $trainee->traineeId) }}" title="View Profile" class="text-blue-400 hover:text-blue-300 p-1 rounded-full transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            <a href="{{ route('trainees.edit', $trainee->traineeId) }}" title="Edit Details" class="text-yellow-400 hover:text-yellow-300 p-1 rounded-full transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-9-4l9-9m-3 9l9-9"></path></svg>
                            </a>
                            <form action="{{ route('trainees.destroy', $trainee->traineeId) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete {{ $trainee->tFirstName }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete Trainee" class="text-red-400 hover:text-red-300 p-1 rounded-full transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-lg text-gray-500 italic">
                        No trainees registered yet. Click 'Add New Trainee' to begin!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection