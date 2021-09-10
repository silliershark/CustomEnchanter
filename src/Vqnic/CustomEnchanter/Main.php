<?php

namespace Vqnic\CustomEnchanter;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;

use Vqnic\CustomEnchanter\CEListener;

class Main extends PluginBase{

    private static Main $instance;

    public function onEnable(){
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents(new CEListener($this), $this);
        //basic "spoon" detector, inspired by this repo:
        //https://github.com/falkirks/spoondetector
        if(!in_array(Server::getInstance()->getName(), "PocketMine-MP")){
            $this->getServer()->getLogger()->warning("Hey there! It appears as if you are using a Spoon. Just so you are aware, we do not offer support for those who are using this plugin on a Spoon. If you would like to recieve support for a bug, please use normal PocketMIne-MP.");
        }
    }

    public static function getMain() : Main{
        return self::$instance;
    }
}
