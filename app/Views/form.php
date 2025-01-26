<?php
    include __DIR__ . '/partials/head.php';
?>

<div class="centered-form">
    <form action="/vehicule/store" method="POST" enctype="multipart/form-data" class="modern-form">
        <h1 class="form-title">Enregistrer un véhicule</h1>
        <div class="form-body">

            <div class="input-group">
                <label for="brand" class="input-label">Marque <span class="required">*</span></label>
                <div class="input-wrapper">
                    <input
                        type="text"
                        id="brand"
                        name="brand"
                        placeholder="Marque"
                        value="<?= htmlspecialchars($_POST['brand'] ?? '') ?>"
                        required
                        class="form-input"
                    />
                </div>
                <?php if (isset($errors['brand'])): ?>
                    <p class="error-message"><?= $errors['brand'][0] ?></p>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <label for="model" class="input-label">Modèle <span class="required">*</span></label>
                <div class="input-wrapper">
                    <input
                        type="text"
                        id="model"
                        name="model"
                        placeholder="Modèle"
                        value="<?= htmlspecialchars($_POST['model'] ?? '') ?>"
                        required
                        class="form-input"
                    />
                </div>
                <?php if (isset($errors['model'])): ?>
                    <p class="error-message"><?= $errors['model'][0] ?></p>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <label for="year" class="input-label">Année <span class="required">*</span></label>
                <div class="input-wrapper">
                    <input
                        type="number"
                        id="year"
                        name="year"
                        placeholder="Année"
                        value="<?= htmlspecialchars($_POST['year'] ?? '') ?>"
                        required
                        class="form-input"
                        min="2000"
                        max="<?= date('Y') ?>" 
                    />
                </div>
                <?php if (isset($errors['year'])): ?>
                    <p class="error-message"><?= $errors['year'][0] ?></p>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <label for="engine" class="input-label">Type de moteur <span class="required">*</span></label>
                <div class="input-wrapper">
                    <select id="engine" name="engine" class="form-input" required>
                        <option value="">Sélectionner le type de moteur</option>
                        <option value="diesel" <?= (isset($_POST['engine']) && $_POST['engine'] === 'diesel') ? 'selected' : '' ?>>Diesel</option>
                        <option value="unleaded" <?= (isset($_POST['engine']) && $_POST['engine'] === 'unleaded') ? 'selected' : '' ?>>Essence</option>
                        <option value="electric" <?= (isset($_POST['engine']) && $_POST['engine'] === 'electric') ? 'selected' : '' ?>>Électrique</option>
                    </select>
                </div>
                <?php if (isset($errors['engine'])): ?>
                    <p class="error-message"><?= $errors['engine'][0] ?></p>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <label for="file" class="input-label">Photo <span class="required">*</span></label>
                <label class="custum-file-upload" for="file">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24">
                            <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                            <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    fill=""
                                    d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                ></path>
                            </g>
                        </svg>
                    </div>
                    <div class="text">
                        <span>Cliquer pour téléverser</span>
                    </div>
                    <input type="file" id="file" name="photo" accept="image/*" required>
                </label>
                <div id="image-preview-container">
                    <img id="image-preview" alt="Aperçu de l'image">
                </div>
                <?php if (isset($errors['photo'])): ?>
                    <p class="error-message"><?= $errors['photo'][0] ?></p>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <div class="input-wrapper checkbox-wrapper">
                    <label>
                    <input
                        type="checkbox"
                        name="collection"
                        <?= isset($_POST['collection']) ? 'checked' : '' ?>
                        class="checkbox"
                    />
                        Véhicule de collection
                    </label>
                </div>
            </div>
        </div>

        <p class="required">* Champs obligatoires</p>
        <button type="submit" class="submit-button">
            <span class="button-text">Enregistrer →</span>
        </button>
    </form>
</div>

<?php
    include __DIR__ . '/partials/footer.php';
?>