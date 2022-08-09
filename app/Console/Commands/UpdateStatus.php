<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Jadwal;
use Illuminate\Support\Carbon;

class UpdateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $jadwal_inactive = Jadwal::where('status', 'Inactive')->get();
        foreach ($jadwal_inactive as $key => $value) {
            $current = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            if ($current >= $value->tanggal_mulai && $current <= $value->tanggal_selesai) {
                $jadwal = Jadwal::find($value->id);
                $jadwal->status = 'Active';
                $jadwal->update();
            }
        }

        $jadwal_active = Jadwal::where('status', 'Active')->get();
        foreach ($jadwal_active as $key => $value) {
            $current = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            if ($current >= $value->tanggal_selesai) {
                $jadwal = Jadwal::find($value->id);
                $jadwal->status = 'Disabled';
                $jadwal->update();
            }
        }
    }
}
