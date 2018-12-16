# IPSSI - ASI 20.2 - OOP

**Alexandre GIANNETTO**

## Sujet de contrôle

Le contrôle comporte deux parties, une pratique et une théorique.

Le projet comporte les dépendances nécessaires à la réalisation du projet, incluant un fichier `composer.json`.

La date de rendu est fixée au 12/17/2018 12:00 Europe/Paris.

La partie pratique consiste à réaliser un puissance 4 (connect four) multijoueur (les joueurs sont répartis dans les deux équipes).

### Dépendances

Pour simplifier la réalisation du projet, la référence à `zendframework/zend-servicemanager` est déjà explicitée dans le `composer.json`.

`zendframework/zend-servicemanager` est une librairie fournissant une implémentation pour un container d'injection de dépendance compatible PSR-11.

Du code est fourni dans `support` et déjà auto chargé. Un début de jeu puissance4 est fourni, vous devez le compléter avec les classes nécessaires pour représenter les pions, le terrain de jeu (grille). Vous ne pouvez pas changer le code dans le dossier support, vous devrez donc profiter de l'interface `Game` et de l'injection de dépendance fournie pour proposer votre propre implémentation du jeu dans `src`.

### Exécution / Résultat

Le résultat de l'exécution du code à l'aide du client CLI de PHP (`php index.php connect4`) doit résulter dans la trace d'execution suivante :

> Initialisation du jeu avec {{ nombre de participants}} participants.  
> Initialisation de la grille en 7 colonnes et 6 lignes.  
> Exclusion d'un participant si nombre impair.  
> Choix aléatoire des équipes (rouge et jaune).  
> Choix aléatoire de l'identifiant du premier participant.  
> Joueur 3 (rouge) joue dans la case 1,1.  
> Joueur 1 (jaune) joue dans la case 2,1.  
> Partie terminée, rouge gagne.  
 
Bien entendu la partie déroulement du jeu peu changer (aléatoire). Les coordonnées sont exprimées dans le référentiel suivant :

| 6,1 | 6,2 | 6,3 | 6,4 | 6,5 | 6,6 | 6,7 |
|-----|-----|-----|-----|-----|-----|-----|
| 5,1 | 5,2 | 5,3 | 5,4 | 5,5 | 5,6 | 5,7 |
| 4,1 | 4,2 | 4,3 | 4,4 | 4,5 | 4,6 | 4,7 |
| 3,1 | 3,2 | 3,3 | 3,4 | 3,5 | 3,6 | 3,7 |
| 2,1 | 2,2 | 2,3 | 2,4 | 2,5 | 2,6 | 2,7 |
| 1,1 | 1,2 | 1,3 | 1,4 | 1,5 | 1,6 | 1,7 |

La première équipe arrivant à 4 pions en ligne, colonne ou diagonale à gagné.

### Environnement

Pour exécuter le projet, il faudra lancer le fichier `index.php` en ligne de commande.

Des instructions pour l'exécution doivent être fournies dans le fichier `doc/install.md`, et la mise en place de l'environnement doit se faire en 1 ou 2 commandes maximum.

Un `Dockerfile` voir un `docker-compose.yaml` peuvent être fournis, en quel cas l'exécution pourra être faite à l'aide de ces outils. Dans tout autre cas, `php` en version `7.2.12-cli` sera utilisée.

### Notation

#### Pratique

* 1 point pour l'auto chargement des classes à l'aide de Composer.
* 1 point pour le respect des recommandations PSR-2, testé avec php-cs-fixer (avec les règles PSR-2 uniquement).
* 1 point pour le respect de la trace de sortie.
* 3 points pour les entités (joueur, équipe, pions rouges et jaunes, grille, partie, tour de jeu, etc)
* 1 point pour l'ajout d'interfaces quand nécessaire.
* 1 point pour l'ajout de final quand nécessaire.
* 1 point pour l'utilisation d'un héritage au bon endroit.
* 1 point pour ne pas avoir de méthode de plus de 9 lignes.
* 1 point pour l'utilisation intensive du container d'injection de dépendance, des interfaces et de l'inversion de dépendance.
* 4 point pour le fonctionnement global.

#### Théorie

* 1 point pour donner les noms de fichiers et les lignes de ces fichiers dans lesquelles un mécanisme d'inversion de dépendance est à l'oeuvre.
* 2 points pour un diagramme de classe incluant les classes et interfaces que vous avez créé ainsi que celles dont vous dépendez
* 2 points pour un court argumentaire sur le thème "héritage vs composition", avantage et inconvénient de chaque (un travail de recherche court est donc à effectuer, "Composition over inheritance" en anglais). Le texte fourni doit faire 500 mots.

### Tolérances

Bien que le code fourni soit en anglais, le code produit lors de votre contrôle peut être écrit en français.

L'environnement docker est facultatif.

Une tolérance de 20% en plus ou moins est appliquée sur le nombre de mots de la dernière question théorique.
