<?php

namespace App\Controller\Admin;

use App\Entity\Config;
use App\Form\Admin\Config\EntryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class ConfigController
 *
 * @package App\Controller\Admin
 *
 * @Route("/admin/config")
 */
class ConfigController extends AbstractController
{
    /**
     * @Route("/", name="admin_config")
     */
    public function index(AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        $entities = $this->getDoctrine()
            ->getRepository(Config::class)
            ->findAll();
        $form = $this->createForm(EntryType::class);
        return $this->render('admin/config/index.html.twig', [
            'selectedNav' => 'admin-config',
            'existingConfig' => $entities,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/add", name="admin_config_add")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function add(Request $request, AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_SUPERADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        $configEntry = new Config();
        $form = $this->createForm(EntryType::class, $configEntry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \Doctrine\ORM\EntityManager $em */
            $em = $this->getDoctrine()->getManager();

            /** @var Config $entity */
            $entity = $form->getData();
            $slug = $entity->getSlug();

            /** @var \App\Entity\Config $entity */
            $entity = $this->getDoctrine()
                ->getRepository(Config::class)
                ->findOneBySlug($slug);

            if (is_null($entity)) {
                $entity = new Config();
                $entity->setSlug($slug);
            }

            $entity->setValue($form->getData()->getValue());

            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('admin_config');
        }

        return $this->render('admin/config/add.html.twig', [
            'selectedNav' => 'admin-config',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{slug}", name="admin_config_edit")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit($slug, Request $request, AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        /** @var \App\Entity\Config $configEntry */
        $configEntry = $this->getDoctrine()
            ->getRepository(Config::class)
            ->findOneBySlug($slug);

        if (is_null($configEntry)) {
            throw new \InvalidArgumentException('Slug cannot be found');
        }

        $form = $this->createForm(EntryType::class, $configEntry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \Doctrine\ORM\EntityManager $em */
            $em = $this->getDoctrine()->getManager();

            /** @var Config $entity */
            $entity = $form->getData();
            $em->detach($entity);

            $entity = new Config();
            $entity->setSlug($form->getData()->getSlug());
            $entity->setValue($form->getData()->getValue());
            $entity->setConfigGroup($configEntry->getConfigGroup());

            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('admin_config');
        }

        return $this->render('admin/config/add.html.twig', [
            'selectedNav' => 'admin-config',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{slug}", name="admin_config_delete")
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function delete($slug, AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_SUPERADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var \App\Entity\Config $entity */
        $entity = $this->getDoctrine()
            ->getRepository(Config::class)
            ->findOneBySlug($slug);

        $em->remove($entity);
        $em->flush();

        return $this->redirectToRoute('admin_config');
    }
}
