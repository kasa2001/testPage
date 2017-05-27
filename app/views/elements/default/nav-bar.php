<nav>
    <?= $this->checkAddress()!="home/index" and $this->checkAddress() !="home" and $this->checkAddress() !=null? $this->buildLink("Return to index", "home/index"): ""?>
    <?= $this->checkAddress()!="home/error"? $this->buildLink("Error page", "home/error"):'' ?>
    <?= $this->checkAddress()!="user/registry"? $this->buildLink("Registry", "user/registry"):''?>
    <?= $this->checkAddress()!="user/login"? $this->buildLink("Login", "user/login"):'' ?>
    <?= $this->checkAddress()!="user/add"? $this->buildLink("Add new something", "user/add"):'' ?>
    <?= $this->checkAddress()!="user/delete"? $this->buildLink("Delete something", "user/delete"):'' ?>
    <?= $this->checkAddress()!="user/modify" ? $this->buildLink("Modify something", "user/modify"):'' ?>
    <?= $this->checkAddress()!="user/select"? $this->buildLink("Select something", "user/select"):'' ?>
</nav>