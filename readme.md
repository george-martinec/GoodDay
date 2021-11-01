<br><br>

<p align="center">
  <img style="width: 400px; height: 100px" src="https://www.goodday.work/site/assets/svg/logo/logo-navigation.svg" alt="GoodDay"><br>
  <br>
  <a target="_blank" href="https://www.goodday.work/developers/api-v2"><img src="https://img.shields.io/badge/Version-2.0.15-04BF50?style=for-the-badge" alt="GoodDay"></a>
  <a><img style="width: 6px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="></a>
  <a href="#"><img src="https://img.shields.io/badge/PHP-^7.0-6c8aa2?style=for-the-badge" alt="PHP"></a>
  <br><br>
</p>

<div align="center">🔑 Create and insert Token in <b>GoodDay</b> class.</div>
<div align="center">🧙‍♂️ You can Generate API Token in your Organization under <code>Settings > API</code></div>

<br>

---

<br>

### Initialize project:
```php
<?php

declare(strict_types = 1);

use Unirest\Request as Request;

require_once __DIR__ . '/Helper.php';
require_once __DIR__ . '/GoodDay.php';

$Helper  = new Helper();
$GoodDay = new GoodDay('YOUR_API_TOKEN');

// ...
```

<br>

### Could be usefull:
 - <a target="_blank" href="https://www.php.net/manual/en/datetime.format.php"><b>(Y-m-d)</b> - DateTime::format</a>

<br>

### Content:
1. <a href="#1-folder-and-projects">📂 Folders & Projects</a>
2. <a href="#2-tasks">📝 Tasks</a>
3. <a href="#3-events">📣 Events</a>
4. <a href="#4-users">🧔 Users</a>
5. <a href="#5-time-reports">⏲️ Time Reports</a>
6. <a href="#6-custom-fields">✏️ Custom Fields</a>
7. <a href="#7-system">💻 System</a>
8. <a href="#helper">🤖 Helper</a>

<br>

# <div id="1-folder-and-projects">1. 📂 Folders & Projects</a>

### `$GoodDay->getProjects(...)`
Retrieve a list of company projects:

| Params | Required | Default | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| archived | **no** | `false` | `bool` | _if set to **true** returns archived/closed projects_ |
| rootOnly | **no** | `false` | `bool` | _if set to **true** returns only root projects_ |

<br>

### `$GoodDay->getProject(...)`
Get project details by `projectId`:

| Params | Required | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- |
| projectId | **yes** | `string` | _projectId_ |

<br>

### `$GoodDay->createFolder(...)`
Create new folder:

| Params | Required | Default | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| createdByUserId | **yes** |  | `string` | _ID of a user, a new record is created on behalf of_ |
| name | **yes** |  | `string` | _Folder name_ |
| parentProjectId | **no** | `null` | `string` | _Pass parent project ID to create a sub-folder_ |
| color | **no** | `null` | `int` | _Folder color (1..24)_ |

<br>

### `$GoodDay->createProject(...)`
Create new project:

| Params | Required | Default | Type&nbsp;/&nbsp;Format&nbsp;&nbsp;&nbsp;&nbsp; | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| createdByUserId | **yes** |  | `string` | _ID of a user, a new record is created on behalf of_ |
| projectTemplateId | **yes** |  | `string` | _Project template (type) ID you can find in Organization settings → Project templates_ |
| name | **yes** |  | `string` | _Project name_ |
| parentProjectId | **no** | `null` | `string` | _Pass parent project ID to create a sub-project_ |
| color | **no** | `null` | `int` | _Folder color (1..24)_ |
| projectOwnerUserId | **no** | `null` | `string` | _Project owner user ID_ |
| startDate | **no** | `null` | `string` / `Y-m-d` | _**endDate required** - Project start date_ |
| endDate | **no** | `null` | `string` / `Y-m-d` | _**startDate required** - Project end date_ |
| deadline | **no** | `null` | `string` / `Y-m-d` | _Project deadline_ |

<br>

### `$GoodDay->getProjectUsers(...)`
Retrieve a list of project users by `projectId`:

| Params | Required | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- |
| projectId | **yes** | `string` | _projectId_ |

<br>

# <div id="2-tasks">2. 📝 Tasks</a>

### `$GoodDay->getTasks(...)`
Retrieve a list of project tasks by `projectId`:

| Params | Required | Default | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| projectId | **yes** |  | `string` | _projectId_ |
| projectTemplateId | **no** | `false` | `bool` | _if set to **true** returns all open and closed tasks_ |
| name | **no** | `false` | `bool` | _if set to **true** returns tasks from project its subfolders_ |

<br>

