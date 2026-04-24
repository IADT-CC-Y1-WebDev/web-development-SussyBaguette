<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'php/inc/head_content.php'; ?>
    <title>Create Publisher</title>
</head>
<body>
<section class="bookCreate">
    <div class="container">
        <div class="bookPart">
            <div class="width-12">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>

            <div class="width-12">
                <h1>Create Publisher</h1>
            </div>

            <div class="width-12">
                <form id="publisher_form" action="publisher_store.php" method="POST" novalidate>
                    <div id="error_summary_top" class="error-summary" style="display:none" role="alert"></div>

                    <div class="input">
                        <label class="special" for="name">Name:</label>
                        <div>
                            <input type="text" id="name" name="name"
                                   value="<?= old('name') ?>" required>
                            <p><?= error('name') ?></p>
                            <span id="name_error" class="error"></span>
                        </div>
                    </div>

                    <div class="input">
                        <button id="submit_btn" class="button" type="submit">Save Publisher</button>
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
