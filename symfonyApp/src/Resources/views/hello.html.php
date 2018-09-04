<?php $view->extend('layout.html.php'); ?>
<?php $view['slots']->set('title', 'Hello view'); ?>

<h1>Hello World</h1>
<div>
    Hello <?php echo $name ?> from PHP template
</div>
<a href="<?php echo $view['router']->path('test'); ?>">Link to test</a>

