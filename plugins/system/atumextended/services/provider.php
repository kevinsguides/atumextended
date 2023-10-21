<?php

/**
 * @package     KevinsGuides.AtumExtended
 * @subpackage  System.atumextended
 *
 * @copyright   (C) 2023 
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\Database\DatabaseInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use KevinsGuides\Plugin\System\AtumExtended\Extension\AtumExtended;

return new class () implements ServiceProviderInterface {
    /**
     * Registers the service provider with a DI container.
     *
     * @param   Container  $container  The DI container.
     *
     * @return  void
     *
     * @since   4.4.0
     */
    public function register(Container $container): void
    {
        $container->set(
            PluginInterface::class,
            function (Container $container) {
                return new AtumExtended(
                    $container->get(DispatcherInterface::class),
                    (array) PluginHelper::getPlugin('system', 'atumextended'),
                    $container->get(DatabaseInterface::class)
                );
            }
        );
    }
};
