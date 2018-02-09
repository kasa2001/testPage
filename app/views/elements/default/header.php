<header>
    <?= \Lib\Built\Session\Session::getDataWithSession("id")===null ? $this->buildLink("Login", "user/login") : '';?>
    <?= \Lib\Built\Session\Session::getDataWithSession("id")===null ? $this->buildLink("Registry", "user/registry") : '';?>
    <?= \Lib\Built\Session\Session::getDataWithSession("id")!==null ? $this->buildLink("Logout", "action/logout") : '';?>
</header>