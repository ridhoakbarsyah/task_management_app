@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">Selamat Datang!</h2>
                    <p class="text-center text-gray-600 mb-6">Silakan login untuk melanjutkan</p>

                    @if (session('success'))
                        <x-alert type="success" :message="session('success')" />
                    @endif

                    @if ($errors->any())
                        <x-alert type="error" :message="$errors->first()" />
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf
                        <x-input label="Email:" type="email" id="email" name="email" required="true" />

                        <x-input label="Password:" type="password" id="password" name="password" required="true" />

                        <div class="flex items-center justify-between">
                            <a href="{{ route('register') }}" class="text-sm text-blue-500 hover:underline">
                                Belum punya akun? Register
                            </a>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
