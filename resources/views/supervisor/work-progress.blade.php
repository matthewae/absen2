@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Staff Work Progress</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @foreach($workProgresses as $progress)
    <div class="bg-white shadow-md rounded-lg p-6 mb-4">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="text-xl font-semibold">{{ $progress->company_name }}</h3>
                <p class="text-gray-600">{{ $progress->staff->name }}</p>
            </div>
            <span class="px-3 py-1 rounded-full text-sm
                @if($progress->status == 'complete') bg-green-100 text-green-800
                @elseif($progress->status == 'revision') bg-red-100 text-red-800
                @else bg-blue-100 text-blue-800
                @endif">
                {{ $progress->status }}
            </span>
        </div>

        <div class="mb-4">
            <p class="text-gray-700 font-medium">Project Topic:</p>
            <p>{{ $progress->project_topic }}</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-700 font-medium">Work Description:</p>
            <p class="whitespace-pre-line">{{ $progress->work_description }}</p>
        </div>

        @if($progress->files->count() > 0)
        <div class="mt-4">
            <p class="text-gray-700 font-medium mb-2">Attached Files:</p>
            <div class="space-y-2">
                @foreach($progress->files as $file)
                <div class="flex items-center justify-between bg-gray-50 p-3 rounded">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                        <span class="text-sm">{{ $file->file_name }}</span>
                        <span class="text-xs text-gray-500 ml-2">({{ number_format($file->file_size / 1024, 2) }} KB)</span>
                    </div>
                    <a href="{{ route('work-progress.download', $file->id) }}" 
                       class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                        Download
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="mt-4 flex justify-end space-x-3">
            <form action="{{ route('supervisor.work-progress.update-status', $progress->id) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <select name="status" onchange="this.form.submit()" 
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="On progress" {{ $progress->status == 'On progress' ? 'selected' : '' }}>On Progress</option>
                    <option value="complete" {{ $progress->status == 'complete' ? 'selected' : '' }}>Complete</option>
                    <option value="revision" {{ $progress->status == 'revision' ? 'selected' : '' }}>Needs Revision</option>
                </select>
            </form>
        </div>
    </div>
    @endforeach

    @if($workProgresses->isEmpty())
    <div class="text-center py-8 text-gray-500">
        No work progress entries found.
    </div>
    @endif
</div>
@endsection