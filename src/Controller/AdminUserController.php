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

use PrestaShop\Module\DataImport\Services\FakeDataImportService;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminUserController extends FrameworkBundleAdminController
{
    public function indexAction(): Response
    {
        $form = $this
            ->get('prestashop.module.demo_product_form.form.identifiable_object.builder.content_block_form_builder')
            ->getForm();

        return $this->render('@Modules/DataImport/views/templates/admin/import_data.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    public function createAction(Request $request): Response
    {
//        $d = $request->request->;
//        $d = $d['import_data'];
//        dump($d);
//        die;
        $service = (new FakeDataImportService)->getImportDataType($request->request);

        $this->addFlash(
            $service['status'],
            $service['message']
        );

        if (isset($service['failed'])) {
            $this->addFlash(
                $service['error'],
                $service['message']
            );
        }

        return $this->redirectToRoute('fake_data_generator');
    }
}
