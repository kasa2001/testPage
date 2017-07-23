<!doctype html>
<html <?= $this->loadLanguage() ?>>
<head>
    <?php
    if ($seo){
        $this->addBasePage();
    }

    $this->loadTitle();
    $this->loadCharset();
    //$this->addRobotsFollow($seo);

    if ($seo){
        $this->addDescription("Strona testowa frameworka");
        $this->addCanonicalLink();
        $this->addLanguageLink(array("pl"));
    }

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