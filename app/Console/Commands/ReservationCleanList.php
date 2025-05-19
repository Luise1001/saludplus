<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Patient\Reservation;

class ReservationCleanList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservation:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up the reservation list by deleting all reservations pending for yesterday or earlier';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $yesterday = now()->subDay()->format('Y-m-d');

        $reservations = Reservation::where('status', 'pendiente')
            ->where('date', '<=', $yesterday)
            ->get();

        if (!$reservations->isEmpty()) {
            foreach ($reservations as $row) {
                $row->update([
                    'status' => 3,
                    'user_id' => 1,
                    'observation' => $row->observation. ' Cancelada por el sistema'
                ]);
            }
        }
    }
}
