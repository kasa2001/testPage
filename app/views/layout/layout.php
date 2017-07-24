<!doctype html>
<html <?= $this->loadLanguage() ?>>
<head>
    <?php
    $seo = $this->getSEO();
    $seo->addBasePage();


    $this->loadTitle();
    $this->loadCharset();
    $seo->addRobotsFollow(true);
    $seo->addDescription("Strona testowa frameworka");
    $seo->addCanonicalLink();
    $seo->addLanguageLink(array("pl"));


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
