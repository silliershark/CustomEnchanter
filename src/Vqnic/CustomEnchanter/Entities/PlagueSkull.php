<?php


namespace Vqnic\CustomEnchanter\Entities;

use pocketmine\entity\Human;
use pocketmine\level\Level;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\event\entity\EntityDamageEvent;

class PlagueSkull extends Human {

    public function __construct(Level $world, CompoundTag $nbt, $time) {
        parent::__construct($world, $nbt);
        $this->setNameTag("§r§aPLAGUE§r§8§l [§r§2$time" . "§8]");
        $this->setNameTagAlwaysVisible(true);
    }

    public function attack(EntityDamageEvent $event) : void{
        $event->setCancelled();
    }
}