<?php
/**
 * @package     KevinsGuides.AtumExtended
 * @subpackage  System.atumextended
 *
 * @copyright   (C) 2023 
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace KevinsGuides\Plugin\System\AtumExtended\Extension;

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;

final class AtumExtended extends CMSPlugin{

    // beforeRender - called before the framework renders the application
    public function onBeforeRender(){
        $app = Factory::getApplication();

        //get params
        $params = $this->params;
        $color_mode  = $params->get('color_mode', 'toggle');

        // Check if we are in the admin area
        if($app->isClient('administrator')){
            $web_asset_manager = $app->getDocument()->getWebAssetManager();

            $web_asset_manager->registerAndUseStyle('kevinsguides/forcedark', 'plugins/system/atumextended/assets/css/combined.css', [], ['version' => 'auto', 'relative' => true]);

            $web_asset_manager->registerAndUseScript('kevinsguides/atumextended', 'plugins/system/atumextended/assets/js/atumextended.js', ['defer' => true], ['version' => 'auto', 'relative' => true]);

            if($color_mode == 'toggle'){
                $web_asset_manager->registerAndUseScript('kevinsguides/atumextended', 'plugins/system/atumextended/assets/js/colorcontrol.js', ['defer' => true], ['version' => 'auto', 'relative' => true]);
            }
        }


    }

    //after render but before output
    //we need to add a class to the body tag
    public function onAfterRender(){
        $app = Factory::getApplication();

        //get params
        $params = $this->params;
        $color_mode  = $params->get('color_mode', 'toggle');

        if($color_mode == 'dark'){
            $color_class = 'extended-dark-theme';
        }
        else{
            $color_class = 'extended-light-theme';
        }



        // Check if we are in the admin area
        if($app->isClient('administrator')){
            $body = $app->getBody();
            
            
            if($color_mode == 'toggle'){

                //see if we can get the color class from the cookie
                $cookie = Factory::getApplication()->input->cookie;
                $color_class = $cookie->get('atumx_color_class', 'extended-light-theme');

                if($color_class == 'extended-light-theme'){
                    $icon = 'fas fa-moon';
                }
                else{
                    $icon = 'fas fa-sun';
                }

                $toggler = '<div id="atumx-colortoggle"><i class="'.$icon.'"></i></div>';
                $body = str_replace('</body>', $toggler.'</body>', $body);
            }

            //if we are on the login page, we need to add 'admin com_login view-login layout-default' classes
            if(strpos($body, 'admin com_login view-login layout-default') !== false){
                $body = str_replace('admin com_login view-login layout-default', 'admin admin-site com_login view-login layout-default '.$color_class, $body);
            }
            else{
                $body = str_replace('<body', '<body class="'.$color_class.' admin-site"', $body);
            }



            


            $app->setBody($body);
        }
    }

}