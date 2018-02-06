<nav>
    <?= ($this->checkAddress()!="home/index" and $this->checkAddress() !="home" and $this->checkAddress() !=null)? $this->buildLink("Return to index", "home/index"): ""?>
    <?= ($this->checkAddress()!="home/error")? $this->buildLink("Error page", "home/error"):'' ?>
    <?= ($this->checkAddress()!="user/registry" and \Lib\Built\Session\Session::getDataWithSession("id")===null)? $this->buildLink("Registry", "user/registry"):''?>
    <?= ($this->checkAddress()!="user/login" and \Lib\Built\Session\Session::getDataWithSession("id")===null)? $this->buildLink("Login", "user/login"):'' ?>
    <?= ($this->checkAddress()!="user/add" and \Lib\Built\Session\Session::getDataWithSession("id")!==null)? $this->buildLink("Add new something", "user/add"):'' ?>
    <?= ($this->checkAddress()!="user/delete" and \Lib\Built\Session\Session::getDataWithSession("id")!==null)? $this->buildLink("Delete something", "user/delete"):'' ?>
    <?= ($this->checkAddress()!="user/modify" and \Lib\Built\Session\Session::getDataWithSession("id")!==null)? $this->buildLink("Modify something", "user/modify"):'' ?>
    <?= ($this->checkAddress()!="user/select" and \Lib\Built\Session\Session::getDataWithSession("id")!==null)? $this->buildLink("Select something", "user/select"):'' ?>
    <?= ($this->checkAddress()!="home/collection") ? $this->buildLink("Collection", "home/collection"):'' ?>
</nav>