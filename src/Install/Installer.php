<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */

declare(strict_types=1);

namespace Productbargain\Install;

use Db;
use Module;
use PrestaShop\Module\Productbargain\Entity\Bargain;

/**
 * Class Installer
 */
class Installer
{
    /**
     * Module install process
     *
     * @return bool
     */
    public function install(Module $module): bool
    {

        $queries = [
            'CREATE TABLE IF NOT EXISTS `' . pSQL(_DB_PREFIX_) . 'bargains` (
                `id_bargain` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `user_id` varchar(64),
                `iterations` int(100) NOT NULL,
                `status` tinyint(1) unsigned NOT NULL DEFAULT 1,
                `final_price` int(100)  NOT NULL,
                `product_price` int(100)  NOT NULL,
                `product_id` int(10) NOT NULL,
                PRIMARY KEY (`id_bargain`)
            ) ENGINE=' . pSQL(_MYSQL_ENGINE_) . ' COLLATE=utf8_unicode_ci;',

            'CREATE TABLE IF NOT EXISTS `' . pSQL(_DB_PREFIX_) . 'bargain_iterations` (
                `id_iteration` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `bargain_id` varchar(64),
                `iteration_num` int(10) NOT NULL,
                `created_at` timestamp NOT NULL,
                `price` int(100)  NOT NULL,
                PRIMARY KEY (`id_iteration`)/*,
                CONSTRAINT fk_bargain
                FOREIGN KEY(`bargain_id`) 
	            REFERENCES `bargains`(`id_bargain`)*/
            ) ENGINE=' . pSQL(_MYSQL_ENGINE_) . ' COLLATE=utf8_unicode_ci;',


            'CREATE TABLE IF NOT EXISTS `' . pSQL(_DB_PREFIX_) . 'bargain_setting` (
                `id_setting` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `max_iterations` int(10) NOT NULL,
                `wait` int(10) NOT NULL,
                `chatdisplay` int(10) NOT NULL,
                `color` varchar(64),
                PRIMARY KEY (`id_setting`)
            ) ENGINE=' . pSQL(_MYSQL_ENGINE_) . ' COLLATE=utf8_unicode_ci;',

            'CREATE TABLE IF NOT EXISTS `' . pSQL(_DB_PREFIX_) . 'bargain_percentage` (
                `id_percentage` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `percentage` int(10) NOT NULL,
                PRIMARY KEY (`id_percentage`)
            ) ENGINE=' . pSQL(_MYSQL_ENGINE_) . ' COLLATE=utf8_unicode_ci;',

            'CREATE TABLE IF NOT EXISTS `' . pSQL(_DB_PREFIX_) . 'bargain_message` (
                `id_message` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `percentage_id` int(10) NOT NULL,
                `message` varchar(255),
                PRIMARY KEY (`id_message`)/*,
                CONSTRAINT fk_percentage
                FOREIGN KEY(`percentage_id`) 
	            REFERENCES `bargain_percentage`(`id_percentage`)*/
            ) ENGINE=' . pSQL(_MYSQL_ENGINE_) . ' COLLATE=utf8_unicode_ci;'

        ];

        return $this->executeQueries($queries) /*&& $this->registerHooks($module)*/;
    }

    /**
     * Module uninstall process
     *
     * @return bool
     */
    public function uninstall(): bool
    {
        $queries = [
            'DROP TABLE IF EXISTS `' . pSQL(_DB_PREFIX_) . 'bargains`',
            'DROP TABLE IF EXISTS `' . pSQL(_DB_PREFIX_) . 'bargain_iterations`',
            'DROP TABLE IF EXISTS `' . pSQL(_DB_PREFIX_) . 'bargain_setting`',
            'DROP TABLE IF EXISTS `' . pSQL(_DB_PREFIX_) . 'bargain_message`'
        ];

        return $this->executeQueries($queries);
    }

    /**
     * A helper that executes multiple database queries.
     *
     * @param array $queries
     *
     * @return bool
     */
    private function executeQueries(array $queries): bool
    {
        foreach ($queries as $query) {
            if (!Db::getInstance()->execute($query)) {
                return false;
            }
        }

        return true;
    }


}
