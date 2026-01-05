<?php
$this->layout('template', ['title' => 'Ajouter un élément']);
?>

<div class="form-container">
    <h1>Ajouter un élément</h1>

    <form action="index.php" method="POST" class="element-form">
        <input type="hidden" name="action" value="add-perso-element">

        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="text" id="image" name="image" required>
        </div>

        <div class="form-group">
            <label for="type">Type d'élément</label>
            <select id="type" name="type" required>
                <option value="">-- Choisir --</option>
                <option value="element">Element</option>
                <option value="unitclass">Unitclass</option>
                <option value="origin">Origin</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>