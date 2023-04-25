<?php
//Есть интернет-магазин по продаже носков
class Socks
{
    private $basket;
}

//Создаём три стратегии для оплаты — Qiwi, Яндекс, WebMoney
interface IPayMethod
{
    public function pay(int $total);
}
class QiwiPay implements IPayMethod
{
    public function pay(int $total)
    {
        echo 'Оплачено через Qiwi ' . $total . ' рублей';
    }
}
class YandexPay implements IPayMethod
{
    public function pay(int $total)
    {
        echo 'Оплачено через Yandex ' . $total . ' рублей';
    }
}
class WebMoneyPay implements IPayMethod
{
    public function pay(int $total)
    {
        echo 'Оплачено через WebMoney ' . $total . ' рублей';
    }
}

//Создаём объект PayMethodsCollection, в который внедряем стратегию оплаты
class PayMethodsCollection
{
    public function pay(IPayMethod $payMethod, int $total)
    {
        //'Некоторая бизнес-логика';
        return $payMethod->pay($total);
    }
}

function testStrategy(int $total)
{
    $collection = new PayMethodsCollection();
// оплата
    $collection->pay(new YandexPay(), $total);
}

testStrategy(30);







////Есть простой новостной сайт, который позволяет сортировать новости как по дате создания, так и по
////количеству комментариев к ней (выводя топ новостей)
//class News
//{
//    private $createdAt;
//    private $totalCommentsCount;
//    public function getCreatedAt(): DateTime
//    {
//        return $this->createdAt;
//    }
//    public function getTotalCommentsCount(): int
//    {
//        return $this->totalCommentsCount;
//    }
//}
//
////Создаём две стратегии для сравнения — по дате и по количеству комментариев, а также интерфейс
////для этих двух классов.
//interface IComparator
//{
//    public function compare(array $news);
//}
//class DateComparator implements IComparator
//{
//    public function compare(array $news)
//    {
//        echo 'Сравниваем по дате';
//    }
//}
//class CommentComparator implements IComparator
//{
//    public function compare(array $news)
//    {
//        echo 'Сравниваем по количеству комментариев';
//    }
//}
//
////Создаём объект NewsCollection, в который внедряем стратегию сравнения
//class NewsCollection
//{
//    public function sort(IComparator $comparator, array $news): array
//    {
//        echo 'Некоторая бизнес-логика';
//        return $comparator->compare($news);
//    }
//}
//
//public function testStrategy(array $news)
//{
//    $collection = new NewsCollection();
//// сортировка по дате
//    $elements = $collection->sort(new DateComparator(), $news);
//// сортировка по количеству комментариев
//    $elements = $collection->sort(new CommentComparator(), $news);
//}