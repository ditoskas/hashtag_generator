<!DOCTYPE html>
<html>
<?= $this->element('header') ?>
<body>
<?php
echo $this->element('menu');
if ($this->request->action=='home'){
  echo '<div class="search-box"></div>';
}
?>
    <div class="container main-container" id="">
        <?= $this->fetch('content') ?>
    </div><!-- div.container -->
</body>
<?= $this->Sources->getJs('default') ?>
<script type="text/javascript">
    <?= $this->fetch('scriptDocument'); ?>
    $(document).ready(function(){
        <?= $this->fetch('scriptDocumentReady'); ?>
    });
</script>
</html>
