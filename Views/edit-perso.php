<?php
$this->layout('template', ['title' => 'Modifier un personnage']);
?>

<div class="form-container">
    <h1>Modifier un personnage</h1>

    <?php if (isset($message) && $message): ?>
        <div class="alert alert-error">
            <?= $this->e($message) ?>
        </div>
    <?php endif; ?>

    <form action="index.php?action=edit-perso" method="POST" class="perso-form">
        
        <input type="hidden" name="id" value="<?= $this->e($personnage->getId()) ?>">

        <div class="form-group">
            <label for="name">Nom du personnage</label>
            <input type="text" id="name" name="name" required 
                   value="<?= $this->e($personnage->getName()) ?>">
        </div>

        <div class="form-group">
            <label for="element">Élément</label>
            <select id="element" name="element" required>
                <option value="">-- Choisir un élément --</option>
                <?php foreach ($elements as $element): ?>
                    <option value="<?= $element['id'] ?>"
                        <?= ($personnage->getElement()?->getId() == $element['id']) ? 'selected' : '' ?>>
                        <?= $this->e($element['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="unitclass">Arme</label>
            <select id="unitclass" name="unitclass" required>
                <option value="">-- Choisir une arme --</option>
                <?php foreach ($unitclasses as $unitclass): ?>
                    <option value="<?= $unitclass['id'] ?>"
                        <?= ($personnage->getUnitclass()?->getId() == $unitclass['id']) ? 'selected' : '' ?>>
                        <?= $this->e($unitclass['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="origin">Région</label>
            <select id="origin" name="origin">
                <option value="">-- Choisir une région (optionnel) --</option>
                <?php foreach ($origins as $origin): ?>
                    <option value="<?= $origin['id'] ?>"
                        <?= ($personnage->getOrigin()?->getId() == $origin['id']) ? 'selected' : '' ?>>
                        <?= $this->e($origin['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="rarity">Rareté</label>
            <input type="number" id="rarity" name="rarity" min="3" max="5" required 
                   value="<?= $this->e($personnage->getRarity()) ?>">
        </div>

        <div class="form-group">
            <label for="urlImg">URL de l'image</label>
            <input type="text" id="urlImg" name="urlImg" required 
                   value="<?= $this->e($personnage->getUrlImg()) ?>">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>