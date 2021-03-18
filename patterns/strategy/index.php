<?php

require_once 'Lesson.php';
require_once 'Message.php';

// 
// Пример использования классов 
//

$lessons[] = new Seminar(4, new TimedCostStrategy());
$lessons[] = new Lecture(4, new FixedCostStrategy());

$mgr = new RegistrationMgr();
$mgr->register($lessons[0]);
$mgr->register($lessons[1]);