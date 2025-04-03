<?php

namespace App\Controller;

use App\Entity\ChecklistTemplate;
use App\Entity\ProjectChecklist;
use App\Entity\ProjectChecklistItem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProjectChecklistController extends AbstractController
{
    #[Route('/project/checklist', name: 'app_project_checklist')]
    public function index(): Response
    {
        return $this->render('project_checklist/index.html.twig', [
            'controller_name' => 'ProjectChecklistController',
        ]);
    }

    #[Route('/project/checklist/from-template/{id}', name: 'project_checklist_create_from_template')]
    public function createFromTemplate(
        ChecklistTemplate $template,
        EntityManagerInterface $em
    ): Response {
        // 1. Créer le projet
        $project = new ProjectChecklist();
        $project->setName('Projet basé sur : ' . $template->getTitle());
        $project->setClient('Client test'); // à adapter ou à remplir via formulaire
        $project->setCreatedAt(new \DateTimeImmutable());
        $project->setTemplate($template);

        // 2. Dupliquer chaque item du modèle
        foreach ($template->getItems() as $templateItem) {
            $item = new ProjectChecklistItem();
            $item->setLabel($templateItem->getLabel());
            $item->setIsChecked(false);
            $item->setPosition($templateItem->getPosition());
            $item->setProject($project);

            $em->persist($item);
            $project->addItem($item);
        }

        // 3. Sauvegarder en BDD
        $em->persist($project);
        $em->flush();

        // 4. Rediriger vers un affichage ou la liste
        return $this->redirectToRoute('app_project_checklist');
    }

    #[Route('/project/checklist/{id}', name: 'project_checklist_show')]
    public function show(ProjectChecklist $project): Response
    {
        return $this->render('project_checklist/show.html.twig', [
            'project' => $project,
        ]);
    }
}
