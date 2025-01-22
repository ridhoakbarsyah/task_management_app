@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">Selamat Datang!</h2>
                    <p class="text-center text-gray-600 mb-6">Silakan daftarkan akun baru Anda</p>

                    @if (session('success'))
                        <x-alert type="success" :message="session('success')" />
                    @endif

                    @if ($errors->any())
                        <x-alert type="error" :message="$errors->first()" />
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf
                        <x-input label="Nama:" type="text" id="name" name="name" required="true"
                            autofocus="true" />

                        <x-input label="Email:" type="email" id="email" name="email" required="true" />

                        <x-input label="Password:" type="password" id="password" name="password" required="true" />

                        <x-input label="Konfirmasi Password:" type="password" id="confirm_password" name="confirm_password"
                            required="true" />

                        <div class="flex items-center justify-between">
                            <a href="{{ route('login') }}" class="text-sm text-blue-500 hover:underline">
                                Sudah punya akun? Login
                            </a>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
