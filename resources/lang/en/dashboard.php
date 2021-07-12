<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    // Langs that will be used from several parts of the dashboard.
    'app-name'                  => 'Lutz & Lotte',
    'dashboard'                 => 'Dashboard',
    'copyright'                 => 'Copyright © Lutz & Lotte',

    'logout'                    => 'Logout',
    'profile'                   => 'Profile',
    'change-password'           => 'Change Password',
    'logged-in-as'              => 'Logged in as:',

    'no-permission'             => "You don't have admin rights!",

    'yes'                       => 'Yes',
    'no'                        => 'No',

    'actions'                   => 'Actions',
    'create'                    => 'Create',
    'edit'                      => 'Edit',
    'save'                      => 'Save',
    'update'                    => 'Update',
    'delete'                    => 'Delete',
    'file'                      => 'File',
    'iterator'                  => '#',

    // Notifications
    'notifications' => [
        'notifications'         => 'Notifications',
        'awesome'               => 'Awesome.',
        'whoops'                => 'Whoops.',
    ],

    'users' => [
        'users'                 => 'Users',
        'name'                  => 'Name',
        'email'                 => 'Email',
        'address'               => 'Address',
        'postcode'              => 'Postcode',
        'city'                  => 'City',
        'mobile'                => 'Mobile',
        'is-locked'             => 'Is Locked',
        'is-admin'              => 'Is Admin',
        'subscription'          => 'Subscription',
        'subscribed-until'      => 'Subscribed Until',
        'reminder-sent'         => 'Reminder Sent',
        'must-change-password'  => 'Must Change Password',
        'institution'           => 'Institution',
        'may-edit-patients'     => 'May Edit Patients',
        'may-edit-employees'    => 'May Edit Employees',
        'is-institution-admin'  => 'Is Institution Admin',
        'no-result'             => 'No result to display.',
        'create-user'           => 'Create a User',
        'edit-user'             => 'Edit User',
        'create-success'        => 'A new user has been created.',
        'edit-success'          => 'The user has been updated.',
        'delete-success'        => 'The user has been deleted.',
    ],

    'institutions' => [
        'institutions'          => 'Institutions',
        'name'                  => 'Name',
        'no-result'             => 'No result to display.',
        'edit-institution'      => 'Edit Institution',
        'create-institution'    => 'Create an Institution',
        'create-success'        => 'A new institution has been created.',
        'edit-success'          => 'The institution has been updated.',
        'delete-success'        => 'The institution has been deleted.',
    ],

    'patients' => [
        'patients'              => 'Patients',
        'name'                  => 'Name',
        'date-of-birth'         => 'Date of Birth',
        'patient-number'        => 'Patient Number',
        'institution'           => 'Institution',
        'no-result'             => 'No result to display.',
        'edit-patient'          => 'Edit Patient',
        'create-patient'        => 'Create a Patient',
        'create-success'        => 'A new patient has been created.',
        'edit-success'          => 'The patient has been updated.',
        'delete-success'        => 'The patient has been deleted.',
    ],

    'invoices' => [
        'invoices'              => 'Invoices',
        'user-name'             => 'User Name',
        'invoice-date'          => 'Invoice Date',
        'payment-date'          => 'Payment Date',
        'amount'                => 'Amount',
        'text'                  => 'Text',
        'invoice-lines'         => 'Invoice Lines',
        'status'                => 'Status',
        'user'                  => 'User',
        'download-document'     => 'Download Document',
        'download-invoice'      => 'Download Invoice',
        'download-receipt'      => 'Download Receipt',
        'download'              => 'Download',
        'no-result'             => 'No result to display.',
        'edit-invoice'          => 'Edit Invoice',
        'create-invoice'        => 'Create an Invoice',
        'create-success'        => 'A new invoice has been created.',
        'edit-success'          => 'The invoice has been updated.',
        'delete-success'        => 'The invoice has been deleted.',
    ],

    'subscriptions' => [
        'subscriptions'         => 'Subscriptions',
        'monthly-price'         => 'Monthly Price',
        'title'                 => 'Title',
        'description'           => 'Description',
        'has-timeline'          => 'Has Timeline',
        'has-documents'         => 'Has Documents',
        'has-institution'       => 'Has Institution',
        'provisions'            => 'Provisions',
        'no-result'             => 'No result to display.',
        'edit-subscription'     => 'Edit Subscription',
        'create-subscription'   => 'Create a Subscription',
        'create-success'        => 'A new subscription has been created.',
        'edit-success'          => 'The subscription has been updated.',
        'delete-success'        => 'The subscription has been deleted.',
    ],

    'folders' => [
        'folders'               => 'Folders',
        'name'                  => 'Name',
        'no-result'             => 'No result to display.',
        'edit-folder'           => 'Edit Folder',
        'create-folder'         => 'Create a Folder',
        'create-success'        => 'A new folder has been created.',
        'edit-success'          => 'The folder has been updated.',
        'delete-success'        => 'The folder has been deleted.',
    ],

    'documents' => [
        'documents'             => 'Documents / Provisions',
        'patient'               => 'Patient',
        'coupon'                => 'Coupon',
        'title'                 => 'Title',
        'file-name'             => 'File Name',
        'storage-file-name'     => 'Storage File Name',
        'folder'                => 'Folder',
        'is-provision'          => 'Is Provision',
        'download-document'     => 'Download Document',
        'no-result'             => 'No result to display.',
        'edit-document'         => 'Edit document',
        'create-document'       => 'Create a Document',
        'create-success'        => 'A new document has been created.',
        'edit-success'          => 'The document has been updated.',
        'delete-success'        => 'The document has been deleted.',
    ],
];
