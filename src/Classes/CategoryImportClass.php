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

namespace PrestaShop\Module\DataImport\Classes;

use Configuration;
use PrestaShop\Module\DemoProductForm\Interfaces\DataImporterInterface;
use PrestaShop\PrestaShop\Adapter\Entity\Category;

class CategoryImportClass implements DataImporterInterface
{
    private $url = 'https://fakestoreapi.com/products/categories';
    private $importLang = '';

    public function __construct()
    {
        $this->importLang = Configuration::get('import_lang');
    }

    public function CallToApi(): object
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $this->response = curl_exec($curl);

        if (curl_errno($curl)) {
            $this->response = false;
            return $this;
        }
        curl_close($curl);
        $this->response = json_decode($this->response, true);
        return $this;
    }

    public function saveApiData(): array
    {
        if (!$this->response) {
            return ['status' => 'error', 'message' => "Unable connect to Url: $this->url"];
        }
        $newCategory = new Category();
        $createdCategories = '';
        foreach ($this->response as $category) {
            $newCategory->name = array((int)$this->importLang => $category);
            $newCategory->id_parent = 2;
//          ?? why not work ? Category->link_rewrite is not valid
//          $newCategory->link_rewrite = array((int)$this->importLang => $category);
            $newCategory->link_rewrite = array(1 => 'test');
            if ($newCategory->save()) {
                $createdCategories .= $category . ', ';
            }
        }

        return ['status' => 'success', 'message' => "Catiegores: <b> $createdCategories </b> was created"];
    }
}
