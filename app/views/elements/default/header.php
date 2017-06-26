<header>
    <?= Session::getDataWithSession("Id")===null ? $this->buildLink("Login","user/login") : '';?>
    <?= Session::getDataWithSession("Id")===null ? $this->buildLink("Registry","user/registry") : '';?>
    <?= Session::getDataWithSession("Id")!==null ? $this->buildLink("Logout" , "action/logout") : '';?>
</header>