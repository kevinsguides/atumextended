<?php

namespace KevinsGuides\Plugin\System\AtumExtended\Extension;

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;

final class AtumExtended extends CMSPlugin{

    // beforeRender
    public function onBeforeRender(){
        $app = Factory::getApplication();

        // Check if we are in the admin area
        if($app->isClient('administrator')){
            $web_asset_manager = $app->getDocument()->getWebAssetManager();
            $web_asset_manager->registerAndUseStyle('kevinsguides/atumextended', 'plugins/system/atumextended/assets/css/atumextended.css', [], ['version' => 'auto', 'relative' => true]);
            $web_asset_manager->registerAndUseScript('kevinsguides/atumextended', 'plugins/system/atumextended/assets/js/atumextended.js', ['defer' => true], ['version' => 'auto', 'relative' => true]);
        }

    }

}