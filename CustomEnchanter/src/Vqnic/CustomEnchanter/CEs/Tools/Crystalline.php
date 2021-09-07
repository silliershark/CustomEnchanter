<?php

namespace Vqnic\CustomEnchanter\CEs\Tools;


use Vqnic\CustomEnchanter\CEs\Tools\ToolCE;
use Vqnic\CustomEnchanter\Main;

class Crystalline extends ToolCE{

    private int $CElevel;

    function __construct($l, $a, $v){
        $this->CElevel = $l;
    }

    public function trigger(){
        if(mt_rand(1, 100) <= 2){ // 2% chance
            //do a thing
        }
    }
}
