<?php

//Пользователи - Наблюдатели за сайтом
interface IObserver
{
    public function handle();
}

class HandHunterWebSiteObserver implements IObserver
{
    protected $name;
    protected $email;
    protected $experience;

    public function __construct($name, $email, $experience)
    {
        $this->name = $name;
        $this->email = $email;
        $this->experience = $experience;
    }
    public function handle()
    {
        echo 'Добавилась новая вакансия';
    }
}

//Интерфейс для наблюдаемых (наш сайт например)
interface IObservable
{
    public function addObserver(IObserver $observer);
    public function removeObserver(IObserver $observer);
    public function notify();
}
//Наблюдаемый сайт HandHunter.gb
class HandHunterWebSite implements IObservable
{
    private $vacancies;
    private $observers;

    public function __construct()
    {
        $this->vacancies = [];
        $this->observers = [];
    }
    public function addVacancy($vacancy)
    {
        return $this->vacancies[]=$vacancy;
    }
    public function addObserver(IObserver $observer)
    {
        $this->observers[] = $observer;
    }
    public function removeObserver(IObserver $observer)
    {
        foreach ($this->observers as &$obsrv) {
            if ($obsrv === $observer) {
                unset($obsrv);
            }
        }
    }
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->handle();
        }
    }
}

function testObserver()
{
    $observer = new HandHunterWebSiteObserver('Anatoliy', 'anatol@mail.ru', '5');
    $webSite = new HandHunterWebSite();

    $webSite->addObserver($observer);
    $vacancy = 'Новая вакансия программиста';
    $webSite->addVacancy($vacancy);

    $webSite->notify();
}

testObserver();




////подписчик, реагирующий на изменения News
//class Page
//{
//    private $html;
//    private $news;
//    public function __construct(News $news)
//    {
//        $this->news = $news;
//    }
//    public function setHtml(string $html)
//    {
//        $this->html = $html;
//    }
//    public function getHtml(): string
//    {
//        return $this->html;
//    }
//    public function getNews(): string
//    {
//        return $this->news;
//    }
//}
//
////Наблюдатель за News, который содержит код обновления Page при обновлении текста News
//interface IObserver
//{
//    public function handle(string $text);
//}
//
//class NewsObserver implements IObserver
//{
//    public function handle(string $text)
//    {
//        echo 'Обновляем объект Page';
//    }
//}
//
////Интерфейс для наблюдаемых
//interface IObservable
//{
//    public function addObserver(IObserver $observer);
//    public function removeObserver(IObserver $observer);
//    public function notify();
//}
////Наблюдаемый News
//class News implements IObservable
//{
//    private $text;
//    private $observers;
//    public function getText()
//    {
//        return $this->text;
//    }
//    public function setText(string $text)
//    {
//        $this->text = $text;
//    }
//    public function addObserver(IObserver $observer)
//    {
//        $this->observers[] = $observer;
//    }
//    public function removeObserver(IObserver $observer)
//    {
//        foreach ($this->observers as &$obsrv) {
//            if ($obsrv === $observer) {
//                unset($obsrv);
//            }
//        }
//    }
//    public function notify()
//    {
//        foreach ($this->observers as $observer) {
//            $observer->handle($this->text);
//        }
//    }
//}
//
//public function testObserver()
//{
//    $observer = new NewsObserver();
//    $news = new News();
//    $news->addObserver($observer);
//    $news->setText('Test test test');
//    $news->notify();
//}