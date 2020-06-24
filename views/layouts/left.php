<?php

/**
 * Created by PhpStorm.
 * User: ds
 * Date: 11/11/17
 * Time: 10:00 PM
 */

use app\models\User;

if (!Yii::$app->user->isGuest) {
    echo \yiister\gentelella\widgets\Menu::widget(
        [
            "items" => [
                /*[
                    "label" => "Dashboard",
                    "url" => "about",
                    'icon' => 'dashboard',
                    'visible' => (
                        Yii::$app->user->identity->role == User::ROLE_NOTARIS
                    ),
                ],*/
                [
                    "label" => "Kelola Notaris",
                    "url" => ["notaris/"],
                    "icon" => "user-secret",
                    'visible' => (
                        Yii::$app->user->identity->role == User::ROLE_SUPER
                    ),
                ],
                [
                    "label" => "Akta Umum",
                    'icon' => 'user-secret',
                    "url" => "#",
                    'visible' => (
                        Yii::$app->user->identity->role == User::ROLE_NOTARIS or
                        Yii::$app->user->identity->role == User::ROLE_CLIENT
                    ),
                    "items" => [
                        [
                            "label" => "Kelola Akta",
                            "url" => ["akta-notaris/"],
                            "active" => (Yii::$app->controller->id == 'akta-notaris'),
                            'visible' => (
                                Yii::$app->user->identity->role == User::ROLE_NOTARIS or
                                Yii::$app->user->identity->role == User::ROLE_CLIENT
                            ),
                        ],
                        [
                            "label" => "Daftar Pihak",
                            "url" => ["akta-notaris-pihak/"],
                            "active" => (Yii::$app->controller->id == 'akta-notaris-pihak'),
                            'visible' => (
                                Yii::$app->user->identity->role == User::ROLE_NOTARIS or
                                Yii::$app->user->identity->role == User::ROLE_CLIENT
                            ),
                        ],
                        [
                            "label" => "Kelola Jenis Akta",
                            "url" => ["akta-notaris-jenis/"],
                            "active" => (Yii::$app->controller->id == 'akta-notaris-jenis'),
                            'visible' => (
                                Yii::$app->user->identity->role == User::ROLE_NOTARIS
                            ),
                        ],
                    ],

                ],
                [
                    "label" => "Badan Hukum / Usaha",
                    'icon' => 'user-secret',
                    "url" => "#",
                    'visible' => (
                        Yii::$app->user->identity->role == User::ROLE_NOTARIS or
                        Yii::$app->user->identity->role == User::ROLE_CLIENT
                    ),
                    "items" => [
                        [
                            "label" => "Kelola Akta",
                            "url" => ["akta-badan/"],
                            "active" => (Yii::$app->controller->id == 'akta-badan'),
                            'visible' => (
                                Yii::$app->user->identity->role == User::ROLE_NOTARIS or
                                Yii::$app->user->identity->role == User::ROLE_CLIENT
                            ),
                        ],
                        [
                            "label" => "Kelola Jenis Akta",
                            "url" => ["akta-badan-jenis-sifat/"],
                            "active" => (Yii::$app->controller->id == 'akta-badan-jenis-sifat'),
                            'visible' => (
                                Yii::$app->user->identity->role == User::ROLE_NOTARIS
                            ),
                        ],
                    ],
                ],

                [
                    "label" => "Akta PPAT",
                    "url" => "#",
                    "icon" => "table",
                    "items" => [
                        [
                            "label" => "Kelola Akta",
                            "url" => ["akta-ppat/"],
                            "active" => (Yii::$app->controller->id == 'akta-ppat'),
                            'visible' => (
                                Yii::$app->user->identity->role == User::ROLE_NOTARIS or
                                Yii::$app->user->identity->role == User::ROLE_CLIENT
                            ),
                        ],
                        [

                            "label" => "Daftar Pihak",
                            "url" => ["akta-ppat-pihak/"],
                            "active" => (Yii::$app->controller->id == 'akta-ppat-pihak'),
                            'visible' => (
                                Yii::$app->user->identity->role == User::ROLE_NOTARIS or
                                Yii::$app->user->identity->role == User::ROLE_CLIENT
                            ),
                        ],
                        [
                            "label" => "Kelola Jenis Akta",
                            "url" => ["akta-ppat-jenis/"],
                            "active" => (Yii::$app->controller->id == 'akta-ppat-jenis'),
                            'visible' => (
                                Yii::$app->user->identity->role == User::ROLE_NOTARIS
                            ),
                        ],
                    ],
                ],
                [
                    "label" => "Surat Bawah Tangan",
                    "url" => "#",
                    "icon" => "files-o",
                    "items" => [
                        [
                            "label" => "Kelola Surat",
                            "url" => ["surat-bawah-tangan/"],
                            "active" => (Yii::$app->controller->id == 'surat-bawah-tangan'),
                        ],
                        [
                            "label" => "Kelola Sifat Surat",
                            "url" => ["surat-sifat/"],
                            "active" => (Yii::$app->controller->id == 'surat-sifat'),
                        ],
                    ],
                ],
                [
                    "label" => "Kelola User",
                    "url" => "#",
                    "icon" => "users",
                    
                    "items" => [
                        [
                            "label" => "Corporate Client",
                            "url" => ["user/cindex"],
                            //"icon" => "files-o",
                            "active" => (Yii::$app->controller->id == 'user') and
                                (Yii::$app->controller->action->id == 'cindex'),
                        ],
                        [
                            "label" => "Staff",
                            "url" => ["user/sindex"],
                            //"icon" => "users",
                            "active" => (Yii::$app->controller->id == 'user') and
                                (Yii::$app->controller->action->id == 'sindex'),
                        ],
                    ],
                ],
                [
                    "label" => "Keuangan",
                    "url" => "#",
                    "icon" => "money",                  
                    "items" => [
                        [
                            "label" => "Kelola Transaksi",
                            "url" => ["transaksi/"],
                            "active" => (Yii::$app->controller->id == 'transaksi'),
                            'visible' => (
                                Yii::$app->user->identity->role == User::ROLE_NOTARIS
                            ),

                        ],
                       
                        [
                            "label" => "Laporan Keuangan",
                            "url" => ["laporan-keuangan/"],
                             "active" => (Yii::$app->controller->id == 'laporan-keuangan'),
                            'visible' => (
                                Yii::$app->user->identity->role == User::ROLE_NOTARIS
                            ),
                            
                        ],
                        [
                            "label" => "Kelola Akun",
                            "url" => ["akun/"],
                            "active" => (Yii::$app->controller->id == 'akun'),
                            'visible' => (
                                Yii::$app->user->identity->role == User::ROLE_NOTARIS
                            ),
                            
                        ],
                    ],
                ],
                [
                    "label" => "Laporan Pencatatan Akta",
                    "url" => ["laporan-pencatatan-akta/"],
                    "icon" => "files-o",
                    "active" => (Yii::$app->controller->id == 'laporan-pencatatan-akta'),
                            'visible' => (
                                Yii::$app->user->identity->role == User::ROLE_NOTARIS
                            ),
                ],
            ],
        ]
    );
}

?>