### `$GoodDay->getActionRequiredTasks(...)`
Retrieve a list of action required tasks by `userId`:

| Params | Required | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- |
| userId | **yes** | `string` | _userId_ |

<br>

### `$GoodDay->getAssignedTasks(...)`
Retrieve a list of tasks assigned to user by `userId`:

| Params | Required | Default | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| userId | **yes** |  | `string` | _userId_ |
| closed | **no** | `false` | `bool` | _if set to **true** returns all open and closed tasks_ |

<br>

### `$GoodDay->getTask(...)`
Retrieve task details by `taskId`:

| Params | Required | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- |
| taskId | **yes** | `string` | _taskId_ |

<br>

### `$GoodDay->createTask(...)`
Create new task:

| Params | Required | Default | Type&nbsp;/&nbsp;Format&nbsp;&nbsp;&nbsp;&nbsp; | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| projectId | **yes** |  | `string` | _Task project ID_ |
| title | **yes** | | `string` | _Task title_ |
| fromUserId | **yes** | | `string` | _Task created by user ID_ |
| parentTaskId | **no** | `null` | `string` | _Pass parent task ID to create a subtask_ |
| message | **no** | `null` | `string` | _Task description / initial message_ |
| toUserId | **no** | `null` | `string` | _Assigned To/Action required user ID_ |
| taskTypeId | **no** | `null` | `string` | _Task type ID_ |
| startDate | **no** | `null` | `string` / `Y-m-d` | _**endDate required** - Task start date_ |
| endDate | **no** | `null` | `string` / `Y-m-d` | _**startDate required** - Task end date_ |
| deadline | **no** | `null` | `string` / `Y-m-d` | _Task deadline (due date)_ |
| estimate | **no** | `null` | `int` | _Task estimate in minutes_ |
| priority | **no** | `null` | `int` | _Task priority (1-10), 50 - Blocker, 100 - Emergency_ |

<br>

### `$GoodDay->getTaskMessages(...)`
Retrieve a list of task messages by `taskId`:

| Params | Required | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- |
| taskId | **yes** | `string` | _taskId_ |

<br>

### `$GoodDay->createComment(...)`
Create task comment by `taskId`:

| Params | Required | Default | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| taskId | **yes** |  | `string` | _taskId_ |
| userId | **yes** |  | `string` | _User on behalf of whom API will execute update_ |
| comment | **no** | `null` | `string` | _Comment_ |

<br>

### `$GoodDay->replyOrChangeActionRequiredUser(...)`
Reply or change AR user by `taskId`:

| Params | Required | Default | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| taskId | **yes** |  | `string` | _taskId_ |
| userId | **yes** |  | `string` | _User on behalf of whom API will execute update_ |
| actionRequiredUserId | **yes** | | `string` | _Action required user_ |
| comment | **no** | `null` | `string` | _Comment_ |

<br>

### `$GoodDay->updateTaskStatus(...)`
Update task status by `taskId`:

| Params | Required | Default | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| taskId | **yes** |  | `string` | _taskId_ |
| userId | **yes** |  | `string` | _User on behalf of whom API will execute update_ |
| statusId | **yes** | | `string` | _New status ID_ |
| comment | **no** | `null` | `string` | _Comment_ |

<br>

### `$GoodDay->updateTask(...)`
Update task status by `taskId`:

| Params | Required | Default | Type&nbsp;/&nbsp;Format&nbsp;&nbsp;&nbsp;&nbsp; | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| taskId | **yes** |  | `string` | _taskId_ |
| userId | **yes** |  | `string` | _User on behalf of whom API will execute update_ |
| startDate | **no** | `null` | `string` / `Y-m-d` | _Task start date, `'reset'` to reset_ |
| endDate | **no** | `null` | `string` / `Y-m-d` | _Task end date, `'reset'` to reset_ |
| deadline | **no** | `null` | `string` / `Y-m-d` | _Task deadline (due date), `'reset'` to reset_ |
| priority | **no** | `null` | `int` | _Task priority (1-10), 50 - Blocker, 100 - Emergency_ |
| estimate | **no** | `null` | `string` / `Y-m-d` | _Task estimate in minutes, `'reset'` to reset_ |
| progress | **no** | `null` | `string` / `Y-m-d` | _Task progress percentage (0-100) or `'reset'` to reset_ |
| title | **no** | `null` | `string` | _Task title_ |

<br>

### `$GoodDay->deleteTask(...)`
Delete task by `taskId`:

> By deleting a task you also delete all task's related data including time reports, subtasks, etc. <br>
> It is recommended to cancel tasks (by updating status) instead of deleting.

| Params | Required | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- |
| taskId | **yes** | `string` | _taskId_ |

