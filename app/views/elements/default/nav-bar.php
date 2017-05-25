<nav>
    <?= $this->checkAddress()!="home/index"? $this->buildLink("Return to index", "home/index"): "" ?>
    <?= $this->checkAddress()!="home/error"? $this->buildLink("Error page", "home/error"):'' ?>
    <?= $this->checkAddress()!="user/registry"? $this->buildLink("Registry", "user/registry"):''?>
    <?= $this->checkAddress()!="user/login"? $this->buildLink("Login", "user/login"):'' ?>
</nav>
