
@extends('layouts.app')

@section('title', 'Home | StudentHub')

@section('content')

<div class="min-h-screen bg-shell p-3 sm:p-6 lg:p-10">

    <main class="mx-auto min-h-[90vh] max-w-7xl
                 rounded-[28px] bg-page p-5
                 shadow-2xl sm:p-8 lg:p-10">

        <!-- NAVBAR -->
        <header class="flex items-center justify-between gap-4">

            <!-- Logo -->
            <a href="{{ route('home') }}"
               class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center
                            justify-center rounded-xl bg-ink
                            text-xl font-bold text-white">
                    S<span class="text-brand">.</span>
                </div>

                <span class="text-lg font-semibold tracking-tight">
                    StudentHub
                </span>
            </a>

            <nav class="hidden items-center gap-2 md:flex">

    <a href="{{ route('home') }}"
       class="rounded-xl bg-ink px-5 py-3 text-sm text-white">
        Home
    </a>

    <a href="{{ route('students.create') }}"
       class="rounded-xl bg-white/30 px-5 py-3
              text-sm transition hover:bg-white/60">
        Form Siswa
    </a>

    <a href="{{ route('students.index') }}"
       class="rounded-xl bg-white/30 px-5 py-3
              text-sm transition hover:bg-white/60">
        Data Siswa
    </a>

    <a href="#about"
       class="rounded-xl bg-white/30 px-5 py-3
              text-sm transition hover:bg-white/60">
        About
    </a>
</nav>

            <!-- Desktop Button -->
            <a href="{{ route('students.create') }}"
   class="rounded-xl bg-brand px-6 py-4
          text-sm font-medium text-white
          transition duration-300
          hover:-translate-y-1 hover:bg-emerald-700">
    Isi Data Siswa ↗
