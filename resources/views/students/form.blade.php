
@extends('layouts.app')

@php
    $editing = isset($student);
@endphp

@section('title', ($editing ? 'Edit' : 'Tambah') . ' Siswa | StudentHub')

@section('content')
<div class="min-h-screen bg-shell p-3 sm:p-6 lg:p-10">

    <main class="mx-auto max-w-5xl rounded-[28px]
                 bg-page p-5 shadow-xl sm:p-10">

        <!-- Header -->
        <header class="flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('home') }}"
               class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center
                            justify-center rounded-xl bg-ink
                            font-bold text-white">
                    S<span class="text-brand">.</span>
                </div>
                <span class="font-semibold">StudentHub</span>
            </a>

            <a href="{{ $editing ? route('students.index') : route('home') }}"
               class="rounded-xl bg-white/40 px-4 py-3
                      text-sm transition hover:bg-white/70">
                ← Kembali
            </a>
        </header>

        <!-- Title -->
        <section class="pb-8 pt-14">
            <span class="text-xs font-medium uppercase
                         tracking-[0.2em] text-brand">
                Student / {{ $editing ? 'Edit Record' : 'Registration' }}
            </span>

            <h1 class="mt-4 text-4xl font-medium tracking-tight sm:text-5xl">
                {{ $editing ? 'Edit Data Siswa.' : 'Form Data Siswa.' }}
            </h1>

            <p class="mt-4 max-w-xl text-sm leading-7 text-ink/60">
                {{ $editing
                   ? 'Perbarui informasi siswa melalui formulir berikut.'
                   : 'Lengkapi informasi yang diperlukan untuk mendaftarkan data siswa.' }}
            </p>
        </section>

        @if (session('success'))
            <div class="mb-6 rounded-xl bg-emerald-100 p-4
                        text-sm text-emerald-800" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-red-100 p-4 text-sm text-red-800"
                 role="alert">
                <p class="font-semibold">Periksa kembali data berikut:</p>
                <ul class="mt-2 list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST"
              action="{{ $editing
                  ? route('students.update', $student)
                  : route('students.store') }}"
              class="space-y-8">

            @csrf

            @if ($editing)
                @method('PUT')
            @endif

            <!-- Identitas -->
            <div class="rounded-[24px] bg-white/30 p-5 sm:p-7">

                <div class="mb-6 flex items-center gap-3">
                    <span class="flex h-9 w-9 items-center
                                 justify-center rounded-xl bg-brand
                                 text-sm font-semibold text-white">
                        01
                    </span>
                    <h2 class="text-xl font-semibold">
                        Identitas Siswa
                    </h2>
                </div>

                <div class="grid gap-5 md:grid-cols-2">

                    <div>
                        <label for="nis" class="mb-2 block text-sm font-medium">
                            NIS *
                        </label>
                        <input type="text" id="nis" name="nis"
                               value="{{ old('nis', $student->nis ?? '') }}"
                               required maxlength="20"
                               class="w-full rounded-xl border border-white/40
                                      bg-white/60 px-4 py-3 outline-none
                                      focus:border-brand focus:ring-2 focus:ring-brand/20"
                               placeholder="Nomor Induk Siswa">
                    </div>

                    <div>
                        <label for="nisn" class="mb-2 block text-sm font-medium">
                            NISN
                        </label>
                        <input type="text" id="nisn" name="nisn"
                               value="{{ old('nisn', $student->nisn ?? '') }}"
                               maxlength="10" inputmode="numeric"
                               class="w-full rounded-xl border border-white/40
                                      bg-white/60 px-4 py-3 outline-none
                                      focus:border-brand focus:ring-2 focus:ring-brand/20"
                               placeholder="10 digit NISN">
                    </div>

                    <div class="md:col-span-2">
                        <label for="nama_lengkap"
                               class="mb-2 block text-sm font-medium">
                            Nama Lengkap *
                        </label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap"
                               value="{{ old('nama_lengkap', $student->nama_lengkap ?? '') }}"
                               required maxlength="120"
                               class="w-full rounded-xl border border-white/40
                                      bg-white/60 px-4 py-3 outline-none
                                      focus:border-brand focus:ring-2 focus:ring-brand/20"
                               placeholder="Masukkan nama lengkap">
                    </div>

                    <div>
                        <label for="jenis_kelamin"
                               class="mb-2 block text-sm font-medium">
                            Jenis Kelamin *
                        </label>
                        <select id="jenis_kelamin" name="jenis_kelamin" required
                                class="w-full rounded-xl border border-white/40
                                       bg-white/60 px-4 py-3 outline-none
                                       focus:border-brand">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="L"
                                @selected(old('jenis_kelamin', $student->jenis_kelamin ?? '') == 'L')>
                                Laki-laki
                            </option>
                            <option value="P"
                                @selected(old('jenis_kelamin', $student->jenis_kelamin ?? '') == 'P')>
                                Perempuan
                            </option>
                        </select>
                    </div>

                    <div>
                        <label for="tanggal_lahir"
                               class="mb-2 block text-sm font-medium">
                            Tanggal Lahir
                        </label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                               value="{{ old('tanggal_lahir', $editing ? $student->tanggal_lahir?->format('Y-m-d') : '') }}"
                               max="{{ date('Y-m-d') }}"
                               class="w-full rounded-xl border border-white/40
                                      bg-white/60 px-4 py-3 outline-none
                                      focus:border-brand">
                    </div>

                    <div class="md:col-span-2">
                        <label for="tempat_lahir"
                               class="mb-2 block text-sm font-medium">
                            Tempat Lahir
                        </label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir"
                               value="{{ old('tempat_lahir', $student->tempat_lahir ?? '') }}"
                               maxlength="100"
                               class="w-full rounded-xl border border-white/40
                                      bg-white/60 px-4 py-3 outline-none
                                      focus:border-brand"
                               placeholder="Kota kelahiran">
                    </div>
                </div>
            </div>

            <!-- Akademik -->
            <div class="rounded-[24px] bg-white/30 p-5 sm:p-7">

                <div class="mb-6 flex items-center gap-3">
                    <span class="flex h-9 w-9 items-center
                                 justify-center rounded-xl bg-brand
                                 text-sm font-semibold text-white">
                        02
                    </span>
                    <h2 class="text-xl font-semibold">
                        Informasi Akademik
                    </h2>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="kelas"
                               class="mb-2 block text-sm font-medium">
                            Kelas *
                        </label>
                        <select id="kelas" name="kelas" required
                                class="w-full rounded-xl border border-white/40
                                       bg-white/60 px-4 py-3 outline-none
                                       focus:border-brand">
                            <option value="">Pilih kelas</option>
                            @foreach (['X', 'XI', 'XII'] as $kelas)
                                <option value="{{ $kelas }}"
                                    @selected(old('kelas', $student->kelas ?? '') == $kelas)>
                                    {{ $kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="jurusan"
                               class="mb-2 block text-sm font-medium">
                            Jurusan *
                        </label>
                        <select id="jurusan" name="jurusan" required
                                class="w-full rounded-xl border border-white/40
                                       bg-white/60 px-4 py-3 outline-none
                                       focus:border-brand">
                            <option value="">Pilih jurusan</option>
                            @foreach (['RPL', 'TKR', 'TSM', 'DKV', 'MP'] as $jurusan)
                                <option value="{{ $jurusan }}"
                                    @selected(old('jurusan', $student->jurusan ?? '') == $jurusan)>
                                    {{ $jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Kontak -->
            <div class="rounded-[24px] bg-white/30 p-5 sm:p-7">

                <div class="mb-6 flex items-center gap-3">
                    <span class="flex h-9 w-9 items-center
                                 justify-center rounded-xl bg-brand
                                 text-sm font-semibold text-white">
                        03
                    </span>
                    <h2 class="text-xl font-semibold">
                        Informasi Kontak
                    </h2>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="email"
                               class="mb-2 block text-sm font-medium">
                            Email
                        </label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email', $student->email ?? '') }}"
                               class="w-full rounded-xl border border-white/40
                                      bg-white/60 px-4 py-3 outline-none
                                      focus:border-brand"
                               placeholder="Alamat email">
                    </div>

                    <div>
                        <label for="no_telepon"
                               class="mb-2 block text-sm font-medium">
                            Nomor Telepon
                        </label>
                        <input type="tel" id="no_telepon" name="no_telepon"
                               value="{{ old('no_telepon', $student->no_telepon ?? '') }}"
                               maxlength="20"
                               class="w-full rounded-xl border border-white/40
                                      bg-white/60 px-4 py-3 outline-none
                                      focus:border-brand"
                               placeholder="08xxxxxxxxxx">
                    </div>

                    <div class="md:col-span-2">
                        <label for="alamat"
                               class="mb-2 block text-sm font-medium">
                            Alamat
                        </label>
                        <textarea id="alamat" name="alamat" rows="4"
                                  maxlength="2000"
                                  class="w-full resize-y rounded-xl
                                         border border-white/40 bg-white/60
                                         px-4 py-3 outline-none focus:border-brand"
                                  placeholder="Masukkan alamat">{{ old('alamat', $student->alamat ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-4">
                <p class="text-xs text-ink/50">
                    * Wajib diisi
                </p>

                <button type="submit"
                        class="rounded-xl bg-brand px-8 py-4
                               text-sm font-semibold text-white
                               transition duration-300 hover:-translate-y-1
                               hover:bg-emerald-700">
                    {{ $editing ? 'Simpan Perubahan' : 'Simpan Data Siswa' }} ↗
                </button>
            </div>

        </form>

    </main>
</div>
@endsection
