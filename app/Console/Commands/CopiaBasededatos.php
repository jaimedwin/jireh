<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Console\Commands;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class CopiaBasededatos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup-db';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup data base';

    protected $proceso;
    var $storagePath;
    const PATH = 'copiasbasesdedatos/';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $mytime = Carbon::now();
        $today = $mytime->format('Y-m-d_H-i-s-u');
        $this->storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();

        //if (!is_dir(storage_path($this->storagePath))) mkdir(storage_path($this->storagePath));

        $path = $this->storagePath . self::PATH. $today .".sql";
        $this->proceso = new Process(sprintf(
            'mysqldump -u %s -p%s %s > %s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.database'),
            $path
        ));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->proceso->mustRun();
            Log::info('Copia completa de base de datos');
        }catch(ProcessFailedException $exception){
            Log::error(['Error de copia de base de datos', $exception]);
        } 
    }
}
