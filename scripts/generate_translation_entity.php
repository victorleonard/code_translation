<?php

use Symfony\Component\Filesystem\Filesystem;

require __DIR__ . '/../vendor/autoload.php';

$entityName = readline("Nom de l'entité (ex: HotelTranslations) : ");
$tableName = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $entityName)); // Convertit en snake_case

// Configuration de base
$basePath = __DIR__ . '/../src/Entity/';
$namespace = 'App\\Entity';
$repositoryNamespace = 'App\\Repository';
$interfaceNamespace = 'App\\Entity\\TranslatableInterface';

$template = <<<EOT
<?php

namespace $namespace;

use ApiPlatform\Metadata\ApiResource;
use $repositoryNamespace\\{$entityName}Repository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: {$entityName}Repository::class)]
#[ORM\Table(name: '$tableName', uniqueConstraints: [
    new ORM\UniqueConstraint(name: 'unique_code_category', columns: ['code', 'category'])
])]
#[UniqueEntity(
    fields: ['code', 'category'],
    message: 'This code and category combination already exists.'
)]
#[ApiResource(
    denormalizationContext: ['groups' => ['translation']],
)]
class $entityName
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int \$id = null;

    #[ORM\Column(length: 50)]
    #[Groups("translation")]
    private ?string \$code = null;
    
    #[ORM\Column(length: 50)]
    #[Groups("translation")]
    private ?string \$category = null;

    #[ORM\Column(length: 255)]
    #[Groups("translation")]
    private ?string \$description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface \$createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface \$updatedAt = null;

    public function __construct()
    {
        \$this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return \$this->id;
    }

    public function setId(Uuid \$id): static
    {
        \$this->id = \$id;

        return \$this;
    }

    public function getCategory(): ?string
    {
        return \$this->category;
    }

    public function setCategory(string \$category): static
    {
        \$this->category = \$category;

        return \$this;
    }

    public function getDescription(): ?string
    {
        return \$this->description;
    }

    public function getCode(): ?string
    {
        return \$this->code;
    }

    public function setCode(string \$code): static
    {
        \$this->code = \$code;

        return \$this;
    }

    public function setDescription(?string \$description): static
    {
        \$this->description = \$description;

        return \$this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return \$this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface \$createdAt): static
    {
        \$this->createdAt = \$createdAt;

        return \$this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return \$this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface \$updatedAt): static
    {
        \$this->updatedAt = \$updatedAt;

        return \$this;
    }
}
EOT;

// Création du fichier d'entité
$filesystem = new Filesystem();
$filePath = $basePath . $entityName . '.php';

if ($filesystem->exists($filePath)) {
    echo "Erreur : L'entité $entityName existe déjà.\n";
    exit;
}

$filesystem->dumpFile($filePath, $template);

// Génération de l'interface TranslatableInterface si elle n'existe pas encore
$interfacePath = $basePath . 'TranslatableInterface.php';
if (!$filesystem->exists($interfacePath)) {
    $interfaceTemplate = <<<EOT
<?php

namespace $namespace;

interface TranslatableInterface
{
    // Marqueur pour les entités traduisibles
}
EOT;
    $filesystem->dumpFile($interfacePath, $interfaceTemplate);
}

// Génération d'un fichier de dépôt vide pour l'entité si nécessaire
$repositoryPath = __DIR__ . '/../src/Repository/' . $entityName . 'Repository.php';
if (!$filesystem->exists($repositoryPath)) {
    $repositoryTemplate = <<<EOT
<?php

namespace $repositoryNamespace;

use $namespace\\$entityName;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class {$entityName}Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry \$registry)
    {
        parent::__construct(\$registry, $entityName::class);
    }
}
EOT;
    $filesystem->dumpFile($repositoryPath, $repositoryTemplate);
}

echo "Entité $entityName créée avec succès dans $filePath.\n";

// Rappel pour générer les fichiers associés
echo "N'oubliez pas d'exécuter les commandes suivantes :\n";
echo "  php bin/console make:migration\n";
echo "  php bin/console doctrine:migrations:migrate\n";
