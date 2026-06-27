<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateQrToken extends Command
{
    protected $signature = 'users:generate-qr-token';

    protected $description = 'Generate QR token untuk pengguna yang belum memilikinya';

    public function handle()
    {
        $users = User::whereNull('qr_token')->get();

        foreach ($users as $user) {
            $user->qr_token = (string) Str::uuid();
            $user->save();
        }

        $count = $users->count();
        $this->info("Berhasil memperbarui {$count} pengguna.");
    }
}
