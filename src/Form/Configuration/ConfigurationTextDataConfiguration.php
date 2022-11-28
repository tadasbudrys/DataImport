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

namespace PrestaShop\Module\DataImport\Form\Configuration;

use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;
use PrestaShop\PrestaShop\Core\ConfigurationInterface;

/**
 * Configuration is used to save data to configuration table and retrieve from it
 */
final class ConfigurationTextDataConfiguration implements DataConfigurationInterface
{
    public const IMPORT_CLIENT = 'import_client';
    public const IMPORT_PRODUCT = 'import_product';
    public const IMPORT_CATEGORY = 'import_category';
    public const IMPORT_LANG = 'import_lang';

    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    /**
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration(): array
    {
        $return = [];

        if ($clientSource = $this->configuration->get(static::IMPORT_CLIENT)) {
            $return['import_client'] = $clientSource;
        }
        if ($productSource = $this->configuration->get(static::IMPORT_PRODUCT)) {
            $return['import_product'] = $productSource;
        }
        if ($categorySource = $this->configuration->get(static::IMPORT_CATEGORY)) {
            $return['import_category'] = $categorySource;
        }
        if ($importLang = $this->configuration->get(static::IMPORT_LANG)) {
            $return['import_lang'] = $importLang;
        }

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function updateConfiguration(array $configuration): array
    {
        $this->configuration->set(static::IMPORT_CLIENT, $configuration['import_client']);
        $this->configuration->set(static::IMPORT_PRODUCT, $configuration['import_product']);
        $this->configuration->set(static::IMPORT_CATEGORY, $configuration['import_category']);
        $this->configuration->set(static::IMPORT_LANG, $configuration['import_lang']);

        /* Errors are returned here. */

        return [];
    }

    /**
     * Ensure the parameters passed are valid.
     *
     * @param array $configuration
     *
     * @return bool Returns true if no exception are thrown
     */
    public function validateConfiguration(array $configuration): bool
    {
        return true;
    }
}
