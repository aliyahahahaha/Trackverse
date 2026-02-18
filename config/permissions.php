<?php

return [
    'groups' => [
        'project' => [
            'label' => 'Project Management',
            'permissions' => [
                'view_projects' => [
                    'name' => 'View Projects',
                    'description' => 'Can view project details',
                ],
                'create_projects' => [
                    'name' => 'Create Projects',
                    'description' => 'Can create new projects',
                ],
                'edit_projects' => [
                    'name' => 'Edit Projects',
                    'description' => 'Can update project details',
                ],
                'delete_projects' => [
                    'name' => 'Delete Projects',
                    'description' => 'Can remove existing projects',
                ],
            ]
        ],
        'task' => [
            'label' => 'Task Management',
            'permissions' => [
                'create_tasks' => [
                    'name' => 'Create Tasks',
                    'description' => 'Can assign new tasks',
                ],
                'edit_tasks' => [
                    'name' => 'Edit Tasks',
                    'description' => 'Can modify task details',
                ],
                'update_task_status' => [
                    'name' => 'Update Task Status',
                    'description' => 'Can only update task status',
                ],
                'delete_tasks' => [
                    'name' => 'Delete Tasks',
                    'description' => 'Can remove tasks',
                ],
            ]
        ],
        'ticket' => [
            'label' => 'Ticket Management',
            'permissions' => [
                'create_tickets' => [
                    'name' => 'Create Tickets',
                    'description' => 'Can raise support tickets',
                ],
                'resolve_tickets' => [
                    'name' => 'Resolve Tickets',
                    'description' => 'Can mark tickets as resolved',
                ],
                'delete_tickets' => [
                    'name' => 'Delete Tickets',
                    'description' => 'Can permanently remove tickets',
                ],
            ]
        ],
        'system' => [
            'label' => 'System Features',
            'permissions' => [
                'manage_users' => [
                    'name' => 'Manage Users',
                    'description' => 'Can add, edit, or remove users',
                ],
                'view_reports' => [
                    'name' => 'View Reports',
                    'description' => 'Access to analytics and system reports',
                ],
            ]
        ]
    ]
];
