<?php

namespace App\Observers;

use App\Models\Jadwal;

class JadwalObserver
{
    /**
     * Handle the Jadwal "created" event.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return void
     */
    public function created(Jadwal $jadwal)
    {
        //
    }

    /**
     * Handle the Jadwal "updated" event.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return void
     */
    public function updated(Jadwal $jadwal)
    {
        info('Jadwal updated');
    }

    /**
     * Handle the Jadwal "deleted" event.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return void
     */
    public function deleted(Jadwal $jadwal)
    {
        //
    }

    /**
     * Handle the Jadwal "restored" event.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return void
     */
    public function restored(Jadwal $jadwal)
    {
        //
    }

    /**
     * Handle the Jadwal "force deleted" event.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return void
     */
    public function forceDeleted(Jadwal $jadwal)
    {
        //
    }
}
