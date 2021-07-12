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

    'logout'                    => 'Abmelden',
    'profile'                   => 'Profil',
    'change-password'           => 'Passwort ändern',
    'logged-in-as'              => 'Angemeldet als:',

    'no-permission'             => "Sie haben keine Administratorrechte!",

    'yes'                       => 'Ja',
    'no'                        => 'Nein',

    'actions'                   => 'Aktionen',
    'create'                    => 'Create',
    'edit'                      => 'Bearbeiten',
    'save'                      => 'Speichern',
    'update'                    => 'Aktualisieren',
    'delete'                    => 'Löschen',
    'file'                      => 'Datei',
    'iterator'                  => '#',

    // Notifications
    'notifications' => [
        'notifications'         => 'Benachrichtigungen',
        'awesome'               => 'Genial.',
        'whoops'                => 'Hoppla.',
    ],

    'users' => [
        'users'                 => 'Benutzer',
        'name'                  => 'Name',
        'email'                 => 'E-Mail',
        'address'               => 'Adresse',
        'postcode'              => 'Postleitzahl',
        'city'                  => 'Stadt',
        'mobile'                => 'Mobil',
        'is-locked'             => 'Ist gesperrt',
        'is-admin'              => 'Ist Administrator',
        'subscription'          => 'Abo',
        'subscribed-until'      => 'Abonniert bis',
        'reminder-sent'         => 'Erinnerung gesendet',
        'must-change-password'  => 'Passwort muss geändert werden',
        'institution'           => 'Institution',
        'may-edit-patients'     => 'darf Patienten bearbeiten',
        'may-edit-employees'    => 'darf Mitarbeiter bearbeiten',
        'is-institution-admin'  => 'Ist Administrator der Institution',
        'no-result'             => 'Kein Ergebnis zum Anzeigen.',
        'create-user'           => 'Benutzer erstellen',
        'edit-user'             => 'Benutzer bearbeiten',
        'create-success'        => 'Ein neuer Benutzer wurde erstellt.',
        'edit-success'          => 'Der Benutzer wurde aktualisiert.',
        'delete-success'        => 'Der Benutzer wurde gelöscht.',
    ],

    'institutions' => [
        'institutions'          => 'Institutionen',
        'name'                  => 'Name',
        'no-result'             => 'Kein Ergebnis zum Anzeigen.',
        'edit-institution'      => 'Institution bearbeiten',
        'create-institution'    => 'Institution erstellen',
        'create-success'        => 'Eine neue Institution wurde erstellt.',
        'edit-success'          => 'Die Institution wurde aktualisiert.',
        'delete-success'        => 'Die Institution wurde gelöscht.',
    ],

    'patients' => [
        'patients'              => 'Patienten',
        'name'                  => 'Name',
        'date-of-birth'         => 'Geburtsdatum',
        'patient-number'        => 'Patientennummer',
        'institution'           => 'Institution',
        'no-result'             => 'Kein Ergebnis zum Anzeigen.',
        'create-patient'        => 'Patient erstellen',
        'create-success'        => 'Ein neuer Patient wurde erstellt.',
        'edit-patient'          => 'Patient bearbeiten',
        'edit-success'          => 'Der Patient wurde aktualisiert.',
        'delete-success'        => 'Der Patient wurde gelöscht.',
    ],

    'invoices' => [
        'invoices'              => 'Rechnungen',
        'user-name'             => 'Benutzername',
        'invoice-date'          => 'Rechnungsdatum',
        'payment-date'          => 'Zahlungsdatum',
        'amount'                => 'Betrag',
        'text'                  => 'Text',
        'invoice-lines'         => 'Rechnungszeilen',
        'status'                => 'Status',
        'user'                  => 'Benutzer',
        'download-document'     => 'Dokument herunterladen',
        'download-invoice'      => 'Rechnung herunterladen',
        'download-receipt'      => 'Quittung herunterladen',
        'download'              => 'Herunterladen',
        'no-result'             => 'Kein Ergebnis zum Anzeigen.',
        'create-invoice'        => 'Rechnung erstellen',
        'create-success'        => 'Eine neue Rechnung wurde erstellt.',
        'edit-invoice'          => 'Rechnung bearbeiten',
        'edit-success'          => 'Die Rechnung wurde aktualisiert.',
        'delete-success'        => 'Die Rechnung wurde gelöscht.',
    ],

    'subscriptions' => [
        'subscriptions'         => 'Abonnements',
        'monthly-price'         => 'Monatlicher Preis',
        'title'                 => 'Titel',
        'description'           => 'Beschreibung',
        'has-timeline'          => 'Hat Timeline',
        'has-documents'         => 'Hat Dokumente',
        'has-institution'       => 'Hat Institution',
        'no-result'             => 'Kein Ergebnis zum Anzeigen.',
        'create-subscription'   => 'Abo erstellen',
        'edit-subscription'     => 'Abo bearbeiten',
        'create-success'        => 'Ein neues Abo wurde erstellt.',
        'edit-success'          => 'Das Abo wurde aktualisiert.',
        'delete-success'        => 'Das Abo wurde gelöscht.',
    ],

    'folders' => [
        'folders'               => 'Ordner',
        'name'                  => 'Name',
        'no-result'             => 'Kein Ergebnis zum Anzeigen.',
        'create-folder'         => 'Ordner erstellen',
        'edit-folder'           => 'Ordner bearbeiten',
        'create-success'        => 'Ein neuer Ordner wurde erfasst.',
        'edit-success'          => 'Der Ordner wurde aktualisiert.',
        'delete-success'        => 'Der Ordner wurde gelöscht.',
    ],

    'documents' => [
        'documents'             => 'Dokumente / Verfügungen',
        'patient'               => 'Patient',
        'coupon'                => 'Gutschein',
        'title'                 => 'Titel',
        'file-name'             => 'Dateiname',
        'storage-file-name'     => 'Interner Dateiname',
        'folder'                => 'Ordner',
        'is-provision'          => 'Ist Verfügung',
        'download-document'     => 'Dokument herunterladen',
        'no-result'             => 'Kein Ergebnis zum Anzeigen.',
        'create-document'       => 'Dokument erstellen',
        'edit-document'         => 'Dokument bearbeiten',
        'create-success'        => 'Ein neues Dokument wurde erstellt.',
        'edit-success'          => 'Das Dokument wurde aktualisiert.',
        'delete-success'        => 'Das Dokument wurde gelöscht.',
    ],
];
