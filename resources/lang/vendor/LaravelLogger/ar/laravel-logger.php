<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Language Lines - Global
    |--------------------------------------------------------------------------
    */
    'userTypes' => [
        'guest'      => 'ضيف',
        'registered' => 'تسجيل ',
        'crawler'    => 'Crawler',
    ],

    'verbTypes' => [
        'created'    => 'انشاء',
        'edited'     => 'تعديل',
        'deleted'    => 'حذف',
        'viewed'     => 'عرض',
        'crawled'    => 'crawled',
    ],

    'listenerTypes' => [
        'auth'       => 'نشاط مصدق ',
        'attempt'    => 'محاولة تسجيل ',
        'failed'     => 'فشل تسجيل دخول ',
        'lockout'    => 'Locked Out',
        'reset'      => 'Reset Password',
        'login'      => 'تسجيل دخول ',
        'logout'     => 'تسجيل خروج',
    ],

    'tooltips' => [
        'viewRecord' => 'View Record Details',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Admin Dashboard Language Lines
    |--------------------------------------------------------------------------
    */
    'dashboard' => [
        'title'     => ' النشاطات',
        'subtitle'  => 'النشاطات',

        'labels'    => [
            'id'            => 'رقم',
            'time'          => 'الوقت',
            'description'   => 'الوصف',
            'user'          => 'المستخدم',
            'method'        => 'الطريقة',
            'route'         => 'Route',
            'ipAddress'     => 'Ip <span class="hidden-sm hidden-xs">Address</span>',
            'agent'         => '<span class="hidden-sm hidden-xs">المتصفح </span>',
            'deleteDate'    => '<span class="hidden-sm hidden-xs">Date </span>Deleted',
        ],

        'menu'      => [
            'alt'           => 'Activity Log Menu',
            'clear'         => 'Clear Activity Log',
            'show'          => 'Show Cleared Logs',
            'back'          => 'Back to Activity Log',
        ],

        'search'    => [
            'all'           => 'All',
            'search'        => 'Search',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Admin Drilldown Language Lines
    |--------------------------------------------------------------------------
    */

    'drilldown' => [
        'title'                 => 'Activity Log :id',
        'title-details'         => 'Activity Details',
        'title-ip-details'      => 'Ip Address Details',
        'title-user-details'    => 'User Details',
        'title-user-activity'   => 'Additional User Activity',

        'buttons'   => [
            'back'      => '<span class="hidden-xs hidden-sm">Back to </span><span class="hidden-xs">Activity Log</span>',
        ],

        'labels' => [
            'userRoles'     => 'User Roles',
            'userLevel'     => 'Level',
        ],

        'list-group' => [
            'labels'    => [
                'id'            => 'Activity Log ID:',
                'ip'            => 'Ip Address',
                'description'   => 'Description',
                'details'       => 'Details',
                'userType'      => 'User Type',
                'userId'        => 'User Id',
                'route'         => 'Route',
                'agent'         => 'المتصفح',
                'locale'        => 'Locale',
                'referer'       => 'Referer',

                'methodType'    => 'Method Type',
                'createdAt'     => 'Event Time',
                'updatedAt'     => 'Updated At',
                'deletedAt'     => 'Deleted At',
                'timePassed'    => 'Time Passed',
                'userName'      => 'Username',
                'userFirstName' => 'First Name',
                'userLastName'  => 'Last Name',
                'userFulltName' => 'Full Name',
                'userEmail'     => 'User Email',
                'userSignupIp'  => 'Signup Ip',
                'userCreatedAt' => 'Created',
                'userUpdatedAt' => 'Updated',
            ],

            'fields' => [
                'none' => 'None',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Modals
    |--------------------------------------------------------------------------
    */

    'modals' => [
        'shared' => [
            'btnCancel'     => 'Cancel',
            'btnConfirm'    => 'Confirm',
        ],
        'clearLog' => [
            'title'     => 'Clear Activity Log',
            'message'   => 'Are you sure you want to clear the activity log?',
        ],
        'deleteLog' => [
            'title'     => 'Permanently Delete Activity Log',
            'message'   => 'Are you sure you want to permanently DELETE the activity log?',
        ],
        'restoreLog' => [
            'title'     => 'Restore Cleared Activity Log',
            'message'   => 'Are you sure you want to restore the cleared activity logs?',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Flash Messages
    |--------------------------------------------------------------------------
    */

    'messages' => [
        'logClearedSuccessfuly'   => 'Activity log cleared successfully',
        'logDestroyedSuccessfuly' => 'Activity log deleted successfully',
        'logRestoredSuccessfuly'  => 'Activity log restored successfully',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Cleared Dashboard Language Lines
    |--------------------------------------------------------------------------
    */

    'dashboardCleared' => [
        'title'     => 'Cleared Activity Logs',
        'subtitle'  => 'Cleared Events',

        'menu'      => [
            'deleteAll'  => 'Delete All Activity Logs',
            'restoreAll' => 'Restore All Activity Logs',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Pagination Language Lines
    |--------------------------------------------------------------------------
    */
    'pagination' => [
        'countText' => 'Showing :firstItem - :lastItem of :total results <small>(:perPage per page)</small>',
    ],

];
