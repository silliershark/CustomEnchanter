<?php

namespace Vqnic\CustomEnchanter\CEs\Weapons;

use pocketmine\entity\Entity;
use pocketmine\item\Item;
use pocketmine\nbt\tag\ByteArrayTag;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\item\Armor;
use pocketmine\inventory\ArmorInventory;
use pocketmine\nbt\tag\StringTag;
use pocketmine\Player;

use Vqnic\CustomEnchanter\Entities\PlagueSkull;
use Vqnic\CustomEnchanter\Main;

class Shatter extends WeaponCE{

    /*
     *  SHATTER
     *  MAXIMUM LEVEL : 4
     *  CHANCE: 2%
     *  DESCRIPTION: Damages durability of certain pieces of the opponent's armor. Level one does only the helmet,
                     level two the helmet and boots, level three the helmet, boots and leggings, and level four damages all pieces.
     */


    private int $CElevel;
    private Player $attacker;
    private Player $victim;

    function __construct($l, $a, $v){
        $this->CElevel = $l;
        $this->attacker = $a;
        $this->victim = $v;
    }

    public function trigger(){
        if(mt_rand(1, 100) <= 2){ // 2% chance
            $armor = $this->$victim->getArmorInventory();
            $all = [$armor->getHelmet(), $armor->getChestplate(), $armor->getLeggings(), $armor->getBoots()];
            switch($this->CElevel){
                case 1:
                     if($all[0] instanceof Armor){
                         $all[0]->applyDamage(4);
                     }
                    break;

                case 2:
                    for($i = 0; $i < 2; $i++){
                        if($all[$i] instanceof Armor){
                            $all[$i]->applyDamage(4);
                        }
                    }
                    break;

                case 3:
                    for($i = 0; $i < 3; $i++){
                        if($all[$i] instanceof Armor){
                            $all[$i]->applyDamage(4);
                        }
                    }
                    break;

                case 4:
                    for($i = 0; $i < 4; $i++){
                        if($all[$i] instanceof Armor){
                            $all[$i]->applyDamage(4);
                        }
                    }
                    break;
            }
        }
    }
}
