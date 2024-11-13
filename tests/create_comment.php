<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Récupération de l'EntityManager
$entityManager = require_once __DIR__ . '/../config/bootstrap.php';

use App\Entity\OneToMany\Unidirectionnelle\Comment;
use App\Entity\OneToMany\Unidirectionnelle\Post;

try {
    // Récupérer un post existant (par exemple celui avec l'ID 1)
    $post = $entityManager->find(Post::class, 2);

    if (!$post) {
        throw new Exception("Aucun post trouvé avec l'ID 1");
    }

    // Création d'un nouveau commentaire
    $comment = new Comment();
    $comment->setAuteur("John Doe");
    $comment->setContenu("Super article, merci pour le partage !");
    $comment->setCreatedAt(new DateTime());
    // Définir le post du commentaire
    $comment->setPost($post);

    // Persister le commentaire
    $entityManager->persist($comment);
    $entityManager->flush();

    // Vérification
    echo "Commentaire créé avec l'ID : " . $comment->getId() . "\n";
} catch (Exception $e) {
    echo "Une erreur s'est produite : " . $e->getMessage() . "\n";
}
