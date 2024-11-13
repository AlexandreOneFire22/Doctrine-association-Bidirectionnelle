<?php

require_once __DIR__ . '/../config/bootstrap.php';

use App\Entity\OneToMany\Bidirectionnelle\Post;

try {
    // ID du post dont on veut récupérer les commentaires
    $postId = 13; // Vous pouvez modifier cet ID selon vos besoins

    // Récupérer le post
    $post = $entityManager->find(Post::class, $postId);

    if (!$post) {
        throw new Exception("Aucun post trouvé avec l'ID $postId");
    }

    // Récupérer les commentaires associés au post
    $comments = $post->getComments();

    echo "Commentaires du post '" . $post->getTitre() . "' :\n";
    echo "----------------------------------------\n";

    if ($comments->isEmpty()) {
        echo "Aucun commentaire trouvé pour ce post.\n";
    } else {
        foreach ($comments as $comment) {
            echo "ID: " . $comment->getId() . "\n";
            echo "Auteur: " . $comment->getAuteur() . "\n";
            echo "Date: " . $comment->getCreatedAt()->format('Y-m-d H:i:s') . "\n";
            echo "Contenu: " . $comment->getContenu() . "\n";
            echo "----------------------------------------\n";
        }
        echo "Total: " . $comments->count() . " commentaire(s)\n";
    }
} catch (Exception $e) {
    echo "Une erreur s'est produite : " . $e->getMessage() . "\n";
}
