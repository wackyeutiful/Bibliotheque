<?php
require_once '../config.php';
class Emprunt {
    // Properties
    private int $id_emprunt;
    private int $id_document;
    private string $emprunteur; 
    private DateTime $date_emprunt;
    private DateTime $date_retour_prevue;
    private string $statut;

    // Constructor
    public function __construct(int $id_emprunt,int $id_document,string $emprunteur,DateTime $date_emprunt,DateTime $date_retour_prevue,string $statut) {
        $this->id_emprunt = $id_emprunt;
        $this->id_document = $id_document;
        $this->emprunteur = $emprunteur;
        $this->date_emprunt = $date_emprunt;
        $this->date_retour_prevue = $date_retour_prevue;
        $this->statut = $statut;
    }

    // Getters and Setters
    public function getIdEmprunt(): int {
        return $this->id_emprunt;
    }

    public function setIdEmprunt(int $id_emprunt): void {
        $this->id_emprunt = $id_emprunt;
    }

    public function getIdDocument(): int {
        return $this->id_document;
    }

    public function setIdDocument(int $id_document): void {
        $this->id_document = $id_document;
    }

    public function getEmprunteur(): string {
        return $this->emprunteur;
    }

    public function setEmprunteur(string $emprunteur): void {
        $this->emprunteur = $emprunteur;
    }

    public function getDateEmprunt(): DateTime {
        return $this->date_emprunt;
    }

    public function setDateEmprunt(DateTime $date_emprunt): void {
        $this->date_emprunt = $date_emprunt;
    }

    public function getDateRetourPrevue(): DateTime {
        return $this->date_retour_prevue;
    }

    public function setDateRetourPrevue(DateTime $date_retour_prevue): void {
        $this->date_retour_prevue = $date_retour_prevue;
    }

    public function getStatut(): string {
        return $this->statut;
    }

    public function setStatut(string $statut): void {
        $this->statut = $statut;
    }

    private PDO $pdo;

    public function __construct() {
        $this->pdo = config::getConnexion();
    }

    public function listEmprunts(): array {
        $sql = "SELECT * FROM emprunt";
        try {
            $query = $this->pdo->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function addEmprunt(int $id_emprunt, int $id_document, string $emprunteur, string $date_emprunt, string $date_retour_prevue, string $statut): bool {
        $sql = "INSERT INTO emprunt (id_emprunt, id_document, emprunteur, date_emprunt, date_retour_prevue, statut) VALUES (:id_emprunt, :id_document, :emprunteur, :date_emprunt, :date_retour_prevue, :statut)";
        try {
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id_emprunt', $id_emprunt);
            $query->bindParam(':id_document', $id_document);
            $query->bindParam(':emprunteur', $emprunteur);
            $query->bindParam(':date_emprunt', $date_emprunt);
            $query->bindParam(':date_retour_prevue', $date_retour_prevue);
            $query->bindParam(':statut', $statut);
            return $query->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function deleteEmprunt(int $id_emprunt): bool {
        $sql = "DELETE FROM emprunt WHERE id_emprunt = :id_emprunt";
        try {
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id_emprunt', $id_emprunt);
            return $query->execute();
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function searchEmprunt(int $id_emprunt): array {
        $sql = "SELECT * FROM emprunt WHERE id_emprunt = :id_emprunt";
        try {
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id_emprunt', $id_emprunt);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateEmprunt(int $id_emprunt, int $id_document, string $emprunteur, string $date_emprunt, string $date_retour_prevue, string $statut): bool {
        $sql = "UPDATE emprunt SET id_document = :id_document, emprunteur = :emprunteur, date_emprunt = :date_emprunt, date_retour_prevue = :date_retour_prevue, statut = :statut WHERE id_emprunt = :id_emprunt";
        try {
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id_emprunt', $id_emprunt);
            $query->bindParam(':id_document', $id_document);
            $query->bindParam(':emprunteur', $emprunteur);
            $query->bindParam(':date_emprunt', $date_emprunt);
            $query->bindParam(':date_retour_prevue', $date_retour_prevue);
            $query->bindParam(':statut', $statut);
            return $query->execute();
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}

?>
