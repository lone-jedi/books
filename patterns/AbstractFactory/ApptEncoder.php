<?php

//
// ENCODERS
//

abstract class Encoder
{
    abstract public function encode() : string;
}

abstract class ApptEncoder extends Encoder
{  
}

abstract class ContactEncoder extends Encoder
{
}

abstract class TtdEncoder extends Encoder
{
}

class BloggsApptEncoder extends ApptEncoder
{
    public function encode() : string
    {
        return "Данные о встрече закодированы в формате BloggsCal" . PHP_EOL;
    }
}

class BloggsContactEncoder extends ContactEncoder
{
    public function encode() : string
    {
        return "Данные о встрече закодированы в формате BloggsContactCal" . PHP_EOL;
    }
}

class BloggsTtdEncoder extends TtdEncoder
{
    public function encode() : string
    {
        return "Данные о встрече закодированы в формате BloggsTtdCal" . PHP_EOL;
    }
}

//
// MANAGERS
//

abstract class CommsManager
{
    abstract public function getApptEncoder   () : ApptEncoder;
    abstract public function getContactEncoder() : ContactEncoder;
    abstract public function getTtdEncoder    () : TtdEncoder;
    abstract public function getHeaderText    () : string;
    abstract public function getFooterText    () : string;
}

class BloggsCommsManager extends CommsManager
{

    public function getApptEncoder() : ApptEncoder
    {
        return new BloggsApptEncoder();
    }

    public function getContactEncoder() : ContactEncoder
    {
        return new BloggsContactEncoder();
    }

    public function getTtdEncoder() : TtdEncoder
    {
        return new BloggsTtdEncoder();
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
