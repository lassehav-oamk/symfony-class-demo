<html>
<head>
    <title><?php $view['slots']->output('title'); ?></title>
</head>
<body>

This is from layout template
<hr>

<?php $view['slots']->output('_content'); ?>

</body>
</html>