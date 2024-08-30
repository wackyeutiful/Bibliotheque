<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Emprunt</title>
    <script src="../View/script.js" defer ></script>
    <link rel="stylesheet" href="../View/style.css">
</head>
<body>
    <h1>Update Emprunt</h1>
    <form action="../Controller/DocumentController.php?action=updateEmprunt" method="POST">
        <input type="hidden" name="id_emprunt" value="<?= htmlspecialchars($document['id_emprunt'] ?? ''); ?>" />
        <div>
            <label for="id_document">id_document:</label>
            <input type="text" name="id_document" id="id_document" value="<?= htmlspecialchars($document['id_document'] ?? ''); ?>" >
        </div>
        <div>
            <label for="emprunteur">emprunteur:</label>
            <input type="text" name="emprunteur" id="emprunteur" value="<?= htmlspecialchars($document['emprunteur'] ?? ''); ?>" >
        </div>
        <div>
            <label for="date_emprunt">date_emprunt:</label>
            <input type="date" name="date_emprunt" id="date_emprunt" value="<?= htmlspecialchars($document['date_emprunt'] ?? ''); ?>" >
        </div>
        <div>
            <label for="date_retour_preuve">date_retour_preuve:</label>
            <input type="text" name="date_retour_preuve" id="date_retour_preuve" value="<?= htmlspecialchars($document['date_retour_preuve'] ?? ''); ?>" >
        </div>
        <div>
            <label for="statut">statut:</label>
            <textarea name="statut" id="statut" required><?= htmlspecialchars($document['statut'] ?? ''); ?></textarea>
        </div>
        <div>
            <button type="submit">Update Emprunt</button>
        </div>
    </form>
</body>
</html>
