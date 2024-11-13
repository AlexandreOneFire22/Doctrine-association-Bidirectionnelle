<?php

require_once __DIR__ . '/../config/bootstrap.php';

// Récupération de l'EntityManager
$entityManager = require_once __DIR__ . '/../config/bootstrap.php';

use App\Entity\OneToMany\Bidirectionnelle\Comment;
use App\Entity\OneToMany\Bidirectionnelle\Post;

try {
    // Récupérer un post existant (par exemple avec l'ID 1)
    $post = $entityManager->find(Post::class, 2);

    if (!$post) {
        throw new Exception("Aucun post trouvé avec l'ID 1");
    }

    // Créer un nouveau commentaire
    $comment = new Comment();
    $comment->setAuteur('Auteur Exemple');
    $comment->setContenu('Super article bidirectionnel !');
    $comment->setCreatedAt(new \DateTime());

    // Définir le post du commentaire (côté propriétaire)
    $comment->setPost($post);
    // Ajouter le commentaire au post
    $post->addComment($comment);

    // Persister le commentaire
    $entityManager->persist($comment);
    $entityManager->flush();

    // Vérification
    echo "Commentaire créé avec l'ID : " . $comment->getId() . "\n";
} catch (Exception $e) {
    echo "Une erreur s'est produite : " . $e->getMessage() . "\n";
}
