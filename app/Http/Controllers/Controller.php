<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = [];

    function __construct(){
    	$this->contentPolitic();
    }
    /**
     * contentPolitic
     *Cadenas unicas y aleatorias usadas para controlar el JS usado en linea
     * @return void
     */
    protected function contentPolitic(){
    	$this->data['hash_primary'] =  hash('sha256',numerRamdomCryp(20));
    	$this->data['hash_secondary'] =  hash('sha256',numerRamdomCryp(20));
    }
    /**
     * resData
     *Obtener los valores que serán enviados como respuesta
     * @param [string] $key
     * @return void
     */
    protected function resData($key){
        if (func_num_args() == 1) {
            if(array_key_exists($key,$this->data))
                return $this->data[$key];
            return null;
        }else{
            $this->data[$key] = func_get_arg(1);
        }
    }
}
