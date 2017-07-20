<!doctype html>
<html <?= $this->loadLanguage() ?>>
<head>
    <?=
    $this->addBasePage();
    $this->loadTitle();
    $this->loadCharset();
    $this->addDescription("Strona testowa frameworka");
    $this->loadCss($css);
    $this->addCanonicalLink();
    $this->addLanguageLink(array("pl"));
    ?>
</head>
<body>
<?=
$this->content($view, $data);
$this->loadJs($js);
?>
</body>
</html>