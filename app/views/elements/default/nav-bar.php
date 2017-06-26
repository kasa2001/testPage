<nav>
    <?= $this->checkAddress()!="home/index" and $this->checkAddress() !="home" and $this->checkAddress() !=null? $this->buildLink("Return to index", "home/index"): ""?>
    <?= $this->checkAddress()!="home/error"? $this->buildLink("Error page", "home/error"):'' ?>
    <?= $this->checkAddress()!="user/registry" and Session::getDataWithSession("Id")===null? $this->buildLink("Registry", "user/registry"):''?>
    <?= $this->checkAddress()!="user/login" and Session::getDataWithSession("Id")===null? $this->buildLink("Login", "user/login"):'' ?>
    <?= $this->checkAddress()!="user/add" and Session::getDataWithSession("Id")!==null? $this->buildLink("Add new something", "user/add"):'' ?>
    <?= $this->checkAddress()!="user/delete" and Session::getDataWithSession("Id")!==null? $this->buildLink("Delete something", "user/delete"):'' ?>
    <?= $this->checkAddress()!="user/modify" and Session::getDataWithSession("Id")!==null? $this->buildLink("Modify something", "user/modify"):'' ?>
    <?= $this->checkAddress()!="user/select" and Session::getDataWithSession("Id")!==null? $this->buildLink("Select something", "user/select"):'' ?>
</nav>