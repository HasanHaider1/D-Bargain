<?php
// modules/your-module/src/Controller/DemoController.php

namespace productbargain\controller;

//use Doctrine\Common\Cache\CacheProvider;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use productbargain\Entity\Bargains;
use productbargain\Entity\BargainSetting;
use productbargain\Entity\BargainIterations;
use productbargain\Forms\BargainType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class BargainController extends FrameworkBundleAdminController
{

    public function settingAction(Request $request)
    {
        // logic to store the data to the DB
        $em = $this->getDoctrine()->getManager();
        $bargain = $this->getDoctrine()
            ->getRepository(BargainSetting::class)->find(1);

        // if edit
        if ($bargain  != null) {
            $form = $this->createForm(BargainType::class, $bargain);
        } else {
            $form = $this->createForm(BargainType::class);
        }
        $form->handleRequest($request);

        // logic of form handling
        if (
            $form->isSubmitted()
            && $form->isValid()
        ) {
            // prepare the object that will be saved to the DB
           // $bargain = new BargainSetting();
            $bargain->setColor($form->get('color')->getData());
            $bargain->setIterations($form->get('iterations')->getData());


            // persist the data
           // $em->persist($bargain);
            $em->flush();


            $this->addFlash(
                'success',
                'Bargain Setting Updated'
            );
            return $this->redirectToRoute('bargain-setting');
        }

        return $this->render(
            '@Modules/productbargain/templates/admin/create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }


    public function listAction()
    {
        $em= $this->getDoctrine()->getManager();
        $data=$em->getRepository(Bargains::class)->findAll();
        return $this->render('@Modules/productbargain/templates/admin/list.html.twig',['data'=>$data]);
    }



    public function detailsAction(int $id, Request $request)
    {
        if ($id === null)
            return null; // better display an error message here

        $entityManager = $this->getDoctrine()->getManager();

        $iterations = $entityManager
            ->getRepository(BargainIterations::class)
            ->findBy(['bargain_id'=>$id]);


        return $this->render('@Modules/productbargain/templates/admin/details.html.twig',['data'=>$iterations]);

    }



}