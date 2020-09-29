# Test technique Morpheus Branchement

## Sujet

L’équipe Morpheus a signé des contrats avec deux clients.

Le premier nous donne un fichier JSON d’annonces immo que nous devons importer sur leboncoin. Les libellés des champs sont plutôt explicites dans le fichier. Cependant, certains champs ne sont pas nécessaires pour Leboncoin.

Le second est un fichier XML d’annonces emploi d’une agence d’Intérim. On nous demande de concaténer les champs description_poste et description_entreprise pour pouvoir afficher toutes ces informations dans le corps de l’annonce. 
Ces champs comportent des balises HTML mais Leboncoin n’accepte pas le HTML. Il faut donc nettoyer ces champs tout en gardant un rendu compréhensible (garder les sauts de ligne et les listes).

Avec le projet Symfony fournit, traitez et transformez les deux fichiers d’annonces pour qu’ils puissent être acceptés par l’API documentée ci-dessous.

Des tests unitaires sont nécessaires concernant les Hooks et leurs fonctions. 

## Bonus

Le code postal n’est pas présent dans les données XML mais on aimerait tout de même l’avoir. Il vous est demandé de proposer une solution technique pour récupérer le code postal mais l’implémentation est optionnelle.

## Rendu

Vous devez rendre un projet Symfony fonctionnel qui transforme des annonces pour un envoi vers l’API Leboncoin. Vous pouvez aussi rendre un court rapport de quelques lignes décrivant certains problèmes à résoudre ou des pistes d’amélioration.

Les données des clients ne sont pas forcément de bonne qualité ou à l’inverse intègrent des informations dont l’API Leboncoin n’a pas besoin. Cependant, pour améliorer la qualité des annonces importées, vous pouvez proposer des solutions pour intégrer davantage de données. Vous pouvez implémenter ces solutions pour prouver le concept proposé mais tout ceci est optionnel.

Une attention sera apportée à la qualité du code mais faites au plus simple avec le temps que vous avez.

## Documentation

La documentation de l'API est disponible dans le fichier `Sujet.pdf`.

## Lancement

```
bin/console command-name {filepath}
```


## Rendu Candidat
Voici les problèmes que j'ai rencontré et que j'ai essayé de résoudre:
	job.xml => 	- il manqué le type de contrat(je l'ai trouver dans le sujet) dans le xml
				- il manqué le id donc je l'ai déterminé avec le client_reference (j'ai pris le 2ème segement séparer par le tiret)



## Rendu Bonus

Solution1 (qui a été mis en place): 

    Pour le code postal je fais une appel à l'api (https://geo.api.gouv.fr/adresse) de la BAN du gouvernement pour récupérer le code postal.


Solution2:

     Avoir une entité avec au minimum les champs suivants: ville, code_postale, département et le pays. 
     Ensuite il suffit de faire une query pour trouver le code postal  avec la ville et le département.
