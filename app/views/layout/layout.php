<!doctype html>
<html <?= $this->loadLanguage() ?>>
<head>
    <?=
    $this->loadTitle();
    $this->loadCharset();
    $this->loadCss($css);
    ?>
</head>
<body>
<?=
$this->content($view, $data);
$this->loadJs($js);
?>
</body>
</html>