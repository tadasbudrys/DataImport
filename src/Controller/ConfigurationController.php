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

namespace PrestaShop\Module\DataImport\Controller;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfigurationController extends FrameworkBundleAdminController
{

    public function index(Request $request): Response
    {
        $textFormDataHandler =
            $this->get('prestashop.module.demoproductform.form.demo_configuration_text_form_data_handler');
        $textForm = $textFormDataHandler->getForm();

        return $this->render('@Modules/DataImport/views/templates/admin/config_form.html.twig', [
            'ConfigurationTextForm' => $textForm->createView(),
        ]);
    }


    public function createAction(Request $request): Response
    {
        $textFormDataHandler =
            $this->get('prestashop.module.demoproductform.form.demo_configuration_text_form_data_handler');
        $textForm = $textFormDataHandler->getForm();
        $textForm->handleRequest($request);

        if ($textForm->isSubmitted() && $textForm->isValid()) {
            /** You can return array of errors in form handler and they can be displayed to user with flashErrors */
            $errors = $textFormDataHandler->save($textForm->getData());

            if (empty($errors)) {
                $this->addFlash('success', $this->trans('Successful update.', 'Admin.Notifications.Success'));

                return $this->redirectToRoute('configuration_form');
            }

            $this->flashErrors($errors);
        }

        return $this->redirectToRoute('fake_data_generator');
    }
}
