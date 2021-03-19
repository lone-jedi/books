<?php

require_once 'ApptEncoder.php';

$mgr = new BloggsCommsManager();
print $mgr->getHeaderText() . '<br>';
print $mgr->getApptEncoder()->encode() . '<br>';
print $mgr->getFooterText() . '<br>';