</a>

            <!-- Mobile Menu Button -->
            <button id="menu-toggle"
                    type="button"
                    aria-controls="mobile-menu"
                    aria-expanded="false"
                    class="rounded-xl bg-white/40 px-4 py-3
                           text-sm md:hidden">
                Menu
            </button>
        </header>

        <!-- Mobile Navigation -->
        <nav id="mobile-menu"
             class="mt-4 hidden flex-col gap-2 rounded-2xl
                    bg-white/30 p-3 md:hidden">

            <a href="#home" class="rounded-xl p-3 hover:bg-white/40">
                Home
            </a>
            <a href="#features" class="rounded-xl p-3 hover:bg-white/40">
                Features
            </a>
            <a href="#about" class="rounded-xl p-3 hover:bg-white/40">
                About
            </a>
        </nav>

        <!-- HERO SECTION -->
        <section id="home"
                 class="grid items-center gap-10 pb-12 pt-16
                        lg:grid-cols-2 lg:pt-24">

            <!-- Hero Left -->
            <div>

                <div class="mb-7 inline-flex items-center gap-2
                            rounded-full bg-white/40 px-4 py-2
                            text-xs font-medium">

                    <span class="h-2 w-2 rounded-full bg-brand"></span>
                    Student Management Platform
                </div>

                <h1 class="max-w-xl text-5xl font-medium
                           leading-[1.08] tracking-tight
                           sm:text-6xl lg:text-7xl">

                    Student <br>
                    Management
                    <span class="text-brand">System.</span>

                </h1>

                <p class="mt-7 max-w-md text-base leading-8
                          text-ink/65">

                    Kelola informasi siswa secara praktis,
                    terstruktur, dan efisien melalui
                    satu platform digital yang modern.

                </p>

                <div class="mt-9 flex flex-wrap gap-3">

                    <a href="#features"
                       class="rounded-xl bg-brand px-6 py-4
                              text-sm font-medium text-white
                              transition duration-300
                              hover:-translate-y-1
                              hover:bg-emerald-700">

                        Explore Features ↗
                    </a>

                    <a href="#about"
                       class="rounded-xl bg-white/40 px-6 py-4
                              text-sm font-medium
                              transition hover:bg-white/70">

                        Learn More
                    </a>
                </div>
            </div>

            <!-- Hero Right -->
            <div class="rounded-[26px] border border-white/40
                        bg-white/25 p-5 shadow-sm backdrop-blur-sm
                        sm:p-7">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-xs text-ink/50">
                            DASHBOARD PREVIEW
                        </p>
                        <h2 class="mt-2 text-2xl font-semibold">
                            Student Overview
                        </h2>
                    </div>

                    <div class="rounded-xl bg-white/50 p-3">
                        ↗
                    </div>
                </div>

                <!-- Preview Student Card -->
                <div class="mt-7 rounded-2xl bg-panel p-5">

                    <div class="flex items-center gap-4">

                        <div class="flex h-16 w-16 items-center
                                    justify-center rounded-2xl
                                    bg-white/70 text-2xl">
                            ◉
                        </div>

                        <div>
                            <p class="text-xs text-ink/50">
                                Student Profile
                            </p>
                            <h3 class="mt-1 font-semibold">
                                Preview Data Siswa
                            </h3>
                            <p class="text-xs text-ink/50">
                                Tampilan contoh
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3">

                        <div class="rounded-xl bg-white/50 p-4">
                            <p class="text-xs text-ink/50">
                                Kelas
                            </p>
                            <p class="mt-2 font-semibold">—</p>
                        </div>

                        <div class="rounded-xl bg-white/50 p-4">
                            <p class="text-xs text-ink/50">
                                Jurusan
                            </p>
                            <p class="mt-2 font-semibold">—</p>
                        </div>

                    </div>
                </div>

                <div class="mt-5 flex items-center justify-between
                            rounded-xl bg-white/40 p-4">

                    <span class="text-sm">
                        System Status
                    </span>

                    <span class="flex items-center gap-2
                                 text-xs font-medium text-brand">
                        <span class="h-2 w-2 rounded-full bg-brand"></span>
                        UI Preview
                    </span>
                </div>

            </div>
        </section>

        <!-- FEATURE CARDS -->
        <section id="features"
                 class="grid gap-4 border-t border-ink/10
                        pt-7 md:grid-cols-3">

            <div class="rounded-2xl bg-white/35 p-6
                        transition duration-300 hover:bg-white/60">

                <p class="text-sm text-ink/60">01 / Student Data</p>
                <h3 class="mt-5 text-xl font-semibold">
                    Data Management
                </h3>
                <p class="mt-3 text-sm leading-6 text-ink/60">
                    Tambah, lihat, perbarui, dan hapus data siswa.
                </p>
            </div>

            <div class="rounded-2xl bg-white/35 p-6
                        transition duration-300 hover:bg-white/60">

                <p class="text-sm text-ink/60">02 / Organization</p>
                <h3 class="mt-5 text-xl font-semibold">
                    Structured Records
                </h3>
                <p class="mt-3 text-sm leading-6 text-ink/60">
                    Data tersusun rapi berdasarkan kelas
                    dan jurusan.
                </p>
            </div>

            <div class="rounded-2xl bg-white/35 p-6
                        transition duration-300 hover:bg-white/60">

                <p class="text-sm text-ink/60">03 / Productivity</p>
                <h3 class="mt-5 text-xl font-semibold">
                    Easy Access
                </h3>
                <p class="mt-3 text-sm leading-6 text-ink/60">
                    Pencarian dan pengelolaan data yang mudah.
                </p>
            </div>

        </section>

        <!-- ABOUT -->
        <section id="about"
                 class="mt-14 border-t border-ink/10 py-10">

            <p class="text-xs font-medium uppercase
                      tracking-[0.2em] text-brand">
                About StudentHub
            </p>

            <h2 class="mt-4 max-w-2xl text-3xl font-medium
                       tracking-tight sm:text-4xl">
                A simpler way to manage student information.
            </h2>

            <p class="mt-5 max-w-2xl text-sm leading-7 text-ink/60">
                StudentHub adalah sistem manajemen siswa berbasis
                web yang dirancang untuk membantu pencatatan,
                pengelolaan, dan pencarian data siswa secara
                terstruktur menggunakan Laravel dan MySQL.
            </p>
        </section>

        <footer class="flex flex-wrap items-center justify-between
                       gap-3 border-t border-ink/10 pt-6
                       text-xs text-ink/50">
            <span>© {{ date('Y') }} StudentHub</span>
            <span>Student Management System</span>
        </footer>

    </main>
</div>

@endsection
