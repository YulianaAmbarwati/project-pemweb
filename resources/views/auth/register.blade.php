<x-layout>
    <x-slot:title>Register</x-slot:title>

    <div class="hero min-h-[calc(100vh-16rem)]">
        <div class="hero-content flex-col">
            {{-- Menghapus shadow-xl agar card terlihat flat/minimalis --}}
            <div class="card w-96 bg-base-100">
                <div class="card-body">
                    {{-- Mengubah h1 dari text-3xl ke text-xl dan tambah mt-1 --}}
                    <h1 class="text-xl font-bold text-center mt-1 mb-6">Create Account</h1>

                    <form method="POST" action="/register">
                        @csrf
                        {{-- Nama --}}
                        <label class="floating-label mb-6">
                            <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}" class="input input-bordered w-full" required>
                            <span>Name</span>
                        </label>

                        {{-- Email --}}
                        <label class="floating-label mb-6">
                            <input type="email" name="email" placeholder="mail@example.com" value="{{ old('email') }}" class="input input-bordered w-full" required>
                            <span>Email</span>
                        </label>

                        {{-- Password --}}
                        <label class="floating-label mb-6">
                            <input type="password" name="password" placeholder="••••••••" class="input input-bordered w-full" required>
                            <span>Password</span>
                        </label>

                        {{-- Konfirmasi Password --}}
                        <label class="floating-label mb-6">
                            <input type="password" name="password_confirmation" placeholder="••••••••" class="input input-bordered w-full" required>
                            <span>Confirm Password</span>
                        </label>

                        <button type="submit" class="btn btn-primary w-full mt-4">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>