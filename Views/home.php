<?php
$this->layout('template', ['title' => 'TP Mihoyo - Collection']);
?>

<h1>Collection <?= $this->e($gameName) ?></h1>

<?php if (isset($message) && $message): ?>
    <div class="alert alert-info">
         <?= $this->e($message) ?>
    </div>
<?php endif; ?>

<div class="personnages-container">
    <?php if (empty($listPersonnage)): ?>
        <p class="no-data">Aucun personnage dans la collection.</p>
    <?php else: ?>
        <div class="personnages-grid">
            <?php foreach ($listPersonnage as $personnage): ?>
                <div class="personnage-card">
                    <div class="personnage-image">
                        <img src="<?= $this->e($personnage->getUrlImg()) ?>" 
                             alt="<?= $this->e($personnage->getName()) ?>">
                        
                        <div class="rarity-badge rarity-<?= $personnage->getRarity() ?>">
                            <?= str_repeat('★', $personnage->getRarity()) ?>
                        </div>
                    </div>
                    
                    <div class="personnage-info">
                        <h3 class="personnage-name"><?= $this->e($personnage->getName()) ?></h3>
                        
                        <div class="personnage-details">
                            <div class="detail-item">
                                <span class="label">Élément:</span>
                                <span class="value element-<?= strtolower($personnage->getElement()?->getName() ?? '') ?>">
                                    <?= $this->e($personnage->getElement()?->getName() ?? 'N/A') ?>
                                </span>
                            </div>
                            
                            <div class="detail-item">
                                <span class="label">Arme:</span>
                                <span class="value"><?= $this->e($personnage->getUnitclass()?->getName() ?? 'N/A') ?></span>
                            </div>
                            
                            <?php if ($personnage->getOrigin()): ?>
                                <div class="detail-item">
                                    <span class="label">Région:</span>
                                    <span class="value"><?= $this->e($personnage->getOrigin()->getName()) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="personnage-actions">
                            <a href="index.php?action=edit-perso&id=<?= $personnage->getId() ?>" class="btn btn-edit">
                                 Modifier
                            </a>
                            <a href="index.php?action=del-perso&id=<?= $personnage->getId() ?>" 
                               class="btn btn-delete"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce personnage ?')">
                                 Supprimer
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>