<?php
use PrestaShop\PrestaShop\Adapter\ServiceLocator;
use PrestaShop\PrestaShop\Adapter\CoreException;
/***
 * Class ProductCore
 */
class Product extends ProductCore
{
    /*
    * module: productbargain
    * date: 2021-04-28 15:49:55
    * version: 1.0.1
    */

    public $minimumprice;
    public $startdate;
    public $enddate;
    public function __construct($id = null)
    {
        self::$definition['fields']['minimumprice'] = array('type' => self::TYPE_INT, 'validate' => 'isInt');
        self::$definition['fields']['startdate'] = array('type' => self::TYPE_DATE, 'validate' => 'isDATE');
        self::$definition['fields']['enddate'] = array('type' => self::TYPE_DATE, 'validate' => 'isDATE');
        parent::__construct($id);
    }
}