<?php

namespace App\Http\Controllers;

use App\Models\Recordatorioproceso;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $mem = $this->getServerMemoryUsage();
        $cpu = $this->getServerCpuUsage();
        $dfg = $this->getServeDiskFree();
        $rec = $this->getNumberRecordatoryWeek();
        $now = $now = date('d-m-Y');
        $to = new \Carbon\Carbon($now);
        $to->addDays(3);
        
        $Recordatorios = $this->getRecordatoryMonth($now, $to);
        $urgencia_fecha = new \Carbon\Carbon($now);
        $urgencia_fecha->addDays(15);
        
        return view('admin', compact('mem', 'cpu', 'dfg', 'rec', 'Recordatorios', 'urgencia_fecha', 'now'));
    }

    private function getServerCpuUsage(){        
        $exec_loads = sys_getloadavg();
        $exec_cores = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
        $cpu = round($exec_loads[1]/($exec_cores + 1)*100, 0) . '%';
        return $cpu;
    }

    private function getServerMemoryUsage(){
        $exec_free = explode("\n", trim(shell_exec('free')));
        $get_mem = preg_split("/[\s]+/", $exec_free[1]);
        $mem = round($get_mem[2]/$get_mem[1]*100, 0) . '%';
        return $mem;
    }

    private function getServeDiskFree(){
        $df = round(disk_free_space("/") / 1024 / 1024 / 1024);
        $dfg = $df . 'Gb';
        return $dfg;
    }

    private function getNumberRecordatoryWeek(){
        $now = $now = date('Y-m-d');
        $to = new \Carbon\Carbon($now);
        $to->addDays(30);
        $recordatorios = Recordatorioproceso::where('fecha', '>=', $now)
                           ->where('fecha', '<=', $to)
                           ->get();
        $rec = $recordatorios->count();
        return $rec;
    }

    private function getRecordatoryMonth($now, $to){
        $now = $now = date('Y-m-d');
        $to = new \Carbon\Carbon($now);
        $to->addDays(30);
        $Recordatorios = Recordatorioproceso::select('recordatorio.fecha AS fecha',
                            'recordatorio.observacion AS observacion',
                            'proceso.numero AS proceso')
                            ->where('fecha', '>=', $now)
                            ->where('fecha', '<=', $to)
                            ->orderBy('fecha', 'ASC')
                            ->join('proceso', 'proceso.id', '=', 'recordatorio.proceso_id')
                            ->get();
        return $Recordatorios;
    }
}
