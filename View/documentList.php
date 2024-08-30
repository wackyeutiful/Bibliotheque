<?php
require_once '../Model/Document.php';

// Initialize PDO connection (adjust path as needed)
$pdo = config::getConnexion();

// Retrieve all documents
$documents = Document::listDocuments($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Documents</title>
    <link rel="stylesheet" href="../View/style.css">
</head>
<body>
    <table  class="table" border>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Date Publication</th>
                <th>Catégorie</th>
                <th>Description</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($documents as $document): ?>
                <tr>
                    <td><?= $document['id_document']; ?></td>
                    <td><?= htmlspecialchars($document['titre']); ?></td>
                    <td><?= htmlspecialchars($document['auteur']); ?></td>
                    <td><?= htmlspecialchars($document['date_publication']); ?></td>
                    <td><?= htmlspecialchars($document['categorie']); ?></td>
                    <td><?= htmlspecialchars($document['description']); ?></td>
                    <td>
                        <button class="btn btn-danger btn-delete" onclick="deleteDocument(<?= $document['id_document']; ?>)">
                            <img src="../imgs/delete.png" alt="delete">
                        </button>
                    </td>

                    <td>
                        <button class="btn btn-primary btn-update" onclick="redirectToUpdateForm(<?= $document['id_document']; ?>)">
                            <img src="../imgs/edit.png" alt="edit">
                        </button>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <!-- documentList.php -->

<h1>Document Search</h1>
<form action="../Controller/DocumentController.php?action=searchDocuments" method="GET">
    <div>
        <label for="titre">Title:</label>
        <input type="text" id="titre" name="titre">
    </div>
    <div>
        <label for="auteur">Author:</label>
        <input type="text" id="auteur" name="auteur">
    </div>
    <div>
        <label for="categorie">Category:</label>
        <input type="text" id="categorie" name="categorie">
    </div>
    <div>
        <label for="date_publication">Publication Date:</label>
        <input type="date" id="date_publication" name="date_publication">
    </div>
    <div>
        <label for="sort_by">Sort By:</label>
        <select id="sort_by" name="sort_by">
            <option value="titre">Title</option>
            <option value="auteur">Author</option>
            <option value="date_publication">Publication Date</option>
            <option value="categorie">Category</option>
        </select>
    </div>
    <button type="submit">Search</button>
</form>

<h2>Document List</h2>
<table border>
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Publication Date</th>
            <th>Category</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($documents)): ?>
            <?php foreach ($documents as $document): ?>
                <tr>
                    <td><?= htmlspecialchars($document['titre']); ?></td>
                    <td><?= htmlspecialchars($document['auteur']); ?></td>
                    <td><?= htmlspecialchars($document['date_publication']); ?></td>
                    <td><?= htmlspecialchars($document['categorie']); ?></td>
                    <td><?= htmlspecialchars($document['description']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">No documents found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

        
    <script>
    function deleteDocument(id_document) {
        if (confirm('Are you sure you want to delete this document?')) {
            window.location.href = '../Controller/DocumentController.php?action=deleteDocument&id_document=' + id_document;
        }
    }   
    function redirectToUpdateForm(id_document) {
         window.location.href = '../Controller/DocumentController.php?action=editDocument&id_document=' + id_document;
    }

    </script>
    

</body>
</html>
