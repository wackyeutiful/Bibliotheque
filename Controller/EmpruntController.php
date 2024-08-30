<?php
require_once '../Model/Emprunt.php';

class EmpruntController {
    private Emprunt $empruntModel;

    public function __construct() {
        $this->empruntModel = new Emprunt();
    }

    public function listEmprunts() {
        require '../View/empruntList.php';
    }

    public function addEmprunt() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_emprunt = $_POST['id_emprunt'];
            $id_document = $_POST['id_document'];
            $emprunteur = $_POST['emprunteur'];
            $date_emprunt = $_POST['date_emprunt'];
            $date_retour_prevue = $_POST['date_retour_prevue'];
            $statut = $_POST['statut'];

            $this->empruntModel->addEmprunt($id_emprunt, $id_document, $emprunteur, $date_emprunt, $date_retour_prevue, $statut);
            header('Location: ../Controller/EmpruntController.php?action=listEmprunts');
        }
    }

    public function deleteEmprunt() {
        if (isset($_GET['id_emprunt'])) {
            $id_emprunt = $_GET['id_emprunt'];
            $this->empruntModel->deleteEmprunt($id_emprunt);
            header('Location: ../Controller/EmpruntController.php?action=listEmprunts');
        }
    }

    public function updateEmprunt() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_emprunt = $_POST['id_emprunt'];
            $id_document = $_POST['id_document'];
            $emprunteur = $_POST['emprunteur'];
            $date_emprunt = $_POST['date_emprunt'];
            $date_retour_prevue = $_POST['date_retour_prevue'];
            $statut = $_POST['statut'];

            $this->empruntModel->updateEmprunt($id_emprunt, $id_document, $emprunteur, $date_emprunt, $date_retour_prevue, $statut);
            header('Location: ../Controller/EmpruntController.php?action=listEmprunts');
        }
    }
}
?>
