<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Emprunt</title>
    <script src="../View/script.js" defer></script>
    <link rel="stylesheet" href="../View/style.css">
</head>
<body>
    <h1>Add a New Emprunt</h1>
    <form action="../Controller/EmpruntController.php?action=addEmprunt" method="POST">
       
        <div>
            <label for="id_emprunt">Title:</label>
            <input type="text" name="id_emprunt" id="id_emprunt" >
        </div>
        <div>
            <label for="id_document">Author:</label>
            <input type="text" name="id_document" id="id_document" >
        </div>
        <div>
            <label for="emprunteur">Publication Date:</label>
            <input type="date" name="emprunteur" id="emprunteur" >
        </div>
        <div>
            <label for="date_emprunt">Category:</label>
            <input type="text" name="date_emprunt" id="date_emprunt" >
        </div>
        <div>
            <label for="date_retour_peuve">date_retour_peuve:</label>
            <textarea name="date_retour_peuve" id="date_retour_peuve" ></textarea>
        </div>
        <div>
            <label for="statut">statut:</label>
            <textarea name="statut" id="statut" ></textarea>
        </div>
        <div>
            <button type="submit">Add Emprunt</button>
        </div>
    </form>
</body>
</html>
