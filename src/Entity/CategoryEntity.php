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

namespace PrestaShop\Module\DataImport\Entity;

use PrestaShop\PrestaShop\Adapter\Entity\Category;

/**
 * Example object model for module custom product fields
 */
final class CategoryEntity extends Category
{
    public function getCategoriesNames(string $name = 'nul')
    {
//        Query builder does not escape ' ?
        $name = addslashes($name);

        return \Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            '
		SELECT `id_category` FROM `'._DB_PREFIX_.'category_lang` where name = '."'".$name."'".' ORDER BY `id_category` ASC  LIMIT 1'
        );
    }

}
