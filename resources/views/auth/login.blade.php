
@extends('layouts.app')

@section('title', 'Admin Login | StudentHub')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-shell p-4">

    <div class="w-full max-w-md rounded-[28px] bg-page p-7 shadow-xl sm:p-10">

        <a href="{{ route('home') }}"
           class="text-sm text-ink/60 hover:text-brand">
            ← Back to Home
        </a>

        <div class="mt-10 flex h-12 w-12 items-center justify-center
                    rounded-2xl bg-ink text-xl font-bold text-white">
            S<span class="text-brand">.</span>
        </div>

        <p class="mt-8 text-xs font-medium uppercase tracking-widest text-brand">
            StudentHub / Administration
        </p>

        <h1 class="mt-3 text-4xl font-medium tracking-tight">
            Welcome back.
        </h1>

        <p class="mt-3 text-sm leading-6 text-ink/60">
            Masuk untuk mengelola dan melihat data siswa.
        </p>

        @if ($errors->any())
            <div class="mt-6 rounded-xl bg-red-100 p-4 text-sm text-red-800">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}"
              method="POST" class="mt-8 space-y-5">
            @csrf

            <div>
                <label for="email" class="mb-2 block text-sm font-medium">
                    Email
                </label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}" required
                       autocomplete="username"
                       class="w-full rounded-xl border border-white/40
                              bg-white/60 px-4 py-3 outline-none
                              focus:border-brand focus:ring-2 focus:ring-brand/20"
                       placeholder="admin@example.com">
            </div>

            <div>
                <label for="password" class="mb-2 block text-sm font-medium">
                    Password
                </label>
                <input type="password" id="password" name="password"
                       required autocomplete="current-password"
                       class="w-full rounded-xl border border-white/40
                              bg-white/60 px-4 py-3 outline-none
                              focus:border-brand focus:ring-2 focus:ring-brand/20"
                       placeholder="Enter password">
            </div>

            <button type="submit"
                    class="w-full rounded-xl bg-brand px-6 py-4
                           font-medium text-white transition
                           hover:bg-emerald-700">
                Sign In →
            </button>
        </form>

        <p class="mt-8 text-center text-xs text-ink/45">
            StudentHub · Authorized Access Only
        </p>
    </div>
</div>
@endsection
