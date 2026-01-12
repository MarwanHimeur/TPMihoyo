<?php
$this->layout('template', ['title' => 'Ajouter un élément']);
?>

<div class="form-container">
    <h1>Ajouter un élément</h1>

    <?php if (isset($message) && $message): ?>
        <div class="alert alert-error">
            <?= $this->e($message) ?>
        </div>
    <?php endif; ?>

    <form action="index.php?action=add-perso-element" method="POST" class="element-form">

        <div class="form-group">
            <label for="type">Type d'élément</label>
            <select id="type" name="type" required>
                <option value="">-- Choisir un type --</option>
                <option value="element">Élément (Pyro, Hydro, etc.)</option>
                <option value="unitclass">Arme (Sword, Bow, etc.)</option>
                <option value="origin">Région (Mondstadt, Liyue, etc.)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="urlImg">Image (URL)</label>
            <input type="text" id="urlImg" name="urlImg" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>