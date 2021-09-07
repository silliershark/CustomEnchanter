<?php

namespace Vqnic\CustomEnchanter;

use pocketmine\plugin\PluginBase;

use Vqnic\CustomEnchanter\CEListener;

class Main extends PluginBase{

    private static Main $instance;

    public function onEnable(){
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents(new CEListener($this), $this);
    }

    public static function getMain() : Main{
        return self::$instance;
    }
}