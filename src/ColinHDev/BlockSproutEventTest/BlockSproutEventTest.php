<?php

namespace ColinHDev\BlockSproutEventTest;

use pocketmine\block\Bamboo;
use pocketmine\block\utils\TreeType;
use pocketmine\block\Wood;
use pocketmine\event\block\BlockSproutEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class BlockSproutEventTest extends PluginBase implements Listener {

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onBlockSprout(BlockSproutEvent $event) : void {
        $block = $event->getBlock();
        $newBlock = $event->getNewState();
        echo
            $block->getName() . PHP_EOL .
            $newBlock->getName() . PHP_EOL
        ;

        if ($block instanceof Bamboo) {
            $event->cancel();
        } elseif ($newBlock instanceof Wood) {
            if ($newBlock->getTreeType() === TreeType::BIRCH()) {
                $event->cancel();
            }
        }
    }
}