<br>

# <div id="3-events">3. 📣 Events</a>

### `$GoodDay->getEvents(...)`
Retrieve list of events:

> Event types: https://www.goodday.work/developers/api-v2/events

| Params | Required | Default | Type&nbsp;/&nbsp;Format&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| startDate | **yes** |  | `string` / `Y-m-d` | _Events start date_ |
| endDate | **yes** |  | `string` / `Y-m-d` | _Events end date_ |
| eventTypes | **no** | `null` | `string` / `'eventType1,eventType2'` | _List of event types separated by comma, no spaces_ |

<br>

### `$GoodDay->getEvent(...)`
Retrieve event details by `eventId`:

| Params | Required | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- |
| eventId | **yes** | `string` | _eventId_ |

<br>

### `$GoodDay->createEvent(...)`
Create new event:

| Params | Required | Default | Type&nbsp;/&nbsp;Format&nbsp;&nbsp;&nbsp;&nbsp; | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| createdByUserId | **yes** |  | `string` | _ID of a user, a new event is created on behalf of_ |
| eventType | **yes** |  | `string` | _Event type_ |
| name | **yes** | | `string` / `Y-m-d` | _Event name_ |
| startDate | **yes** | | `string` / `Y-m-d` | _Event start date_ |
| endDate | **depends on event types** | `null` | `string` / `Y-m-d` | _Event end date. Not required for single-day events i.e. project-milestone_ |
| userId | **required for personal events** | `null` | `string` | _Personal event user ID_ |
| projectId | **required for project events** | `null` | `string` | _Project/folder ID_ |
| notes | **no** | `null` | `string` | _Event notes_ |
| assignedToUserId | **no** | `null` | `string` | _User ID an event is assigned to_ |

<br>

### `$GoodDay->deleteEvent(...)`
Delete an Event by `eventId`:

| Params | Required | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- |
| eventId | **yes** | `string` | _eventId_ |

<br>

# <div id="4-users">4. 🧔 Users</a>

### `$GoodDay->getUsers()`
Retrieve a list of users:

<br>

### `$GoodDay->getUser(...)`
Retrieve user details by `userId`:

| Params | Required | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- |
| userId | **yes** | `string` | _userId_ |

<br>

# <div id="5-time-reports">5. ⏲️ Time Reports</a>

### `$GoodDay->createTimeReport(...)`
Create time report by `taskId`:

| Params | Required | Default | Type&nbsp;/&nbsp;Format&nbsp;&nbsp;&nbsp;&nbsp; | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| taskId | **yes** |  | `string` | _taskId_ |
| userId | **yes** |  | `string` | _User on behalf of whom API will execute update_ |
| reportedMinutes | **yes** | | `int` | _Reported time in minutes_ |
| date | **no** | `null` | `string` / `Y-m-d` | _Date you want to report time for, current date will be set if not passed_ |
| comment | **no** | `null` | `string` | _Comment_ |

<br>

### `$GoodDay->getUserTimeReport(...)`
List of time reports for a specific user by `userId`:

| Params | Required | Default | Type&nbsp;/&nbsp;Format&nbsp;&nbsp;&nbsp;&nbsp; | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| userId | **yes** |  | `string` | _userId_ |
| startDate | **no** |  | `string` / `Y-m-d` | _**endDate required** - Start date filter_ |
| endDate | **no** | | `string` / `Y-m-d` | _**startDate required** - End date filter_ |

<br>

### `$GoodDay->getTaskTimeReport(...)`
List of time reports for a specific task by `taskId`:

| Params | Required | Default | Type&nbsp;/&nbsp;Format&nbsp;&nbsp;&nbsp;&nbsp; | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| taskId | **yes** |  | `string` | _taskId_ |
| subtasks | **yes** |  | `bool` | _if set to **true** returns time reports for all subtasks_ |
| startDate | **no** | `null` | `string` / `Y-m-d` | _**endDate required** - Start date filter_ |
| endDate | **no** | `null` | `string` / `Y-m-d` | _**startDate required** - End date filter_ |

<br>

### `$GoodDay->getTaskTimeReport(...)`
List of time reports for a specific project by `projectId`:

| Params | Required | Default | Type&nbsp;/&nbsp;Format&nbsp;&nbsp;&nbsp;&nbsp; | Description |
| :--------------- | :--------------- | :--------------- | :--------------- | :--------------- |
| projectId | **yes** |  | `string` | _projectId_ |
| subtasks | **yes** |  | `bool` | _if set to **true** returns time reports for all subprojects_ |
| startDate | **no** | `null` | `string` / `Y-m-d` | _**endDate required** - Start date filter_ |
| endDate | **no** | `null` | `string` / `Y-m-d` | _**startDate required** - End date filter_ |

