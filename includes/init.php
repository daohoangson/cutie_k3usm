<?php

require('autoload.php');

App::getInstance()->setSession(new Session_Default());
App::getInstance()->setInput(new Input_Default());