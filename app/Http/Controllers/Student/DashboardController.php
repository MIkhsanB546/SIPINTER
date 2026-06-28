<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\MateriSiswa;
use App\Models\TingkatKesulitan;
use App\Models\KategoriMateri;
use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $siswaId = Auth::id();

        // My Learning - continue learning (in progress materials)
        $continueLearning = Auth::user()->materiSiswa()
            ->wherePivot('status', 'learning')
            ->with(['guru', 'tingkatKesulitan', 'kategori'])
            ->withPivot(['progress', 'status'])
            ->latest()
            ->take(3)
            ->get();

        // Recently saved
        $recentlySaved = Auth::user()->materiSiswa()
            ->wherePivot('status', 'saved')
            ->with(['guru', 'tingkatKesulitan', 'kategori'])
            ->withPivot(['created_at'])
            ->latest()
            ->take(4)
            ->get();

        // Recommended materials (published, not saved yet)
        $savedIds = MateriSiswa::where('id_siswa', $siswaId)->pluck('id_materi')->toArray();
        $recommended = Materi::with(['guru', 'tingkatKesulitan', 'kategori'])
            ->where('is_published', true)
            ->whereNotIn('id_materi', $savedIds)
            ->inRandomOrder()
            ->take(4)
            ->get();

        // Categories with count
        $categories = KategoriMateri::withCount(['materi' => fn($q) => $q->where('is_published', true)])
            ->orderBy('nama_kategori')
            ->get();

        // Teachers with published material count
        $teachers = User::guru()
            ->withCount(['materi' => fn($q) => $q->where('is_published', true)])
            ->orderBy('name')
            ->get();

        // Progress summary — single aggregate query
        $progressSummary = MateriSiswa::where('id_siswa', $siswaId)
            ->selectRaw('COUNT(*) as total_saved')
            ->selectRaw('SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as total_learning', ['learning'])
            ->selectRaw('SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as total_completed', ['completed'])
            ->first();

        $totalSaved = $progressSummary->total_saved;
        $totalLearning = $progressSummary->total_learning;
        $totalCompleted = $progressSummary->total_completed;
        $overallProgress = $totalSaved > 0 ? round(($totalCompleted / $totalSaved) * 100) : 0;

        // Recent quiz results
        $recentAttempts = QuizAttempt::where('id_siswa', $siswaId)
            ->with(['quiz.materi'])
            ->latest('tanggal_pengerjaan')
            ->take(5)
            ->get();

        // Latest published materials
        $latestPublished = Materi::with(['guru', 'tingkatKesulitan', 'kategori'])
            ->where('is_published', true)
            ->latest()
            ->take(4)
            ->get();

        $colors = [
            'bg-gradient-mtk',
            'bg-gradient-bind',
            'bg-gradient-ipa',
            'bg-gradient-ips',
            'bg-gradient-bing',
            'bg-gradient-default',
        ];

        return view('student.dashboard.index', compact(
            'continueLearning',
            'recentlySaved',
            'recommended',
            'categories',
            'teachers',
            'totalSaved',
            'totalLearning',
            'totalCompleted',
            'overallProgress',
            'recentAttempts',
            'latestPublished',
            'colors',
        ));
    }
}
