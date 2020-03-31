<?php
namespace App\Builders;

use Illuminate\Database\Eloquent\Builder; 

class SearchBuilder extends Builder 
{ 
    public function whereOrSearch($palabrasbuscar, $columnas , $npaginas = 100)
    {
        return static::where(function ($query) use ($columnas, $palabrasbuscar) {
            foreach ($palabrasbuscar as $palabra) {
                $query = $query->where(function ($query) use ($columnas,$palabra) {
                    foreach ($columnas as $columna) {
                        $query->orWhere($columna,'like',"%$palabra%");
                    }
                });
            }
        })->paginate($npaginas);
    }
}
?>