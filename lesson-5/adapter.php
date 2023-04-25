<?php

class SquareAreaLib
    {
        public function getSquareArea(int $diagonal)
        {
            $area = ($diagonal**2)/2;
            return $area;
        }
    }
class CircleAreaLib
    {
        public function getCircleArea(int $diagonal)
        {
            $area = (M_PI * $diagonal**2))/4;
            return $area;
        }
    }


interface ISquare
    {
        function squareArea(int $sideSquare);
    }
interface ICircle
    {
        function circleArea(int $circumference);
    }


class SquareAreaAdapter implements ISquare {
//        private $sideSquare;
//        public function __construct($value)
//        {
//            $this->sideSquare = $value;
//        }
        function squareArea(int $sideSquare) {
            $diagonal = $sideSquare*sqrt(2);
            $squareAreaLib = new SquareAreaLib();
            return $squareAreaLib->getSquareArea($diagonal);
        }
    }
class CircleAreaAdapter implements ICircle {
//        private $circumference;
//        public function __construct($value)
//        {
//            $this->circumference = $value;
//        }
        function circleArea(int $circumference) {
            $diagonal = $circumference*M_PI;
            $circleAreaLib = new SquareAreaLib();
            return $circleAreaLib->getSquareArea($diagonal);
        }
    }
public function testAdapter()
{
    $squareAreaAdapter = new SquareAreaAdapter();
    $squareAreaAdapter->squareArea(5);
    $circleAreaAdapter = new CircleAreaAdapter();
    $circleAreaAdapter->circleArea(5);
}



//Пример с лекции
//interface IPublisher
//{
//    public function publisher(string $content): void;
//}
//class TwitterAdapter implements IPublisher
//{
//    private $twitter;
//    public function __construct(Twitter $twitter)
//    {
//        $this->twitter = $twitter;
//    }
//    public function publisher(string $content): void
//    {
//        $this->twitter>sendTweet($content);
//    }
//}
//class FacebookAdapter implements IPublisher
//{
//    private $facebook;
//    public function __construct(Facebook $facebook)
//    {
//        $this->facebook = $facebook;
//    }
//    public function publisher(string $content): void
//    {
//        $this->facebook>publish($content, new DateTime());
//    }
//}
//
//public function testAdapter(string $newsContent)
//{
//    $facebookAdapter = new FacebookAdapter(new Facebook());
//    $facebookAdapter->publisher($newsContent);
//    $twitterAdapter = new TwitterAdapter(new Twitter());
//    $twitterAdapter->publisher($newsContent);
}