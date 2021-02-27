<?php
declare(strict_types = 1);

namespace popp\ch13\batch07;

use popp\ch12\batch06\AppException;
use popp\ch12\batch06\Conf;
use popp\ch12\batch10\TableCreator;
use popp\ch13\batch04\Venue;
use popp\ch13\batch04\Registry;

class Runner
{
    public static function run()
    {
        $idobj = new IdentityObject();
        $idobj->field("name")
            ->eq("The Good Show")
            ->field("start")
            ->gt(time())
            ->lt(time() + (24 * 60 * 60));

        print $idobj;
    }

    public static function run2()
    {
        try {
            $idobj = new EventIdentityObject();
            $idobj->field("banana")
                ->eq("The Good Show")
                ->field("start")
                ->gt(time())
                ->lt(time() + (24 * 60 * 60));

            print $idobj;
        } catch (\Exception $e) {
            print $e->getMessage();
        }
    }

    public static function run3()
    {
        $vuf = new VenueUpdateFactory();
        print_r($vuf->newUpdate(new Venue(334, "The Happy Hairband")));
    }

    // 调用选择工厂的代码
    public static function run4()
    {
        $vio = new VenueIdentityObject();
        $vio->field("name")->eq("The Happy Hairband");

        $vsf = new VenueSelectionFactory();
        print_r($vsf->newSelection($vio));
    }

    public static function run5()
    {
        self::setUp();

        $factory = PersistenceFactory::getFactory(Venue::class);

        // 可以在PersistenceFactory中添加一个getFinder()方法并修改这里的代码来隔离更高层次的类与这种复杂性。
        $finder = new DomainObjectAssembler($factory);

        $venue1 = new Venue(-1, "The Likey Lounge");
        $venue2 = new Venue(-1, "The Eyeball Inn");
        $venue3 = new Venue(-1, "The Eyeball Inn");
        $venue4 = new Venue(-1, "The Eyeball Inn");

        $finder->insert($venue1);
        $finder->insert($venue2);
        $finder->insert($venue3);
        $finder->insert($venue4);

        $idobj = $factory->getIdentityObject()
            ->field('name')
            ->eq('The Eyeball Inn');

        $collection = $finder->find($idobj);

        foreach ($collection as $venue) {
            print $venue->getName() . "\n";
        }
    }

    private function setUp()
    {
        $config = __DIR__ . "/../batch01/data/woo_options.ini";
        $options = parse_ini_file($config, true);
        Registry::reset();
        $reg = Registry::instance();
        $conf = new Conf($options['config']);
        $reg->setConf($conf);
        $reg = Registry::instance();
        $dsn = $reg->getDSN();

        if (is_null($dsn)) {
            throw new AppException("No DSN");
        }

        $pdo = new \PDO($dsn);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $autoincrement = "AUTOINCREMENT";

        $pdo->query("DROP TABLE IF EXISTS venue");
        $pdo->query("CREATE TABLE venue ( id INTEGER PRIMARY KEY
            $autoincrement, name TEXT )");
        $pdo->query("INSERT INTO venue ( name ) VALUES ('bob')");
        $pdo->query("DROP TABLE  IF EXISTS space");
        $pdo->query("CREATE TABLE space ( id INTEGER PRIMARY KEY
            $autoincrement, venue INTEGER, name TEXT )");
        $pdo->query("DROP TABLE IF EXISTS event");
        $pdo->query("CREATE TABLE event ( id INTEGER PRIMARY KEY
            $autoincrement, space INTEGER, start long, duration int, name text )");
    }
}
