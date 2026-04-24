<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }
    if (!array_key_exists('id', $_GET)) {
        throw new Exception('No publisher ID provided.');
    }

    $publisher = Publisher::findById($_GET['id']);
    if ($publisher === null) {
        throw new Exception('Publisher not found.');
    }
}
catch (Exception $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('publisher_index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'php/inc/head_content.php'; ?>
    <title>Edit Publisher</title>
</head>
<body>
<section class="bookCreate">
    <div class="container">
        <div class="bookPart">
            <div class="width-12">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>

            <div class="width-12">
                <h1>Edit Publisher</h1>
            </div>

            <div class="width-12">
                <form id="publisher_form" action="publisher_update.php" method="POST" novalidate>
                    <div id="error_summary_top" class="error-summary" style="display:none" role="alert"></div>

                    <input type="hidden" name="id" value="<?= h($publisher->id) ?>">

                    <div class="input">
                        <label class="special" for="name">Name:</label>
                        <div>
                            <input type="text" id="name" name="name"
                                   value="<?= old('name', $publisher->name) ?>" required>
                            <p><?= error('name') ?></p>
                            <span id="name_error" class="error"></span>
                        </div>
                    </div>

                    <div class="input">
                        <button id="submit_btn" class="button" type="submit">Update Publisher</button>
                        <div class="button"><a href="publisher_index.php">Cancel</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="Javascript/PublisherValidation.js"></script>
</body>
</html>
<?php
clearFormData();
clearFormErrors();
?>
