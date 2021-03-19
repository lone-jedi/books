<?php

abstract class ApptEncoder
{
    abstract public function encode() : string;
}

class BloggsApptEncoder extends ApptEncoder
{
    public function encode() : string
    {
        return "Данные о встрече закодированы в формате BloggsCal" . PHP_EOL;
    }
}

class MegaApptEncoder extends ApptEncoder
{
    public function encode() : string
    {
        return "Данные о встрече закодированы в формате MegaCal" . PHP_EOL;
    }
}

abstract class CommsManager
{
    abstract public function getApptEncoder() : ApptEncoder;
    abstract public function getHeaderText () : string;
    abstract public function getFooterText () : string;
}

class BloggsCommsManager extends CommsManager
{

    public function getApptEncoder() : ApptEncoder
    {
        return new BloggsApptEncoder();
    }

    public function getHeaderText(): string
    {
        return "BloggsCal верхний колонтитул";
    }

    public function getFooterText () : string
    {
        return "BloggsCal нижний колонтитул";
    }
}

class MegaCommsManager extends CommsManager
{

    public function getApptEncoder() : ApptEncoder
    {
        return new MegaApptEncoder();
    }

    public function getHeaderText(): string
    {
        return "MegaCal верхний колонтитул";
    }

    public function getFooterText () : string
    {
        return "MegaCal нижний колонтитул";
    }
}