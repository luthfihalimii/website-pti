@extends('layouts.admin')

@section('content')
<div class="p-6 space-y-6">
    <h2 class="text-xl font-semibold">Footer Management</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach(['footer_logo_pti', 'footer_map_icon', 'footer_email_icon', 'footer_phone_icon', 'footer_whatsapp_icon', 'footer_linkedin_icon', 'footer_clock_icon'] as $type)
        @php
            $logo = $logos->firstWhere('type', $type);
        @endphp
        <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
            <div class="w-20 h-20 flex items-center justify-center mb-3 border border-gray-200 rounded">
                @if($logo)
                    <img src="{{ $logo->path }}" alt="{{ $type }}" class="max-h-16 max-w-16">
                @else
                    <span class="text-gray-400 text-xs">No logo</span>
                @endif
            </div>
            <span class="text-sm font-medium mb-2">{{ $type }}</span>

            <!-- Upload Form -->
            <form action="{{ route('admin.footer.upload') }}" method="POST" enctype="multipart/form-data" class="mb-2 w-full">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">
                <input type="file" name="logo" accept="image/*" class="mb-1 w-full">
                <button type="submit" class="w-full bg-blue-600 text-white px-2 py-1 rounded text-sm">Upload</button>
            </form>

            <!-- Delete -->
            @if($logo)
            <form action="{{ route('admin.footer.destroy', $logo->id) }}" method="POST" class="w-full">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-600 text-white px-2 py-1 rounded text-sm">Hapus</button>
            </form>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection