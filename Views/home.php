<?php
$this->layout('template', ['title' => 'TP Mihoyo - Collection']);
?>

<h1>Collection <?= $this->e($gameName) ?></h1>

<!-- ==================== SECTION DE TESTS VAR_DUMP ==================== -->
<!-- Décommente cette section pour tester que les données arrivent bien -->
<!--
<div style="background: #f0f0f0; padding: 20px; margin: 20px 0; border-radius: 5px;">
    <h2>Tests var_dump (à commenter après vérification)</h2>
    
    <h3>Liste de tous les personnages :</h3>
    <?php var_dump($listPersonnage); ?>
    
    <hr>
    
    <h3>Premier personnage (ID existant) :</h3>
    <?php var_dump($first); ?>
    
    <hr>
    
    <h3>Autre personnage (ID inexistant - doit être null) :</h3>
    <?php var_dump($other); ?>
</div>
-->

<!-- ==================== AFFICHAGE DES PERSONNAGES ==================== -->
<div class="personnages-container">
    <?php if (empty($listPersonnage)): ?>
        <p class="no-data">Aucun personnage dans la collection.</p>
    <?php else: ?>
        <div class="personnages-grid">
            <?php foreach ($listPersonnage as $personnage): ?>
                <div class="personnage-card">
                    <!-- Image du personnage -->
                    <div class="personnage-image">
                        <img src="<?= $this->e($personnage->getUrlImg()) ?>" 
                             alt="<?= $this->e($personnage->getName()) ?>"
                             onerror="this.src='public/img/placeholder.png'">
                        
                        <!-- Badge de rareté (nombre d'étoiles) -->
                        <div class="rarity-badge rarity-<?= $personnage->getRarity() ?>">
                            <?= str_repeat('★', $personnage->getRarity()) ?>
                        </div>
                    </div>
                    
                    <!-- Informations du personnage -->
                    <div class="personnage-info">
                        <h3 class="personnage-name"><?= $this->e($personnage->getName()) ?></h3>
                        
                        <div class="personnage-details">
                            <div class="detail-item">
                                <span class="label">Élément:</span>
                                <span class="value element-<?= strtolower($personnage->getElement()) ?>">
                                    <?= $this->e($personnage->getElement()) ?>
                                </span>
                            </div>
                            
                            <div class="detail-item">
                                <span class="label">Arme:</span>
                                <span class="value"><?= $this->e($personnage->getUnitclass()) ?></span>
                            </div>
                            
                            <?php if ($personnage->getOrigin()): ?>
                                <div class="detail-item">
                                    <span class="label">Région:</span>
                                    <span class="value"><?= $this->e($personnage->getOrigin()) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Boutons d'actions -->
                        <div class="personnage-actions">
                            <a href="?action=edit&id=<?= $personnage->getId() ?>" class="btn btn-edit">
                                ✏️ Modifier
                            </a>
                            <a href="?action=delete&id=<?= $personnage->getId() ?>" class="btn btn-delete">
                                🗑️ Supprimer
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>