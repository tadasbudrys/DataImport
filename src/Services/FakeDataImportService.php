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

namespace PrestaShop\Module\DataImport\Services;

use PrestaShop\Module\dataimport\Classes\CallCategoryImportClass;
use PrestaShop\Module\dataimport\Classes\CallClientImportClass;
use PrestaShop\Module\dataimport\Classes\CallProductImportClass;
use PrestaShop\Module\dataimport\Classes\DataImporterClass;

class FakeDataImportService
{
    public function getImportDataType($dataTypes): array
    {
        foreach ($dataTypes as $dataType) {
            if ($dataType['import'] == 'random_data_api_user') {
                return (new DataImporterClass)->getImporter(new CallClientImportClass);
            }

            if ($dataType['import'] == 'fake_store_api_products') {
                return (new DataImporterClass)->getImporter(new CallProductImportClass);
            }

            if ($dataType['import'] == 'random_data_api_categories') {
                return (new DataImporterClass)->getImporter(new CallCategoryImportClass);
            }

            return ['status' => 'error', 'message' => 'Importer not found'];
        }
    }
}
