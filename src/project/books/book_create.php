<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';
 
startSession();
 
try {
    // FIX: uncommented Publisher::findAll() and removed hardcoded array
    $publishers = Publisher::findAll();
    $formats = Format::findAll();
}
catch (PDOException $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'php/inc/head_content.php'; ?>
    <title>Create Book</title>

</head>
<body>
<section class="bookCreate">
    <div class="container">
        <div class="bookPart">
        <div class="width-12">
            <?php require 'php/inc/flash_message.php'; ?>
        </div>
 
        <div class="width-12">
            <h1>Create Book</h1>
        </div>
 
        <div class="width-12">
            <form id="book_form" action="book_store.php" method="POST" enctype="multipart/form-data" novalidate>
                <div id="error_summary_top" class="error-summary" style="display:none" role="alert"></div>
                <div class="input">
                    <label class="special" for="title">Title:</label>
                    <div>
                        <input type="text" id="title" name="title" 
                               value="<?= old('title') ?>" required>
                        <p><?= error('title') ?></p>
                        <span id="title_error" class="error"></span>
                    </div>
                </div>
                
                <div class="input">
                    <label class="special" for="author">Author:</label>
                    <div>
                        <input type="text" id="author" name="author" 
                               value="<?= old('author') ?>" required>
                        <p><?= error('author') ?></p>
                        <span id="author_error" class="error"></span>
                    </div>
                </div>
 
                <div class="form-group">
                    <label for="publisher_id">Publisher:</label>
                    <select id="publisher_id" name="publisher_id">
                        <option value="">-- Select Publisher --</option>
                        <?php foreach ($publishers as $pub): ?>
                          
                            <option value="<?= h($pub->id) ?>" <?= chosen('publisher_id', $pub->id) ? "selected" : "" ?>>
                                <?= h($pub->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    
                    <?php if (error('publisher_id')): ?>
                        <p class="error"><?= error('publisher_id') ?></p>
                    <?php endif; ?>
                    <span id="publisher_error" class="error"></span>
                </div>
 
                <div class="input">
                    <label class="special" for="year">Release Year:</label>
                    <div>
                        <input type="number" id="year" name="year" 
                               value="<?= old('year') ?>" required>
                        <p><?= error('year') ?></p>
                        <span id="year_error" class="error"></span>
                    </div>
                </div>
                <div class="input">
                    <label class="special" for="isbn">ISBN:</label>
                    <div>
                        <input type="number" id="isbn" name="isbn" 
                               value="<?= old('isbn') ?>" required>
                        <p><?= error('isbn') ?></p>
                        <span id="isbn_error" class="error"></span>
                    </div>
                </div>
                <div class="input">
                    <label class="special" for="description">Description:</label>
                    <div>
                        <textarea id="description" name="description" required><?= old('description') ?></textarea>
                        <p><?= error('description') ?></p>
                        <span id="description_error" class="error"></span>
                    </div>
                </div>
 
                <div class="input">
                    <label class="special">Formats:</label>
                    <div>
                        <?php foreach ($formats as $format) { ?>
                            <div>
                                <input type="checkbox"
                                    id="format_<?= h($format->id) ?>"
                                    name="format_ids[]"
                                    value="<?= h($format->id) ?>"
                                    <?= chosen('format_ids', $format->id) ? "checked" : "" ?>
                                >
                                <label for="format_<?= h($format->id) ?>">
                                    <?= h($format->name) ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <p><?= error('format_ids') ?></p>
                    <span id="format_error" class="error"></span>
                </div>
 
                <div class="input">
                    <label class="special" for="cover">Image (required):</label>
                    <div>
                        <input type="file" id="cover" name="cover" 
                               accept="image/*" required>
                        <p><?= error('cover') ?></p>
                        <span id="cover_error" class="error"></span>
                    </div>
                </div>
 
                <div class="input">
                    <button id="submit_btn" class="button" type="submit">Store Book</button>
                    <div class="button"><a href="index.php">Cancel</a></div>
                </div>
 
            </form>
        </div>
    </div>
</section>
<script src="Javascript/FormValidation.js"></script>
</body>
</html>
<?php
clearFormData();
clearFormErrors();
?>