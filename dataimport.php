<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */

declare(strict_types=1);

use PrestaShop\PrestaShop\Adapter\SymfonyContainer;

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__.'/vendor/autoload.php';

class DataImport extends Module
{

    public $tabs = [
        [
            'route_name' => 'fake_data_generator',
            'class_name' => 'AdminUserController',
            'visible' => true,
            'name' => 'test Import fake data test',
            'parent_class_name' => 'CONFIGURE',
        ],
    ];

    public function __construct()
    {
        $this->name = 'dataimport';
        $this->author = 'PrestaShop';
        $this->version = '1.0.0';
        $this->ps_versions_compliancy = ['min' => '1.7', 'max' => _PS_VERSION_];

        parent::__construct();

        $this->displayName = $this->trans('Data Import', [], 'Modules.dataimport.Config');
        $this->description = $this->trans('Data Import', [], 'Modules.dataimport.Config');
    }

    /**
     * @return bool
     */
    public function install()
    {
        return parent::install();
    }

    /**
     * @return bool
     */
    public function uninstall()
    {
        return parent::uninstall();
    }

    public function getContent()
    {
        $route = SymfonyContainer::getInstance()->get('router')->generate('configuration_form');
        Tools::redirectAdmin($route);
    }
}
