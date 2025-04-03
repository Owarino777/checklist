# ✅ Checklist Manager

Projet Symfony permettant de créer des modèles de checklists, et de les associer à des projets concrets.

## 🧱 Technologies
- Symfony 6+
- PHP 8.2+
- Doctrine ORM
- SQLite (var/data.db)
- Tailwind CSS (via Symfony TailwindBundle)

## 📁 Fonctionnalités actuelles
- Initialisation du projet Symfony
- Configuration BDD SQLite
- Intégration de Tailwind CSS via le bundle officiel
- Création des entités :
  - ChecklistTemplate
  - ChecklistItemTemplate
  - ProjectChecklist
  - ProjectChecklistItem
- Relations Doctrine bien définies
- Prêt pour les migrations

## ✅ Tests fonctionnels validés (recettage)
| **Test**                                   | **Statut** | **Détail**                                                                 |
|--------------------------------------------|------------|-----------------------------------------------------------------------------|
| Accès à `/checklist/template/`             | ✅          | Affichage de l’index CRUD                                                  |
| Création d’un template                     | ✅          | `title` requis, `description` optionnelle                                  |
| Édition d’un template existant             | ✅          | Formulaire fonctionnel                                                     |
| Suppression d’un template                  | ✅          | Redirection correcte                                                       |
| Visualisation (show) d’un template         | ✅          | Affichage des données                                                      |
| Contrôle de la validation (`title` vide)   | ✅          | Erreur affichée (non valide)                                               |
| Style Tailwind appliqué sur la vue         | ✅/🟡       | Présent mais peut être amélioré (vues générées à styliser)                 |
| Données persistées dans SQLite (`var/data.db`) | ✅          | Les données sont sauvegardées et récupérées sans erreur                    |

## 🚀 Lancement en local

```bash
symfony serve
php bin/console doctrine:migrations:migrate
npm run dev
