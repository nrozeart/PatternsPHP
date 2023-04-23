<?php

interface Notifier
{
    public function send(): string;
}
class Email implements Notifier
{
    private $text;
    public function __construct(string $text)
    {
        $this->text = $text;
    }
    public function send(): string
    {
        return mail('', '', $this->text);
    }
}

abstract class Decorator implements Notifier
{
    protected $notification = null;
    public function __construct(Notifier $notification)
    {
        $this->notification = $notification;
    }
}
class SMS extends Decorator
{
    public function send(): string
    {
        return $this->notification->send();
    }
}

class ChromeNotification extends Decorator
{
    public function send(): string
    {
        return $this->notification->send();
    }
}

public function testDecorator(string $text)
{
    $notification =
        new ChromeNotification(
            new SMS(
                new Email($text)
            )
        );
    $notification->send();
}