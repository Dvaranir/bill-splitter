<?php
include_once 'views/global/Head.php';
Head()
?>

<div class="container splitter__container">
    <h1 class="splitter__heading">Bill Splitter</h1>
    <?php include_once 'components/Form.php'; ?>
    <?php include_once 'components/Table.php'; ?>
    <button id="splitterResetButton" class="splitter__button red splitter__button-reset">Reset</button>
</div>
<?php include_once 'views/global/Foot.php'; ?>