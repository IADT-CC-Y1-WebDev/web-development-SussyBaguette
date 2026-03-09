<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

try {
    //$publishers = Publisher::findAll();
   $formats = Format::findAll();
}
catch (PDOException $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/index.php');
}
$publishers = [
    ['id' => 1, 'name' => 'Penguin Random House'],
    ['id' => 2, 'name' => 'HarperCollins'],
    ['id' => 3, 'name' => 'Simon & Schuster'],
    ['id' => 4, 'name' => 'Hachette Book Group'],
    ['id' => 5, 'name' => 'Macmillan Publishers'],
    ['id' => 6, 'name' => 'Scholastic Corporation'],
    ['id' => 7, 'name' => 'O\'Reilly Media']
];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'php/inc/head_content.php'; ?>
    <title>Create Book</title>
</head>
<body>
    <div class="container">
        <div class="width-12">
            <?php require 'php/inc/flash_message.php'; ?>
        </div>

        <div class="width-12">
            <h1>Create Book</h1>
        </div>

        <div class="width-12">
            <form action="book_store.php" method="POST" enctype="multipart/form-data">

                <div class="input">
                    <label class="special" for="title">Title:</label>
                    <div>
                        <input type="text" id="title" name="title" 
                               value="<?= old('title') ?>" required>
                        <p><?= error('title') ?></p>
                    </div>
                </div>
                
                <div class="input">
                    <label class="special" for="author">author:</label>
                    <div>
                        <input type="text" id="author" name="author" 
                               value="<?= old('author') ?>" required>
                        <p><?= error('author') ?></p>
                    </div>
                </div>

              

                <div class="form-group">
                <label for="publisher_id">Publisher:</label>
                <select id="publisher_id" name="publisher_id">
                    <option value="">-- Select Publisher --</option>
                    <?php foreach ($publishers as $pub): ?>
                    <option value="<?= $pub['id'] ?>" <?= chosen('publisher_id', $pub['id']) ? "selected" : ""?>>
                        <?= h($pub['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <?php if (error('publisher_id')): ?>
                <p class="error"><?= error('publisher_id') ?></p>
            <?php endif; ?>
        </div>
                <div class="input">
                    <label class="special" for="year">Release Year:</label>
                    <div>
                        <input type="number" id="year" name="year" 
                               value="<?= old('year') ?>" required>
                        <p><?= error('year') ?></p>
                    </div>
                </div>
                <div class="isbn">
                    <label class="special" for="isbn">isbn:</label>
                    <div>
                        <input type="number" id="isbn" name="isbn" 
                               value="<?= old('isbn') ?>" required>
                        <p><?= error('isbn') ?></p>
                    </div>
                </div>
                <div class="input">
                    <label class="special" for="description">Description:</label>
                    <div>
                        <textarea id="description" name="description" required><?= old('description') ?></textarea>
                        <p><?= error('description') ?></p>
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
                </div>

                <div class="input">
                    <label class="special" for="cover">Image (required):</label>
                    <div>
                        <input type="file" id="cover" name="cover" 
                               accept="image/*" required>
                        <p><?= error('cover') ?></p>
                    </div>
                </div>

                <div class="input">
                    <button class="button" type="submit">Store Book</button>
                    <div class="button"><a href="index.php">Cancel</a></div>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
<?php
clearFormData();
clearFormErrors();
?>