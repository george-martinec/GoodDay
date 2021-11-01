<?php

/**
 * PlayGround
 * @author George Martinec <github.com/george-martinec>
 */

declare(strict_types = 1);

use Unirest\Request as Request;

require_once __DIR__ . '/Helper.php';
require_once __DIR__ . '/GoodDay.php';

ini_set('display_errors', 'true');
ini_set('display_startup_errors', 'true');
error_reporting(E_ALL);

/**
 * Initialize Classes
 */
$Helper  = new Helper();
$GoodDay = new GoodDay('YOUR_API_TOKEN'); // https://www.goodday.work/developers/api-v2/connect

/**
 * PlayGround
 */
$currentDate = $Helper::currentDate();
$projects = $GoodDay->getProjects();
$Helper::d($projects, $Helper::toObject( Request::getInfo() ));

/** Users */
//$users = $GoodDay->getUsers();
//$Helper::d($users, $Helper::toObject( Request::getInfo() ));

/** Project Users */
//$projectUsers = $GoodDay->getProjectUsers('PROJECT_ID');
//$Helper::d($users, $Helper::toObject( Request::getInfo() ));

/** Project Tasks */
//$projectTasks = $GoodDay->getTasks('PROJECT_ID');
//$Helper::d($projectTasks, $Helper::toObject( Request::getInfo() ));

/** ... */
