<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $totalGuru = User::guru()->count();
        $totalSiswa = User::siswa()->count();
        $totalMateri = Materi::count();
        $totalQuiz = Quiz::count();
        $totalAttempts = QuizAttempt::count();
        $rataNilai = round(QuizAttempt::avg('skor_persen') ?? 0, 1);

        $topMateri = Materi::with('guru')
            ->select('materi.*')
            ->selectSub(function ($query) {
                $query->from('quiz as q')
                    ->join('quiz_attempts as qa', 'qa.id_quiz', '=', 'q.id_quiz')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('q.id_materi', 'materi.id_materi');
            }, 'attempt_count')
            ->orderByDesc('attempt_count')
            ->limit(5)
            ->get();

        $recentAttempts = QuizAttempt::with(['siswa', 'quiz.materi'])
            ->orderBy('tanggal_pengerjaan', 'desc')
            ->take(10)
            ->get();

        $topSiswa = User::siswa()
            ->select('users.*')
            ->selectSub(function ($query) {
                $query->from('quiz_attempts')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('id_siswa', 'users.id_user');
            }, 'quiz_dikerjakan')
            ->selectSub(function ($query) {
                $query->from('quiz_attempts')
                    ->selectRaw('COALESCE(ROUND(AVG(skor_persen), 1), 0)')
                    ->whereColumn('id_siswa', 'users.id_user');
            }, 'rata_rata_nilai')
            ->havingRaw('quiz_dikerjakan > 0')
            ->orderByDesc('rata_rata_nilai')
            ->take(5)
            ->get();

        $siswaProgress = User::siswa()
            ->select('users.*')
            ->selectSub(function ($query) {
                $query->from('quiz_attempts')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('id_siswa', 'users.id_user');
            }, 'quiz_dikerjakan')
            ->selectSub(function ($query) {
                $query->from('quiz_attempts')
                    ->selectRaw('COALESCE(ROUND(AVG(skor_persen), 1), 0)')
                    ->whereColumn('id_siswa', 'users.id_user');
            }, 'rata_rata_nilai')
            ->selectSub(function ($query) {
                $query->from('quiz_attempts')
                    ->selectRaw('COALESCE(MAX(skor_persen), 0)')
                    ->whereColumn('id_siswa', 'users.id_user');
            }, 'nilai_tertinggi')
            ->selectSub(function ($query) {
                $query->from('quiz_attempts')
                    ->selectRaw('COALESCE(MIN(skor_persen), 0)')
                    ->whereColumn('id_siswa', 'users.id_user');
            }, 'nilai_terendah')
            ->orderBy('users.name')
            ->get();

        return view('dashboard.laporan.index', compact(
            'totalGuru',
            'totalSiswa',
            'totalMateri',
            'totalQuiz',
            'totalAttempts',
            'rataNilai',
            'topMateri',
            'recentAttempts',
            'topSiswa',
            'siswaProgress'
        ));
    }

    public function exportPenggunaPdf()
    {
        $users = User::orderBy('created_at')->get();

        $logoPath = public_path('images/sipinter-logo.png');
        $logoBase64 = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;

        $html = view('dashboard.laporan.pdf.pengguna', compact('users', 'logoBase64'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $output = $dompdf->output();
        return response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="laporan_pengguna.pdf"',
        ]);
    }

    public function exportMateriPdf()
    {
        $materiList = Materi::with(['guru', 'jenjang', 'kategori'])
            ->orderBy('judul')
            ->get();

        $logoPath = public_path('images/sipinter-logo.png');
        $logoBase64 = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;

        $html = view('dashboard.laporan.pdf.materi', compact('materiList', 'logoBase64'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $output = $dompdf->output();
        return response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="laporan_materi.pdf"',
        ]);
    }

    public function exportProgressPdf()
    {
        $siswaProgress = User::siswa()
            ->select('users.*')
            ->selectSub(function ($query) {
                $query->from('quiz_attempts')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('id_siswa', 'users.id_user');
            }, 'quiz_dikerjakan')
            ->selectSub(function ($query) {
                $query->from('quiz_attempts')
                    ->selectRaw('COALESCE(ROUND(AVG(skor_persen), 1), 0)')
                    ->whereColumn('id_siswa', 'users.id_user');
            }, 'rata_rata_nilai')
            ->selectSub(function ($query) {
                $query->from('quiz_attempts')
                    ->selectRaw('COALESCE(MAX(skor_persen), 0)')
                    ->whereColumn('id_siswa', 'users.id_user');
            }, 'nilai_tertinggi')
            ->selectSub(function ($query) {
                $query->from('quiz_attempts')
                    ->selectRaw('COALESCE(MIN(skor_persen), 0)')
                    ->whereColumn('id_siswa', 'users.id_user');
            }, 'nilai_terendah')
            ->orderBy('users.name')
            ->get();

        $logoPath = public_path('images/sipinter-logo.png');
        $logoBase64 = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;

        $html = view('dashboard.laporan.pdf.progress', compact('siswaProgress', 'logoBase64'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $output = $dompdf->output();
        return response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="laporan_progress_siswa.pdf"',
        ]);
    }
}
