# Guide d'installation et d'utilisation du projet

## 1. Lancer le projet

### Prérequis
- PHP 8.1 ou supérieur
- Composer
- Symfony CLI

### Installation
1. Clonez le dépôt :
   ```bash
   git clone <URL_DU_DEPOT>
   cd <NOM_DU_DEPOT>
   ```
2. Installez les dépendances :
   ```bash
   composer install
   ```
3. Configurez le fichier `.env` :
   - Configurez les informations de connexion à la base de données.

4. Lancez les migrations pour créer les tables :
   ```bash
   symfony console doctrine:migrations:migrate
   ```

5. Démarrez le serveur Symfony :
   ```bash
   symfony server:start
   ```

---

## 2. Lancer les fixtures

Pour remplir la base de données avec des données de test, utilisez la commande suivante :
```bash
symfony console doctrine:fixtures:load
```
Cela ajoutera des données pour les entités `AirlineTranslations`, `HotelTranslations` et `Subscription`.

---

## 3. Ajouter des SupportedDomains

### Localisation
Les domaines supportés sont définis dans le fichier :
`src/Config/SupportedDomains.php`

### Exemple
Pour ajouter un nouveau domaine, modifiez le tableau dans `SupportedDomains` :
```php
const DOMAINS = [
    'airline' => \App\Entity\AirlineTranslations::class,
    'hotel' => \App\Entity\HotelTranslations::class,
    'new_domain' => \App\Entity\NewDomainTranslations::class,
];
```

### Utilité
- Les `SupportedDomains` permettent de lier dynamiquement un domaine à une entité.
- Ils sont utilisés pour récupérer les traductions dans le service `CodeTranslator`.

---

## 4. Ajouter un domaine
Executer la commande
'''php 
php scripts/generate_translation_entity.php
'''
Puis créez une migration de la table : 
'''php 
php bin/console make:migration
php bin/console doctrine:migrations:migrate
'''

## 5. Ajouter une traduction

### Exemple : Ajouter une traduction pour les hôtels
Envoyez une requête POST vers `/api/hotel_translations` avec le payload suivant :
```json
{
  "code": "DELUXE",
  "category": "ROOM_TYPE",
  "description": "Suite de luxe"
}
```

---

## 6. Récupérer une traduction

### Via l'API
Utilisez l'endpoint générique : `/api/translate`

#### Exemple de requête
GET `/api/translate?domain=hotel&code=DELUXE&category=ROOM_TYPE`

#### Exemple de réponse
```json
{
  "description": "Suite de luxe"
}
```

---

## 7. Organisation du projet

### Structure principale
- **`src/Entity`** : Contient les entités Doctrine (AirlineTranslations, HotelTranslations, etc.).
- **`src/Service`** : Contient les services comme `CodeTranslator`.
- **`src/Controller`** : Contient les contrôleurs pour les endpoints personnalisés.
- **`src/Config`** : Contient la configuration des domaines supportés (`SupportedDomains`).
- **`tests/`** : Contient les tests unitaires et fonctionnels.