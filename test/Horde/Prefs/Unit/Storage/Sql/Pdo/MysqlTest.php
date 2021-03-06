<?php
/**
 * Prepare the test setup.
 */
namespace Horde\Prefs\Unit\Storage\Sql\Pdo;
use Horde\Prefs\Unit\Storage\Sql\Base as Base;
use \PDO;

require_once __DIR__ . '/../Base.php';

/**
 * Copyright 2011-2017 Horde LLC (http://www.horde.org/)
 *
 * @author     Jan Schneider <jan@horde.org>
 * @category   Horde
 * @package    Prefs
 * @subpackage UnitTests
 * @license    http://www.horde.org/licenses/lgpl21 LGPL 2.1
 */
class MysqlTest extends Base
{
    public static function setUpBeforeClass(): void
    {
        if (!extension_loaded('pdo') ||
            !in_array('mysql', PDO::getAvailableDrivers())) {
            self::$reason = 'No mysql extension or no mysql PDO driver';
            return;
        }
        $config = self::getConfig('PREFS_SQL_PDO_MYSQL_TEST_CONFIG',
                                  __DIR__ . '/../../../..');
        if ($config && !empty($config['prefs']['sql']['pdo_mysql'])) {
            self::$db = new Horde_Db_Adapter_Pdo_Mysql($config['prefs']['sql']['pdo_mysql']);
            parent::setUpBeforeClass();
        } else {
            self::$reason = 'No pdo_mysql configuration';
        }
    }
}
