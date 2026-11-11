<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * READ - Dashboard dan daftar siswa
     */
    public function index(Request $request)
    {
        // Validasi parameter pencarian dan filter
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'kelas' => [
                'nullable',
                Rule::in(['X', 'XI', 'XII']),
            ],
            'jurusan' => [
                'nullable',
                Rule::in(['RPL', 'TKR', 'TSM', 'DKV', 'MP']),
            ],
        ]);

        $search = trim($filters['q'] ?? '');

        // Query data siswa
        $students = Student::query()

            // Pencarian nama, NIS, kelas, dan jurusan
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('nis', 'like', "%{$search}%")
                      ->orWhere('kelas', 'like', "%{$search}%")
                      ->orWhere('jurusan', 'like', "%{$search}%");
                });
            })

            // Filter berdasarkan kelas
            ->when(
                !empty($filters['kelas']),
                function ($query) use ($filters) {
                    $query->where('kelas', $filters['kelas']);
                }
            )

            // Filter berdasarkan jurusan
            ->when(
                !empty($filters['jurusan']),
                function ($query) use ($filters) {
                    $query->where('jurusan', $filters['jurusan']);
                }
            )

            // Urutkan terbaru dan buat pagination
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistik total siswa
        $totalStudents = Student::count();

        // Statistik siswa berdasarkan kelas
        $kelasStats = Student::query()
            ->selectRaw('kelas, COUNT(*) as jumlah')
            ->groupBy('kelas')
            ->pluck('jumlah', 'kelas');

        // Kirim data ke halaman tabel
        return view('students.index', compact(
            'students',
            'totalStudents',
            'kelasStats'
        ));
    }

    /**
     * CREATE - Menampilkan form tambah siswa
     */
    public function create()
    {
        return view('students.form');
    }

    /**
     * STORE - Menyimpan data siswa
     */
    public function store(Request $request)
    {
        // Validasi form
        $validated = $request->validate(
            $this->rules()
        );

        // Simpan data ke MySQL
        Student::create($validated);

        // Kembali ke form dengan notifikasi
        return redirect()
            ->route('students.create')
            ->with(
                'success',
                'Data siswa berhasil ditambahkan!'
            );
    }

    /**
     * SHOW - Menampilkan detail siswa
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * EDIT - Menampilkan form edit siswa
     */
    public function edit(Student $student)
    {
        return view('students.form', compact('student'));
    }

    /**
     * UPDATE - Memperbarui data siswa
     */
    public function update(Request $request, Student $student)
    {
        // Validasi data yang diperbarui
        $validated = $request->validate(
            $this->rules($student)
        );

        // Simpan perubahan
        $student->update($validated);

        return redirect()
            ->route('students.index')
            ->with(
                'success',
                'Data siswa berhasil diperbarui!'
            );
    }

    /**
     * DELETE - Menghapus data siswa
     */
    public function destroy(Student $student)
    {
        // Hapus data dari database
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with(
                'success',
                'Data siswa berhasil dihapus!'
            );
    }

    /**
     * RULES - Validasi data siswa
     */
    private function rules(?Student $student = null): array
    {
        return [
            // NIS tidak boleh duplikat
            'nis' => [
                'required',
                'string',
                'max:20',
                Rule::unique('students', 'nis')
                    ->ignore($student?->id),
            ],

            // NISN harus 10 digit jika diisi
            'nisn' => [
                'nullable',
                'digits:10',
                Rule::unique('students', 'nisn')
                    ->ignore($student?->id),
            ],

            // Identitas siswa
            'nama_lengkap' => [
                'required',
                'string',
                'max:120',
            ],

            'jenis_kelamin' => [
                'required',
                Rule::in(['L', 'P']),
            ],

            'tempat_lahir' => [
                'nullable',
                'string',
                'max:100',
            ],

            'tanggal_lahir' => [
                'nullable',
                'date',
                'before_or_equal:today',
            ],

            // Informasi akademik
            'kelas' => [
                'required',
                Rule::in(['X', 'XI', 'XII']),
            ],

            'jurusan' => [
                'required',
                Rule::in([
                    'RPL',
                    'TKR',
                    'TSM',
                    'DKV',
                    'MP',
                ]),
            ],

            // Informasi kontak
            'alamat' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'no_telepon' => [
                'nullable',
                'string',
                'max:20',
            ],
        ];
    }
}
