<?php

declare(strict_types = 1);

use Unirest\Response as Response;
use Unirest\Request as Request;

require_once __DIR__ . '/Unirest/Unirest.php';

/**
 * GoodDay
 * @author George Martinec <github.com/george-martinec>
 * @version 2.0.15
 *
 * @noinspection PhpUnused
 */
class GoodDay {

    /**
     * URL of GoodDay API
     *
     * @var string
     */
    public $API_URL = 'https://api.goodday.work/2.0';

    /**
     * API Token
     *
     * @var string
     */
    public $TOKEN;

    /**
     * Authentication header
     *
     * @var string[]
     */
    public $AUTH_HEADER;

    /**
     * Constructor
     *
     * @param string $token
     */
    function __construct(string $token) {
        $this->TOKEN = $token;
        $this->AUTH_HEADER = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'gd-api-token' => $this->TOKEN
        ];
    }

    // ┌──────────────────────────────────────────────────────────┐
    // │  1. Folders & Projects                                   │
    // └──────────────────────────────────────────────────────────┘

    /**
     * Query Projects
     *
     * Retrieve a list of projects
     *
     * @param bool $archived - set to true to retrieve archived/closed projects
     * @param bool $rootOnly - if set to true returns only root projects
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getProjects(
        bool $archived = false,
        bool $rootOnly = false
    ): Response {
        $body = [
            'archived' => $archived,
            'rootOnly' => $rootOnly
        ];
        return Request::get(
            "$this->API_URL/projects",
            $this->AUTH_HEADER,
            $body
        );
    }

    /**
     * Get Project
     *
     * Get project details by projectId
     *
     * @param string $projectId - (required)
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getProject(
        string $projectId
    ): Response {
        return Request::get(
            "$this->API_URL/project/$projectId",
            $this->AUTH_HEADER
        );
    }

    /**
     * Create Folder
     *
     * Create new folder
     *
     * @param string $createdByUserId - (required) - ID of a user, a new record is created on behalf of
     * @param string $name - (required) - Folder name
     * @param string|null $parentProjectId - Pass parent project ID to create a sub-folder
     * @param int|null $color - Folder color (1..24)
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function createFolder(
        string $createdByUserId,
        string $name,
        string $parentProjectId = null,
        int $color = null
    ): Response {
        $body = [
            'createdByUserId' => $createdByUserId,
            'name' => $name
        ];

        ($parentProjectId === null) ?: $body['parentProjectId'] = $parentProjectId;
        ($color === null) ?: $body['color'] = $color;

        return Request::post(
            "$this->API_URL/projects/new-folder",
            $this->AUTH_HEADER,
            json_encode($body)
        );
    }

    /**
     * Create Project
     *
     * Create new project
     *
     * @param string $createdByUserId - (required) - ID of a user, a new record is created on behalf of
     * @param string $projectTemplateId - (required) - Project template (type) ID you can find in Organization settings → Project templates
     * @param string $name - (required) - Project name
     * @param string|null $parentProjectId - Pass parent project ID to create a sub-project
     * @param int|null $color - Folder color (1..24)
     * @param string|null $projectOwnerUserId - Project owner user ID
     * @param string|null $startDate - ($endDate required) - (Y-m-d) - Project start date
     * @param string|null $endDate - ($startDate required) - (Y-m-d) - Project end date
     * @param string|null $deadline - (Y-m-d) - Project deadline
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function createProject(
        string $createdByUserId,
        string $projectTemplateId,
        string $name,
        string $parentProjectId = null,
        int $color = null,
        string $projectOwnerUserId = null,
        string $startDate = null,
        string $endDate = null,
        string $deadline = null
    ): Response {
        $body = [
            'createdByUserId' => $createdByUserId,
            'projectTemplateId' => $projectTemplateId,
            'name' => $name
        ];

        ($parentProjectId === null) ?: $body['parentProjectId'] = $parentProjectId;
        ($color === null) ?: $body['color'] = $color;
        ($projectOwnerUserId === null) ?: $body['projectOwnerUserId'] = $projectOwnerUserId;
        ($startDate === null) ?: $body['startDate'] = $startDate;
        ($endDate === null) ?: $body['endDate'] = $endDate;
        ($deadline === null) ?: $body['deadline'] = $deadline;

        return Request::post(
            "$this->API_URL/projects/new-project",
            $this->AUTH_HEADER,
            json_encode($body)
        );
    }

    /**
     * Query project users
     *
     * Retrieve a list of project users by projectId
     *
     * @param string $projectId - (required)
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getProjectUsers(
        string $projectId
    ): Response {
        return Request::get(
            "$this->API_URL/project/$projectId/users",
            $this->AUTH_HEADER
        );
    }

    // ┌──────────────────────────────────────────────────────────┐
    // │  2. Tasks                                                │
    // └──────────────────────────────────────────────────────────┘

    /**
     * Query project tasks
     *
     * Retrieve a list of project tasks by projectId
     *
     * @param string $projectId - (required)
     * @param bool $closed - set to true to retrieve all open and closed tasks
     * @param bool $subfolders - if set to true returns tasks from project its subfolders
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getTasks(
        string $projectId,
        bool $closed = false,
        bool $subfolders = false
    ): Response {
        $body = [
            'closed' => $closed,
            'subfolders' => $subfolders
        ];
        return Request::get(
            "$this->API_URL/project/$projectId/tasks",
            $this->AUTH_HEADER,
            $body
        );
    }

    /**
     * Query user action required tasks
     *
     * Retrieve a list of action required tasks by userId
     *
     * @param string $userId - (required)
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getActionRequiredTasks(
        string $userId
    ): Response {
        return Request::get(
            "$this->API_URL/user/$userId/action-required-tasks",
            $this->AUTH_HEADER
        );
    }

    /**
     * Query user assigned tasks
     *
     * Retrieve a list of tasks assigned to user by userId
     *
     * @param string $userId - (required)
     * @param bool $closed - set to true to retrieve all open and closed tasks
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getAssignedTasks(
        string $userId,
        bool $closed = false
    ): Response {
        $body = [
            'closed' => $closed
        ];
        return Request::get(
            "$this->API_URL/user/$userId/assigned-tasks",
            $this->AUTH_HEADER,
            $body
        );
    }

    /**
     * Get task
     *
     * Retrieve task details by taskId
     *
     * @param string $taskId - (required)
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getTask(
        string $taskId
    ): Response {
        return Request::get(
            "$this->API_URL/task/$taskId",
            $this->AUTH_HEADER
        );
    }

    /**
     * Create task
     *
     * Create new task
     *
     * @param string $projectId - (required) - Task project ID
     * @param string $title - (required) - Task title
     * @param string $fromUserId - (required) - Task created by user ID
     * @param string|null $parentTaskId - Pass parent task ID to create a subtask
     * @param string|null $message - Task description / initial message
     * @param string|null $toUserId - Assigned To/Action required user ID
     * @param string|null $taskTypeId - Task type ID
     * @param string|null $startDate - ($endDate required) - (Y-m-d) - Task start date
     * @param string|null $endDate - ($startDate required) - (Y-m-d) - Task end date
     * @param string|null $deadline - (Y-m-d) - Task deadline (due date)
     * @param int|null $estimate - Task estimate in minutes
     * @param int|null $priority - Task priority (1-10), 50 - Blocker, 100 - Emergency
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function createTask(
        string $projectId,
        string $title,
        string $fromUserId,
        string $parentTaskId = null,
        string $message = null,
        string $toUserId = null,
        string $taskTypeId = null,
        string $startDate = null,
        string $endDate = null,
        string $deadline = null,
        int $estimate = null,
        int $priority = null
    ): Response {
        $body = [
            'projectId' => $projectId,
            'title' => $title,
            'fromUserId' => $fromUserId,
            'parentTaskId' => $parentTaskId,
            'message' => $message,
            'toUserId' => $toUserId,
            'taskTypeId' => $taskTypeId,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'deadline' => $deadline,
            'estimate' => $estimate
        ];

        ($priority === null) ?: $body['priority'] = $priority;

        return Request::post(
            "$this->API_URL/tasks",
            $this->AUTH_HEADER,
            json_encode($body)
        );
    }

    /**
     * Query task messages
     *
     * Retrieve a list of task messages by taskId
     *
     * @param string $taskId - (required)
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getTaskMessages(
        string $taskId
    ): Response {
        return Request::get(
            "$this->API_URL/task/$taskId/messages",
            $this->AUTH_HEADER
        );
    }

    /**
     * Comment
     *
     * Create task comment by taskId
     *
     * @param string $taskId - (required)
     * @param string $userId - (required) - User on behalf of whom API will execute update
     * @param string|null $comment - Comment
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function createComment(
        string $taskId,
        string $userId,
        string $comment = null
    ): Response {
        $body = [
            'userId' => $userId,
            'message' => $comment
        ];
        return Request::post(
            "$this->API_URL/task/$taskId/comment",
            $this->AUTH_HEADER,
            json_encode($body)
        );
    }

    /**
     * Reply / Change AR user
     *
     * Reply or change AR user by taskId
     *
     * @param string $taskId - (required)
     * @param string $userId - (required) - User on behalf of whom API will execute update
     * @param string $actionRequiredUserId - (required) - Action required user
     * @param string|null $comment - Comment
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function replyOrChangeActionRequiredUser(
        string $taskId,
        string $userId,
        string $actionRequiredUserId,
        string $comment = null
    ): Response {
        $body = [
            'userId' => $userId,
            'actionRequiredUsedId' => $actionRequiredUserId,
            'message' => $comment
        ];
        return Request::post(
            "$this->API_URL/task/$taskId/reply",
            $this->AUTH_HEADER,
            json_encode($body)
        );
    }

    /**
     * Update status
     *
     * Update task status by taskId
     *
     * @param string $taskId - (required)
     * @param string $userId - (required) - User on behalf of whom API will execute update
     * @param string $statusId - (required) - New status ID
     * @param string|null $comment - Comment
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function updateTaskStatus(
        string $taskId,
        string $userId,
        string $statusId,
        string $comment = null
    ): Response {
        $body = [
            'userId' => $userId,
            'statusId' => $statusId,
            'message' => $comment
        ];
        return Request::put(
            "$this->API_URL/task/$taskId/reply",
            $this->AUTH_HEADER,
            json_encode($body)
        );
    }

    /**
     * Update task
     *
     * Update task by taskId
     *
     * @param string $taskId - (required)
     * @param string $userId - (required) - User on behalf of whom API will execute update
     * @param string|null $startDate - (Y-m-d) - Task start date, 'null' to reset
     * @param string|null $endDate - (Y-m-d) - Task end date, 'null' to reset
     * @param string|null $deadline - (Y-m-d) - Task deadline (due date), 'null' to reset
     * @param int|null $priority - Task priority (1-10), 50 - Blocker, 100 - Emergency
     * @param int|null $estimate - Task estimate in minutes, 'null' to reset
     * @param int|null $progress - Task progress percentage (0-100) or 'null' to reset
     * @param string|null $title - Task title
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function updateTask(
        string $taskId,
        string $userId,
        string $startDate = null,
        string $endDate = null,
        string $deadline = null,
        int $priority = null,
        int $estimate = null,
        int $progress = null,
        string $title = null
    ): Response {
        $body = [
            'userId' => $userId
        ];

        ($startDate === null) ?: $body['startDate'] = $startDate;
        ($endDate === null) ?: $body['endDate'] = $endDate;
        ($deadline === null) ?: $body['deadline'] = $deadline;
        ($priority === null) ?: $body['priority'] = $priority;
        ($estimate === null) ?: $body['estimate'] = $estimate;
        ($progress === null) ?: $body['progress'] = $progress;
        ($title === null) ?: $body['title'] = $title;

        if ($startDate === 'reset') $body['startDate'] = null;
        if ($endDate === 'reset') $body['endDate'] = null;
        if ($deadline === 'reset') $body['deadline'] = null;
        if ($estimate === 'reset') $body['estimate'] = null;
        if ($progress === 'reset') $body['progress'] = null;

        return Request::put(
            "$this->API_URL/task/$taskId/update",
            $this->AUTH_HEADER,
            json_encode($body)
        );
    }

    /**
     * Delete Task
     *
     * Delete task by taskId
     *
     * By deleting a task you also delete all task's related data including time reports, subtasks, etc.
     * It is recommended to cancel tasks (by updating status) instead of deleting.
     *
     * @param string $taskId - (required)
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function deleteTask(
        string $taskId
    ): Response {
        return Request::delete(
            "$this->API_URL/task/$taskId",
            $this->AUTH_HEADER
        );
    }

    // ┌──────────────────────────────────────────────────────────┐
    // │  3. Events                                               │
    // └──────────────────────────────────────────────────────────┘

    /**
     * Query events
     *
     * Retrieve list of events
     *
     * @url https://www.goodday.work/developers/api-v2/events
     *
     * @param string $startDate - (required) - Events start date
     * @param string $endDate - (required) - Events end date
     * @param string|null $eventTypes - (eventType1,eventType2) - List of event types separated by comma, no spaces
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getEvents(
        string $startDate,
        string $endDate,
        string $eventTypes = null
    ): Response {
        $body = [
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        ($eventTypes === null) ?: $body['eventTypes'] = $eventTypes;

        return Request::get(
            "$this->API_URL/events",
            $this->AUTH_HEADER,
            $body
        );
    }

    /**
     * Get Event
     *
     * Retrieve event details by eventId
     *
     * @param string $eventId - (required)
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getEvent(
        string $eventId
    ): Response {
        return Request::get(
            "$this->API_URL/event/$eventId",
            $this->AUTH_HEADER
        );
    }

    /**
     * Create event
     *
     * Create new event
     *
     * @param string $createdByUserId - (required) - ID of a user, a new event is created on behalf of
     * @param string $eventType - (required) - Event type
     * @param string $name - (required) - Event name
     * @param string $startDate - Event start date
     * @param string|null $endDate - (depends on event types) - Event end date. Not required for single-day events i.e. project-milestone
     * @param string|null $userId - (required for personal events) - Personal event user ID
     * @param string|null $projectId - (required for project events) - Project/folder ID
     * @param string|null $notes - Event notes
     * @param string|null $assignedToUserId - User ID an event is assigned to
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function createEvent(
        string $createdByUserId,
        string $eventType,
        string $name,
        string $startDate,
        string $endDate = null,
        string $userId = null,
        string $projectId = null,
        string $notes = null,
        string $assignedToUserId = null
    ): Response {
        $body = [
            'createdByUserId' => $createdByUserId,
            'eventType' => $eventType,
            'name' => $name,
            'startDate' => $startDate
        ];

        ($endDate === null) ?: $body['endDate'] = $endDate;
        ($userId === null) ?: $body['userId'] = $userId;
        ($projectId === null) ?: $body['projectId'] = $projectId;
        ($notes === null) ?: $body['notes'] = $notes;
        ($assignedToUserId === null) ?: $body['assignedToUserId'] = $assignedToUserId;

        return Request::post(
            "$this->API_URL/events",
            $this->AUTH_HEADER,
            json_encode($body)
        );
    }

    /**
     * Delete Event
     *
     * Delete an Event by eventId
     *
     * @param string $eventId - (required)
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function deleteEvent(
        string $eventId
    ): Response {
        return Request::delete(
            "$this->API_URL/event/$eventId",
            $this->AUTH_HEADER
        );
    }

    // ┌──────────────────────────────────────────────────────────┐
    // │  4. Users                                                │
    // └──────────────────────────────────────────────────────────┘

    /**
     * Query organization users
     *
     * Retrieve a list of users
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getUsers(): Response
    {
        return Request::get(
            "$this->API_URL/users",
            $this->AUTH_HEADER
        );
    }

    /**
     * Get organization user
     *
     * Retrieve user details by userId
     *
     * @param string $userId - (required)
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getUser(
        string $userId
    ): Response {
        return Request::get(
            "$this->API_URL/user/$userId",
            $this->AUTH_HEADER
        );
    }

    // ┌──────────────────────────────────────────────────────────┐
    // │  5. Time Reports                                         │
    // └──────────────────────────────────────────────────────────┘

    /**
     * New Time Report
     *
     * Create time report by taskId
     *
     * @param string $taskId - (required)
     * @param string $userId - (required) - User on behalf of whom API will execute update
     * @param int $reportedMinutes - (required) - Reported time in minutes
     * @param string|null $date - (Y-m-d) - Date you want to report time for, current date will be set if not passed
     * @param string|null $comment - Comment
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function createTimeReport(
        string $taskId,
        string $userId,
        int $reportedMinutes,
        string $date = null,
        string $comment = null
    ): Response {
        $body = [
            'userId' => $userId,
            'date' => $date,
            'reportedMinutes' => $reportedMinutes,
            'message' => $comment
        ];
        return Request::post(
            "$this->API_URL/task/$taskId/time-report",
            $this->AUTH_HEADER,
            json_encode($body)
        );
    }

    /**
     * Query time reports by user
     *
     * List of time reports for a specific user by userId
     *
     * @param string $userId - (required)
     * @param string|null $startDate - ($endDate required) - (Y-m-d) - Start date filter
     * @param string|null $endDate - ($startDate required) - (Y-m-d) - End date filter
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getUserTimeReport(
        string $userId,
        string $startDate = null,
        string $endDate = null
    ): Response {
        $body = [
            'startDate' => $startDate,
            'endDate' => $endDate
        ];
        return Request::get(
            "$this->API_URL/user/$userId/time-reports",
            $this->AUTH_HEADER,
            $body
        );
    }

    /**
     * Query time reports by task
     *
     * List of time reports for a specific task by taskId
     *
     * @param string $taskId - (required)
     * @param bool $subtasks - set to true to include time reports for all subtasks
     * @param string|null $startDate - ($endDate required) - (Y-m-d) - Start date filter
     * @param string|null $endDate - ($startDate required) - (Y-m-d) - End date filter
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getTaskTimeReport(
        string $taskId,
        bool $subtasks = false,
        string $startDate = null,
        string $endDate = null
    ): Response {
        $body = [
            'subtasks' => $subtasks,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];
        return Request::get(
            "$this->API_URL/task/$taskId/time-reports",
            $this->AUTH_HEADER,
            $body
        );
    }

    /**
     * Query time reports by project
     *
     * List of time reports for a specific project by projectId
     *
     * @param string $projectId - (required)
     * @param bool $subtasks - set to true to include time reports for all subprojects
     * @param string|null $startDate - ($endDate required) - (Y-m-d) - Start date filter
     * @param string|null $endDate - ($startDate required) - (Y-m-d) - End date filter
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getProjectTimeReport(
        string $projectId,
        bool $subtasks = false,
        string $startDate = null,
        string $endDate = null
    ): Response {
        $body = [
            'subtasks' => $subtasks,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];
        return Request::get(
            "$this->API_URL/project/$projectId/time-reports",
            $this->AUTH_HEADER,
            $body
        );
    }

    /**
     * Query all time reports
     *
     * List of all time reports for a specified period of time
     *
     * @param string $startDate - (required) - (Y-m-d) - Start date filter
     * @param string $endDate - (required) - (Y-m-d) - End date filter
     * @param array $projectIds - Projects filter
     * @param array $userIds - Users filter
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getTimeReports(
        string $startDate,
        string $endDate,
        array $projectIds = [],
        array $userIds = []
    ): Response {
        $body = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'projectIds' => $projectIds,
            'userIds' => $userIds
        ];
        return Request::post(
            "$this->API_URL/time-reports",
            $this->AUTH_HEADER,
            json_encode($body)
        );
    }

    // ┌──────────────────────────────────────────────────────────┐
    // │  6. Custom Fields                                        │
    // └──────────────────────────────────────────────────────────┘

    /**
     * Query Custom Fields
     *
     * Retrieve a list of all custom fields
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getCustomFields(): Response {
        return Request::get(
            "$this->API_URL/custom-fields",
            $this->AUTH_HEADER
        );
    }

    /**
     * Update Task
     *
     * Update task's custom fields values by taskId
     *
     * @url https://www.goodday.work/developers/api-v2/custom-fields
     *
     * @param string $taskId - (required)
     * @param string $customFields - (required) - (JSON) - Array of objects see sample request below
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function updateTaskCustomFields(
        string $taskId,
        string $customFields
    ): Response {
        return Request::put(
            "$this->API_URL/task/$taskId/custom-fields",
            $this->AUTH_HEADER,
            json_encode($customFields)
        );
    }

    // ┌──────────────────────────────────────────────────────────┐
    // │  7. System                                               │
    // └──────────────────────────────────────────────────────────┘

    /**
     * Query Statuses
     *
     * Retrieve a list of all statuses within the organization.
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getStatuses(): Response {
        return Request::get(
            "$this->API_URL/statuses",
            $this->AUTH_HEADER
        );
    }

    /**
     * Query Task Types
     *
     * Retrieve a list of available task types.
     *
     * @return Response
     * @noinspection PhpUnused
     */
    public function getTaskTypes(): Response {
        return Request::get(
            "$this->API_URL/task-types",
            $this->AUTH_HEADER
        );
    }

    // ┌──────────────────────────────────────────────────────────┐
    // │  8. Webhooks                                             │
    // └──────────────────────────────────────────────────────────┘
    /** @url https://www.goodday.work/developers/api-v2/webhooks */

}
