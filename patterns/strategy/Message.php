<?php

class RegistrationMgr
{
    public function register(Lesson $lesson)
    {
        // Сделать что-то с Lesson...

        // Отправить кому-то сообщение
        $notifier = Notifier::getNotifier();
        $notifier->inform("Новое занятие: стоимость - ({$lesson->cost()})");
    }
}

abstract class Notifier
{
    public static function getNotifier() : Notifier
    {
        // Получить конкретный дочерний класс Notifier
        // в соответсвии с конфигурацией или другой логикой
        if(rand(1, 2) === 1) {
            return new MailNotifier();
        } else {
            return new TextNotifier();
        }
    }

    abstract public function inform($message);
}

class MailNotifier extends Notifier
{
    public function inform($message)
    {
        print "Уведомление по электронной почте: {$message}<br>";
    }
}

class TextNotifier extends Notifier
{
    public function inform($message)
    {
        print "Текстовое уведомление: {$message}<br>";
    }
}
