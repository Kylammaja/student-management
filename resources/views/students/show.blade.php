
@extends('layouts.app')

@section('title', 'Detail Siswa | StudentHub')

@section('content')
<div class="min-h-screen bg-shell p-4 sm:p-10">
    <main class="mx-auto max-w-4xl rounded-[28px]
                 bg-page p-6 shadow-xl sm:p-10">

        <a href="{{ route('students.index') }}"
           class="text-sm text-ink/60 hover:text-brand">
            ← Back to Students
        </a>

        <p class="mt-12 text-xs font-medium uppercase
                  tracking-widest text-brand">
            Student / Personal Information
        </p>

        <h1 class="mt-4 text-4xl font-medium tracking-tight">
            {{ $student->nama_lengkap }}
        </h1>

        <p class="mt-3 text-sm text-ink/60">
            {{ $student->kelas }} — {{ $student->jurusan }}
        </p>

        <div class="mt-10 grid gap-4 sm:grid-cols-2">
            @foreach ([
                'NIS' => $student->nis,
                'NISN' => $student->nisn,
                'Jenis Kelamin' => $student->jenis_kelamin == 'L'
                    ? 'Laki-laki' : 'Perempuan',
                'Tempat Lahir' => $student->tempat_lahir,
                'Tanggal Lahir' => $student->tanggal_lahir?->format('d-m-Y'),
                'Kelas' => $student->kelas,
                'Jurusan' => $student->jurusan,
                'Email' => $student->email,
                'Telepon' => $student->no_telepon,
                'Alamat' => $student->alamat,
            ] as $label => $value)
                <div class="rounded-2xl bg-white/40 p-5">
                    <p class="text-xs text-ink/50">
                        {{ $label }}
                    </p>
                    <p class="mt-3 break-words font-semibold">
                        {{ $value ?: '-' }}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('students.edit', $student) }}"
               class="rounded-xl bg-brand px-6 py-3
                      text-sm font-medium text-white
                      hover:bg-emerald-700">
                Edit Student ↗
            </a>

            <a href="{{ route('students.index') }}"
               class="rounded-xl bg-white/50 px-6 py-3 text-sm">
                Back to Table
            </a>
        </div>

    </main>
</div>
@endsection
