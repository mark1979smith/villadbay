<?php

namespace App\Controller\Admin;

use App\Component\Config\Entry;
use App\Component\Config\Groups as ConfigGroups;
use App\Entity\Config;
use App\Entity\ConfigGroup;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    public function index(AuthorizationCheckerInterface $authorizationChecker): Response
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        $configEntries = $this->getDoctrine()
            ->getRepository(Config::class)
            ->findAll();
        $configEntries = new Entry($configEntries);

        $configGroups = $this->getDoctrine()
            ->getRepository(ConfigGroup::class)
            ->findAll();
        $configGroups = new ConfigGroups($configGroups);

        return $this->render('admin/config/index.html.twig', [
            'selectedNav'          => 'admin-config',
            'existingConfigGroups' => $configGroups->getGroups(),
            'existingConfig'       => $configEntries->getLatestRevision(),
        ]);
    }

    /**
     * @Route("/add/{configGroupName}", name="admin_config_add")
     */
    public function add(Request $request, AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_SUPERADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $configGroup = $em->getRepository(ConfigGroup::class)
            ->findOneBy(['name' => base64_decode($request->get('configGroupName'))]);
        if (!($configGroup instanceof ConfigGroup)) {
            throw new \LogicException('Config Group cannot be found');
        }

        $configEntry = new Config();
        $configEntry->setConfigGroup($configGroup);
        $form = $this->createForm(\App\Form\Admin\Config\Entry\CreateType::class, $configEntry,
            ['config_groups' => $this->getConfigGroups()]);

        $form->handleRequest($request);

        if ($request->isMethod(Request::METHOD_POST)
            && $form->isSubmitted()
            && $form->isValid()) {
            // Ensure primary data does not exists
            $existingConfig = $em->getRepository(Config::class)
                ->findOneBySlug($form->getData()->getSlug());
            if (!is_null($existingConfig)) {
                throw new \LogicException('Slug exists');
            }

            $formConfigEntryOptions = array_map('trim', $form->getData()->getOpts());

            $entity = new Config();
            $entity->setSlug($form->getData()->getSlug());
            $entity->setValue(current($formConfigEntryOptions));
            $entity->setOpts($formConfigEntryOptions);
            $entity->setConfigGroup($form->getData()->getConfigGroup());
            $entity->setCreated(new \DateTimeImmutable());

            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('admin_config');
        }


        return $this->render('admin/config/add.html.twig', [
            'selectedNav' => 'admin-config',
            'form'        => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{slug}", name="admin_config_edit")
     */
    public function edit($slug, Request $request, AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        /** @var array $configEntry */
        $configEntry = $this->getDoctrine()
            ->getRepository(Config::class)
            ->findBy(['slug' => $slug]);

        if (is_null($configEntry)) {
            throw new \InvalidArgumentException('Slug cannot be found');
        }

        $config = new Entry($configEntry);
        /** @var Config $data */
        $data = $config->getLatestRevision($slug);
        $form = $this->createForm(\App\Form\Admin\Config\Entry\EditType::class, $data, [
            'config_options' => $data->getOpts(),
        ]);

        $form->handleRequest($request);

        if ($request->isMethod(Request::METHOD_POST)
            && $form->isSubmitted()
            && $form->isValid()) {
            /** @var \Doctrine\ORM\EntityManager $em */
            $em = $this->getDoctrine()->getManager();

            $entity = $form->getData();
            $em->detach($entity);
            $entity->setValue($form->getData()->getValue());
            $entity->setCreated(new \DateTimeImmutable());

            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('admin_config');
        }

        return $this->render('admin/config/add.html.twig', [
            'selectedNav' => 'admin-config',
            'form'        => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{slug}", name="admin_config_delete")
     */
    public function delete($slug, AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_SUPERADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var array $entities */
        $entities = $this->getDoctrine()
            ->getRepository(Config::class)
            ->findBy(['slug' => $slug]);

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return $this->redirectToRoute('admin_config');
    }

    protected function getConfigGroups(): array
    {
        return $this->getDoctrine()->getRepository(ConfigGroup::class)->findAll();
    }

}
