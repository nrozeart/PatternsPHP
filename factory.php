<?php

class Application{
    protected $DBConnection; //соединение с базой
    protected $DBRecord; //запись таблицы базы данных
    protected $DBQueryBuilder; //конструктор запросов к базe

    public function __construct(ServiceFactoryInterface $serviceFactory)
    {
        $this->DBConnection=$serviceFactory->createConnection();
        $this->DBRecord=$serviceFactory->createDBRecord();
        $this->DBQueryBuilder=$serviceFactory->createDBQueryBuilder();
    }
}


interface MySQLFactoryInterface {}
interface PostgreSQLFactoryInterface {}
interface OracleFactoryInterface {}

class MySQLConnection implements MySQLFactoryInterface {}
class PostgreSQLConnection implements PostgreSQLFactoryInterface {}
class OracleConnection implements OracleFactoryInterface {}



interface ServiceFactoryInterface {
    public function createConnection();
    public function createDBRecord();
    public function createDBQueryBuilder();
}



class MySQLFactory implements ServiceFactoryInterface {
    public function createConnection(): MySQLFactoryInterface {
        return new MySQLConnection();
    }
    public function createDBRecord();
    public function createDBQueryBuilder();
}

class PostgreSQLFactory implements ServiceFactoryInterface {
    public function createConnection(): PostgreSQLFactoryInterface {
        return new PostgreSQLConnection();
    };
    public function createDBRecord();
    public function createDBQueryBuilder();
}

class OracleFactory implements ServiceFactoryInterface {
    public function createConnection(): OracleFactoryInterface {
        return new OracleConnection();
    };
    public function createDBRecord();
    public function createDBQueryBuilder();
}

//здесь можно выбрать другую фабрику
$application = new Application(
    new MySQLFactory()
);
