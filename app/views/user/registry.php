<?php

$server = Server::getInstance($data);
$this->importElement("header");
$this->importElement("nav-bar");
if ($server->checkPreviewWebSite()==="http://localhost/PTW/public/user/registry") $this->importElement("message");
$this->importElement("registry", "user");
$this->importElement("footer");
