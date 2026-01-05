<?php
$this->layout('template', ['title' => 'Ajouter un personnage']);
?>

<div class="form-container">
    <h1>Ajouter un personnage</h1>

    <form action="index.php" method="POST" class="perso-form">
        <input type="hidden" name="action" value="add-perso">

        <div class="form-group">
            <label for="name">Nom du personnage</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="element">Élément</label>
            <input type="text" id="element" name="element" required>
        </div>

        <div class="form-group">
            <label for="unitclass">Arme</label>
            <input type="text" id="unitclass" name="unitclass" required>
        </div>

        <div class="form-group">
            <label for="origin">Région</label>
            <input type="text" id="origin" name="origin">
        </div>

        <div class="form-group">
            <label for="rarity">Rareté</label>
            <input type="number" id="rarity" name="rarity" min="3" max="5" required>
        </div>

        <div class="form-group">
            <label for="url_img">URL de l'image</label>
            <input type="text" id="url_img" name="url_img" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>