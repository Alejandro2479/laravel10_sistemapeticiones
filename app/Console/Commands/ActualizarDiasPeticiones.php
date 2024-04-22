<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Peticion;

class ActualizarDiasPeticiones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'peticiones:actualizar-dias';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar los días restantes de las peticiones';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Peticion::where('dias', '>', 0)->decrement('dias');
    }
}
