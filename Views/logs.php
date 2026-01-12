<?php
$this->layout('template', ['title' => 'Journal des logs']);
?>

<div class="logs-container">
    <h1> Journal des logs</h1>

    <div class="log-selector">
        <label for="log-month">Sélectionner un mois :</label>
        <select id="log-month" onchange="window.location.href='?action=logs&month='+this.value">
            <option value="">-- Choisir un mois --</option>
            <?php foreach ($availableMonths as $month): ?>
                <option value="<?= $month ?>" <?= ($selectedMonth === $month) ? 'selected' : '' ?>>
                    <?= $month ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <?php if (!empty($logs)): ?>
        <div class="logs-list">
            <?php foreach ($logs as $log): ?>
                <div class="log-entry">
                    <?= $this->e($log) ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="no-data">Aucun log disponible pour ce mois.</p>
    <?php endif; ?>
</div>