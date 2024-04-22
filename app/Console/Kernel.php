<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Illuminate\Support\Facades\Notification;
use App\Models\Peticion;
use App\Notifications\RecordatorioPeticionIncompleta;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\ActualizarDiasPeticiones::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('peticiones:actualizar-dias')->daily();

        $schedule->call(function () {
            $peticiones = Peticion::where('estatus', false)
                ->where('dias', '>', 0)
                ->get();

            foreach ($peticiones as $peticion) {
                $usuario = $peticion->user;

                Notification::send($usuario, new RecordatorioPeticionIncompleta($peticion));
            }
        })->days([Schedule::MONDAY, Schedule::WEDNESDAY, Schedule::FRIDAY])->at('9:00')->withoutOverlapping();;
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
