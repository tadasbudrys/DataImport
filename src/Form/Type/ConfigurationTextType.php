<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */

namespace PrestaShop\Module\DataImport\Form\Type;

use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;

class ConfigurationTextType extends TranslatorAwareType
{
    /**
     * @param TranslatorInterface $translator
     * @param array $locales
     * @param Currency $defaultCurrency
     */
    public function __construct(
        TranslatorInterface $translator,
        array $locales
    ) {
        parent::__construct($translator, $locales);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('import_client', ChoiceType::class, [
                'label' => 'Import clients',
                'required' => true,
                'choices' =>
                    [
                        'random data api user' => 'random_data_api_user',
                    ],
            ])
            ->add('import_product', ChoiceType::class, [
                'label' => 'Import product',
                'required' => true,
                'choices' =>
                    [
                        'fake store api products' => 'fake_store_api_products',
                    ],
            ])
            ->add('import_category', ChoiceType::class, [
                'label' => 'Import category',
                'required' => true,
                'choices' =>
                    [
                        'random data api categories' => 'random_data_api_categories',
                    ],
            ])
            ->add('import_lang', ChoiceType::class, [
                'label' => 'Import data lang',
                'required' => true,
                'choices' =>
                    [
                        'English' => 1,
                    ],
            ]);
    }
}