<br>

### `$GoodDay->getTimeReports(...)`
List of all time reports for a specified period of time:

| Params | Required | Type&nbsp;/&nbsp;Format&nbsp;&nbsp;&nbsp;&nbsp; | Description |
| :--------------- | :--------------- | :--------------- | :--------------- |
| startDate | **yes** | `string` / `Y-m-d` | _**endDate required** - Start date filter_ |
| endDate | **yes** | `string` / `Y-m-d` | _**startDate required** - End date filter_ |
| projectIds | **yes** | `array` | _Projects filter_ |
| userIds | **yes** | `array` | _Users filter_ |

<br>

# <div id="6-custom-fields">6. ✏️ Custom Fields</a>

### `$GoodDay->getCustomFields()`
Retrieve a list of all custom fields.

<br>

### `$GoodDay->updateTaskCustomFields(...)`
Update task's custom fields values by `taskId`:

> Custom Field Types: https://www.goodday.work/developers/api-v2/custom-fields

| Params | Required | Type / Format | Description |
| :--------------- | :--------------- | :--------------- | :--------------- |
| taskId | **yes** | `string` | _taskId_ |
| customFields | **yes** | `string` / `json` | Array of objects |

<br>

# <div id="7-system">7. 💻 System</a>

### `$GoodDay->getStatuses()`
Retrieve a list of all statuses within the organization.

<br>

### `$GoodDay->getTaskTypes()`
Retrieve a list of available task types.

<br>

# <div id="helper">🤖 Helper</a>

### Usage:

```php
// use Unirest\Request as Request;
$Helper = new Helper();
$GoodDay = new GoodDay('YOUR_API_TOKEN');

$Helper::d("My GoodDay Projects");

$projects = $GoodDay->getProjects();
$Helper::d($projects, $Helper::toObject( Request::getInfo()));

$Helper::dd("Dump&Die");
```

<br>

### **`$Helper::toObject(...)`**
_Convert array to object_
<br>
**Mostly used with `Request::getInfo()`**:
<br>
```php
// use Unirest\Request as Request;
$Helper  = new Helper();
$GoodDay = new GoodDay('YOUR_API_TOKEN');

$projects = $GoodDay->getProjects();
$Helper::d($projects, $Helper::toObject( Request::getInfo() ));
```

<br>

### **`$Helper::sumArrayColumn(...)`**
_Calculate the sum of the ArrayColumn_
<br>
**Mostly used with `timeReported`**:
```php
$Helper  = new Helper();
$GoodDay = new GoodDay('YOUR_API_TOKEN');

$taskTimeReport = $GoodDay->getTaskTimeReport('TASK_ID');
$totalTaskTimeReported = (int) $Helper::sumArrayColumn($taskTimeReport->body, 'timeReported');
$Helper::d($totalTaskTimeReported);
```

<br>

### **`$Helper::currentDate()`**
_Get current date in GoodDay format_
<br>
**Usage: `$Helper::currentDate()`**:
```php
$Helper  = new Helper();
$GoodDay = new GoodDay('YOUR_API_TOKEN');

$currentDate = $Helper::currentDate();
$currentEvents = $GoodDay->getEvents($currentDate, $currentDate);
$Helper::d($currentEvents);
```

<br>

### **`$Helper::getDate(...)`**
_Get date in GoodDay format_
<br>
**Usage: `$Helper::getDate('+3 days')`**:
> https://www.php.net/manual/en/function.strtotime.php
```php
$Helper  = new Helper();
$GoodDay = new GoodDay('YOUR_API_TOKEN');

$currentEvents = $GoodDay->getEvents($Helper::getDate('-3 days'), $Helper::getDate('+3 days'));
$Helper::d($currentEvents);
```

<br>

### **`$Helper::d(...)`**
_Dump_
<br>
**Usage:** `$Helper::d("My GoodDay API Project");`
<br>
**Shortcut for:**
<br>
```php
print("<pre>");
foreach (func_get_args() as $arg) {
    print_r($arg);
}
print("</pre>");
```

<br>

### **`$Helper::dd(...)`**
_Dump&Die_
<br>
**Usage:** `$Helper::dd("Dump&Die");`
<br>
**Shortcut for:**
<br>
```php
print("<pre>");
foreach (func_get_args() as $arg) {
    print_r($arg);
}
print("</pre>");
exit();
```

<br><br>

<p align="center">
  Made with ❤️ by <a href="https://github.com/George-Martinec"><b>George Martinec</b></a>
</p>

<br>
