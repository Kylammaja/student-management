
@extends('layouts.app')

@section('title', 'Data Siswa | StudentHub')

@section('content')

<div class="min-h-screen bg-shell p-3 sm:p-6 lg:p-10">

    <main class="mx-auto min-h-[90vh] max-w-7xl
                 rounded-[28px] bg-page p-5 shadow-xl
                 sm:p-8 lg:p-10">

        <!-- NAVBAR -->
        <header class="flex flex-wrap items-center justify-between gap-4">

            <a href="{{ route('home') }}"
               class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center
                            justify-center rounded-xl
                            bg-ink font-bold text-white">
                    S<span class="text-brand">.</span>
                </div>

                <span class="text-lg font-semibold">
                    StudentHub
                </span>
            </a>

            <div class="flex items-center gap-3">

                <a href="{{ route('home') }}"
                   class="rounded-xl bg-white/40 px-4 py-3
                          text-sm transition hover:bg-white/70">
                    Home
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="rounded-xl bg-ink px-4 py-3
                                   text-sm text-white transition
                                   hover:bg-ink/80">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- PAGE HEADER -->
        <section class="pb-10 pt-16">

            <p class="text-xs font-medium uppercase
                      tracking-[0.2em] text-brand">
                Dashboard / Student Records
            </p>

            <h1 class="mt-4 text-4xl font-medium
                       tracking-tight sm:text-5xl">
                Student Database.
            </h1>

            <p class="mt-4 max-w-xl text-sm leading-7 text-ink/60">
                Kelola seluruh informasi siswa dalam satu
                dashboard yang praktis dan terstruktur.
            </p>
        </section>

        <!-- NOTIFIKASI -->
        @if (session('success'))
            <div class="mb-6 rounded-xl bg-emerald-100 p-4
                        text-sm text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        <!-- STATISTIK AWAL -->
        <section class="mb-8 grid gap-4 sm:grid-cols-2">

            <div class="rounded-2xl bg-white/40 p-6">

                <p class="text-sm text-ink/60">
                    Total Students
                </p>

                <div class="mt-5 flex items-end justify-between">

                    <h2 class="text-5xl font-medium">
                        {{ $totalStudents }}
                    </h2>

                    <span class="text-sm text-brand">
                        All Records ↗
                    </span>

                </div>
            </div>

            <div class="rounded-2xl bg-white/40 p-6">

                <p class="text-sm text-ink/60">
                    Current Results
                </p>

                <div class="mt-5 flex items-end justify-between">

                    <h2 class="text-5xl font-medium">
                        {{ $students->total() }}
                    </h2>

                    <span class="text-sm text-ink/50">
                        Matching Records
                    </span>

                </div>
            </div>

        </section>

        <!-- STUDENT RECORDS -->
        <section class="overflow-hidden rounded-[24px]
                        bg-white/35 p-4 sm:p-6">

            <div class="mb-6 flex flex-wrap items-center
                        justify-between gap-4">

                <div>
                    <h2 class="text-xl font-semibold">
                        Student Records
                    </h2>

                    <p class="mt-1 text-xs text-ink/50">
                        Data siswa tersimpan dalam database MySQL
                    </p>
                </div>

                <a href="{{ route('students.create') }}"
                   class="rounded-xl bg-brand px-5 py-3
                          text-sm font-medium text-white
                          transition hover:bg-emerald-700">

                    + Add Student
                </a>
            </div>

            <!-- SEARCH -->
            <form action="{{ route('students.index') }}"
                  method="GET"
                  class="mb-6 flex flex-wrap gap-3">

                <input type="search"
                       name="q"
                       value="{{ request('q') }}"
                       placeholder="Search name, NIS, class, major..."
                       class="min-w-0 flex-1 rounded-xl
                              border border-white/50 bg-white/60
                              px-4 py-3 text-sm outline-none
                              focus:border-brand">

                <button type="submit"
                        class="rounded-xl bg-ink px-5 py-3
                               text-sm text-white">
                    Search
                </button>

                @if (request()->filled('q'))

                    <a href="{{ route('students.index') }}"
                       class="rounded-xl bg-white/60
                              px-4 py-3 text-sm">
                        Reset
                    </a>

                @endif
            </form>

            <!-- TABLE -->
            <div class="overflow-x-auto rounded-xl">

                <table class="w-full min-w-[850px]
                              text-left text-sm">

                    <thead class="border-b border-ink/15
                                  text-xs uppercase tracking-wider
                                  text-ink/50">

                        <tr>
                            <th class="px-4 py-4">No.</th>
                            <th class="px-4 py-4">Student</th>
                            <th class="px-4 py-4">NIS</th>
                            <th class="px-4 py-4">Class</th>
                            <th class="px-4 py-4">Major</th>
                            <th class="px-4 py-4">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-ink/10">

                        @forelse ($students as $student)

                            <tr class="transition hover:bg-white/40">

                                <td class="px-4 py-5 text-ink/50">
                                    {{ $students->firstItem() + $loop->index }}
                                </td>

                                <td class="px-4 py-5">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10
                                                    shrink-0 items-center
                                                    justify-center rounded-xl
                                                    bg-panel font-semibold
                                                    text-brand">

                                            {{ mb_strtoupper(mb_substr($student->nama_lengkap, 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="font-semibold">
                                                {{ $student->nama_lengkap }}
                                            </p>

                                            <p class="mt-1 text-xs text-ink/50">
                                                Student
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-5">
                                    {{ $student->nis }}
                                </td>

                                <td class="px-4 py-5">
                                    {{ $student->kelas }}
                                </td>

                                <td class="px-4 py-5">

                                    <span class="rounded-lg bg-white/60
                                                 px-3 py-2 text-xs">
                                        {{ $student->jurusan }}
                                    </span>
                                </td>

                                <td class="px-4 py-5">

                                    <div class="flex items-center gap-2">

                                        <a href="{{ route('students.show', $student) }}"
                                           class="rounded-lg bg-white/70
                                                  px-3 py-2 text-xs
                                                  hover:bg-white">
                                            Detail
                                        </a>

                                        <a href="{{ route('students.edit', $student) }}"
                                           class="rounded-lg bg-white/70
                                                  px-3 py-2 text-xs
                                                  hover:bg-white">
                                            Edit
                                        </a>

                                        <form method="POST"
                                              action="{{ route('students.destroy', $student) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="rounded-lg
                                                           bg-red-100
                                                           px-3 py-2
                                                           text-xs text-red-700
                                                           hover:bg-red-200">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6"
                                    class="px-4 py-16
                                           text-center text-ink/50">
                                    Belum ada data siswa.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="mt-6">
                {{ $students->links() }}
            </div>

        </section>

        <!-- FOOTER -->
        <footer class="mt-10 border-t border-ink/10
                       pt-6 text-center text-xs text-ink/50">

            © {{ date('Y') }} StudentHub. All rights reserved.

        </footer>

    </main>
</div>

@endsection
