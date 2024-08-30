<?php
require_once '../Model/Document.php';
require_once '../config.php';

class DocumentController {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = config::getConnexion();
    }

    // Method to handle adding a new document
    public function addDocument() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_document = (int)$_POST['id_document'];
            $titre = $_POST['titre'];
            $auteur = $_POST['auteur'];
            $date_publication = new DateTime($_POST['date_publication']);
            $categorie = $_POST['categorie'];
            $description = $_POST['description'];

            $document = new Document($id_document, $titre, $auteur, $date_publication, $categorie, $description, $this->pdo);

            if ($document->addDocument()) {
                header('Location: ../View/documentList.php?success=true');
                exit;
            } else {
                header('Location: ../View/documentList.php?error=true');
                exit;
            }
        }
    }

    // Method to handle editing a document
    public function editDocument() {
        if (isset($_GET['id_document'])) {
            $id_document = (int)$_GET['id_document'];
            $document = Document::searchDocument($this->pdo, $id_document);
    
            if ($document && count($document) > 0) {
                $document = $document[0];  // Get the first (and only) document
                require '../View/updateDocument.php';  // Pass the document to the view
            } else {
                echo "Document not found!";
                exit;
            }
        } else {
            echo "Invalid document ID!";
            exit;
        }
    }
    
    

    // Method to handle updating a document
    public function updateDocument() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_document = (int)$_POST['id_document'];
            $titre = $_POST['titre'];
            $auteur = $_POST['auteur'];
            $date_publication = new DateTime($_POST['date_publication']);
            $categorie = $_POST['categorie'];
            $description = $_POST['description'];
    
            $document = new Document($id_document, $titre, $auteur, $date_publication, $categorie, $description, $this->pdo);
    
            if ($document->updateDocument()) {
                header('Location: ../View/documentList.php?update_success=true');
                exit;
            } else {
                header('Location: ../View/documentList.php?update_error=true');
                exit;
            }
        }
    }
    // DocumentController.php

    public function searchDocuments() {
        $pdo = config::getConnexion();
        $query = "SELECT * FROM document WHERE 1=1";
        $params = [];

        // Apply filters if they are set
        if (!empty($_GET['titre'])) {
            $query .= " AND titre LIKE :titre";
            $params[':titre'] = '%' . $_GET['titre'] . '%';
        }
        if (!empty($_GET['auteur'])) {
            $query .= " AND auteur LIKE :auteur";
            $params[':auteur'] = '%' . $_GET['auteur'] . '%';
        }
        if (!empty($_GET['categorie'])) {
            $query .= " AND categorie LIKE :categorie";
            $params[':categorie'] = '%' . $_GET['categorie'] . '%';
        }
        if (!empty($_GET['date_publication'])) {
            $query .= " AND date_publication = :date_publication";
            $params[':date_publication'] = $_GET['date_publication'];
        }

        // Apply sorting
        if (!empty($_GET['sort_by'])) {
            $query .= " ORDER BY " . $_GET['sort_by'];
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $documents = $stmt->fetchAll();

        // Pass the results to the view
        require '../View/documentList.php';
    }
    public function getBorrowingStatistics() {
        $pdo = config::getConnexion();
    
        // Test simple query
        $testQuery = "SELECT * FROM document LIMIT 1";
        try {
            $stmt = $pdo->query($testQuery);
            $result = $stmt->fetchAll();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        } catch (PDOException $e) {
            echo 'Test Query Error: ' . $e->getMessage();
        }
    
        // Debugging original queries
        $mostBorrowedQuery = "
            SELECT document.titre, COUNT(emprunt.id_emprunt) AS borrow_count
            FROM emprunt
            JOIN document ON emprunt.id_document = document.id_document
            GROUP BY emprunt.id_document
            ORDER BY borrow_count DESC
            LIMIT 10
        ";
        try {
            $stmt = $pdo->query($mostBorrowedQuery);
            $mostBorrowed = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Query error (Most Borrowed): ' . $e->getMessage();
            $mostBorrowed = [];
        }
    
        $borrowsPerMonthQuery = "
            SELECT DATE_FORMAT(date_emprunt, '%Y-%m') AS month, COUNT(*) AS borrow_count
            FROM emprunt
            GROUP BY month
            ORDER BY month DESC
        ";
        try {
            $stmt = $pdo->query($borrowsPerMonthQuery);
            $borrowsPerMonth = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Query error (Borrowings Per Month): ' . $e->getMessage();
            $borrowsPerMonth = [];
        }
    
        echo "<pre>";
        print_r($mostBorrowed);
        print_r($borrowsPerMonth);
        echo "</pre>";
    
        // Pass the statistics to the view
        require '../View/statistics.php';
    }
    
    
    
    


    // Method to handle deleting a document
    public function deleteDocument() {
        if (isset($_GET['id_document'])) {
            $id_document = (int)$_GET['id_document'];
            $document = new Document($id_document, '', '', new DateTime(), '', '', $this->pdo);

            if ($document->deleteDocument($id_document)) {
                header('Location: ../View/documentList.php?delete_success=true');
                exit;
            } else {
                header('Location: ../View/documentList.php?delete_error=true');
                exit;
            }
        }
    }

    // Method to list all documents
    public function listDocuments() {
        $documents = Document::listDocuments($this->pdo);
        require '../View/documentList.php';
    }
}

// Instantiate the controller
$controller = new DocumentController();

// Determine the action to take based on the URL parameter 'action'
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'addDocument':
            $controller->addDocument();
            break;
        case 'editDocument':  // Handle editing
            $controller->editDocument();
            break;
        case 'updateDocument':
            $controller->updateDocument();
            break;
        case 'deleteDocument':
            $controller->deleteDocument();
            break;
        case 'listDocuments':
        default:
            $controller->listDocuments();
            break;
    }
} else {
    $controller->listDocuments(); // Default action
}
?>
