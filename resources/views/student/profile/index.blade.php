@extends('layouts.student')

@section('title', 'Profil Saya')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Profil Saya</h1>
        <p class="text-gray-500 mt-1 text-lg">Informasi akun kamu</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center">
                    <span class="text-2xl font-bold text-indigo-600">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-lg">{{ auth()->user()->name }}</h3>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <p class="text-xs text-gray-500 font-medium">Nama</p>
                    <p class="text-gray-900 font-medium">{{ auth()->user()->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Email</p>
                    <p class="text-gray-900 font-medium">{{ auth()->user()->email }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Role</p>
                    <p class="text-gray-900 font-medium">{{ ucfirst(auth()->user()->role) }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Bergabung Sejak</p>
                    <p class="text-gray-900 font-medium">{{ auth()->user()->created_at->translatedFormat('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
