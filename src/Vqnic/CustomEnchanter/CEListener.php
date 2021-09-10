<?php

namespace Vqnic\CustomEnchanter;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\inventory\ArmorInventory;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\inventory\Inventory;

use Vqnic\CustomEnchanter\Main;
use Vqnic\CustomEnchanter\CEs\Weapons\{Shatter, Arise, Vile, Husk, Viper, Plague};
use Vqnic\CustomEnchanter\CEs\Armor\{Antidote};
use Vqnic\CustomEnchanter\CEs\Tools\{Crystalline};

class CEListener implements Listener {

    private Main $plugin;

    public function __construct(Main $instance) {
        $this->plugin = $instance;
    }

    public function hurt(EntityDamageEvent $event)
    {
        $hurt = $event->getEntity();
        if ($hurt instanceof Player) {
            if ($event instanceof EntityDamageByEntityEvent) {
                $attacker = $event->getDamager();
                if ($attacker instanceof Player) {
                    $weapon = $attacker->getInventory()->getItemInHand();
                    /*
                     *  WEAPON CES
                     */
                    $swordCEs = ["Shatter", "Arise", "Vile", "Husk", "Viper", "Plague"]; //Will be adding more as listed in the GitHUb readme. :)
                    foreach ($weapon->getLore() as $curr) {
                        $name = $this->cleanCEString($curr)[1];
                        if (in_array($name, $swordCEs)) {
                            $level = $this->cleanCEString($curr)[0];
                            $CE = new $name($level, $attacker, $hurt);
                            $CE->trigger();
                        }
                    }
                }
                $inventory = $hurt->getArmorInventory();
                $slots = [$inventory->getHelmet(), $inventory->getChestplate(), $inventory->getLeggings(), $inventory->getBoots()];
                $armorCEs = ["Antidote"]; //Will be adding more as listed in the GitHUb readme. :)
                foreach ($slots as $slot) {
                    foreach ($slot->getLore() as $curr) {
                        $name = $this->cleanCEString($curr)[1];
                        if (in_array($name, $armorCEs)) {
                            $level = $this->cleanCEString($curr)[0];
                            $CE = new $name($level, $attacker, $hurt);
                            $CE->trigger();
                        }
                    }
                }
            }
        }
    }

    public function onBreak(BlockBreakEvent $event){
        $block = $event->getBlock();
        $player = $event->getPlayer();
        $tool = $player->getInventory()->getItemInHand();
        $toolCEs = ["Crystalline"]; //Will be adding more as listed in the GitHUb readme. :)
        foreach ($tool->getLore() as $curr) {
            $name = $this->cleanCEString($curr)[1];
            if (in_array($name, $toolCEs)) {
                $level = $this->cleanCEString($curr)[0];
                $CE = new $name($level, $block);
                $CE->trigger();
            }
        }
    }

    public function cleanCEString($string) : array {
        if (str_contains($string, "V")) {
            $level = 5;
        }elseif (str_contains($string, "IV")) {
            $level = 4;
        }elseif (str_contains($string, "III")) {
            $level = 3;
        }elseif (str_contains($string, "II")) {
            $level = 2;
        }else {
            $level = 1;
        }
        $remove = ["§r§d", "§r§5", "§r§3", "§r§2", "§r§g", "§r§6", "§r§4", "I", "II", "III", "IV", "V "];
        $current = str_replace($remove, "", $string);
        return [$level, $current];
    }
}
