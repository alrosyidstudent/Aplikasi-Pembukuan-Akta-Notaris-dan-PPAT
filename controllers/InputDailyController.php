<?php

namespace app\controllers;

use app\models\Kpi;
use app\models\Site;
use Yii;
use app\models\Blueteam;
use app\models\InputDaily;
use app\models\InputDailySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;
use app\components\AccessRule;
use app\models\User;

/**
 * InputDailyController implements the CRUD actions for InputDaily model.
 */
class InputDailyController extends Controller
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index', 'create', 'kalender', 'update', 'kalender-sites', 'detail-report', 'report', 'retailer-report'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_BT,
                            User::ROLE_RT,
                            User::ROLE_CM,
                            User::ROLE_DM,
                            User::ROLE_OST,
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_BT,
                            User::ROLE_RT,
                            User::ROLE_CM,
                        ],
                    ],
                    [
                        'actions' => ['kalender'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_BT
                        ],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_BT,
                            User::ROLE_RT,
                            User::ROLE_CM,
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['kalender-sites'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_RT,
                            User::ROLE_CM,
                            User::ROLE_DM,
                            User::ROLE_OST,
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['detail-report'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_BT,
                            User::ROLE_RT,
                            User::ROLE_CM,
                            User::ROLE_MN,
                            User::ROLE_DM,
                            User::ROLE_OST,
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['report'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_BT,
                            User::ROLE_RT,
                            User::ROLE_CM,
                            User::ROLE_MN,
                            User::ROLE_DM,
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['retailer-report'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_BT,
                            User::ROLE_RT,
                            User::ROLE_CM,
                            User::ROLE_MN,
                            User::ROLE_DM,
                            User::ROLE_OST,
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['teritory-report'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_DM,
                            User::ROLE_OST,
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['detail-report-tahun'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_BT,
                            User::ROLE_RT,
                            User::ROLE_CM,
                            User::ROLE_DM,
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['report-tahun'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_BT,
                            User::ROLE_RT,
                            User::ROLE_CM,
                            User::ROLE_DM,
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['retailer-report-tahun'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_BT,
                            User::ROLE_RT,
                            User::ROLE_CM,
                            User::ROLE_DM,
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['teritory-report-tahun'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_DM,
                            User::ROLE_OST,
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['distributor-report-tahun'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['retailers-quarter-rank'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_DM,
                            User::ROLE_CM,
                            User::ROLE_OST,
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['retailers-quarter-rank-detil'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_DM,
                            User::ROLE_OST,
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['teritories-quarter-rank'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_DM,
                            User::ROLE_OST,
                            User::ROLE_TM
                        ],
                    ],
                    [
                        'actions' => ['teritories-quarter-rank-detil'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_DM,
                            User::ROLE_OST,
                            User::ROLE_TM
                        ],
                    ],
                ],
            ],
        ];
    }

    public function actionFormReports()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->user->identity->role == User::ROLE_DM
                or Yii::$app->user->identity->role == User::ROLE_OST) {
                return $this->render('distributor_monthly_reports', [
                    'model' => $model,
                ]);
            } elseif (Yii::$app->user->identity->role == User::ROLE_TM) {
                return $this->render('teritory_monthly_reports', [
                    'model' => $model,
                ]);
            } elseif (Yii::$app->user->identity->role == User::ROLE_RT
                or Yii::$app->user->identity->role == User::ROLE_CM
                or Yii::$app->user->identity->role == User::ROLE_MN
            ) {
                return $this->render('retailer_monthly_reports', [
                    'model' => $model,
                ]);
            } elseif (Yii::$app->user->identity->role == User::ROLE_BT) {
                return $this->render('site_monthly_reports', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('_form_reports', [
                'model' => $model,
            ]);
        }
    }

    public function actionTeritoriesMonthlyReport($date)
    {
        return $this->render('teritories_monthly_reports', [
            'date' => $date,
        ]);
    }

    public function actionRetailersMonthlyReport($teritory_id, $date)
    {
        return $this->render('retailers_monthly_reports', [
            'date' => $date,
            'teritory_id' => $teritory_id
        ]);
    }

    public function actionSitesMonthlyReport($retailer_id, $date)
    {
        return $this->render('sites_monthly_reports', [
            'date' => $date,
            'retailer_id' => $retailer_id
        ]);
    }

    public function actionFormQuarterReports()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->user->identity->role == User::ROLE_DM
                or Yii::$app->user->identity->role == User::ROLE_OST) {
                return $this->render('distributor_quarter_reports', [
                    'model' => $model,
                ]);
            } elseif (Yii::$app->user->identity->role == User::ROLE_TM) {
                return $this->render('teritory_quarter_reports', [
                    'model' => $model,
                ]);
            } elseif (Yii::$app->user->identity->role == User::ROLE_RT
                or Yii::$app->user->identity->role == User::ROLE_CM
                or Yii::$app->user->identity->role == User::ROLE_MN
            ) {
                return $this->render('retailer_quarter_reports', [
                    'model' => $model,
                ]);
            } elseif (Yii::$app->user->identity->role == User::ROLE_BT) {
                return $this->render('site_quarter_reports', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('_form_quarter_reports', [
                'model' => $model,
            ]);
        }
    }

    public function actionTeritoriesQuarterRank()
    {
        $model = new InputDaily();

        if ($model->load(Yii::$app->request->post())) {
            /*echo "<pre>";
            print_r(Yii::$app->request->post());
            echo "</pre>";*/
            if (Yii::$app->request->post()['InputDaily']['quarter'] != '') {
                return $this->render('teritories_quarter_rank', [
                    'tahun' => Yii::$app->request->post()['InputDaily']['tahun'],
                    'quarter' => Yii::$app->request->post()['InputDaily']['quarter'],
                ]);
            } else {
                return $this->render('_form_rank_teritories', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('_form_rank_teritories', [
                'model' => $model,
            ]);
        }
    }

    public function actionTeritoryQuarterRankDetil($retailer_id, $tahun, $quarter)
    {
        $model = new InputDaily();

        return $this->render('retailer_quarter_rank_detil', [
            'retailer_id' => $retailer_id,
            'tahun' => $tahun,
            'quarter' => $quarter,
            'model' => $model
        ]);
    }

    public function actionRetailersQuarterRank()
    {
        $model = new InputDaily();
        if(isset(Yii::$app->request->post()['InputDaily'] )) {
            return $this->render('retailers_quarter_rank', [
                'tahun' => Yii::$app->request->post()['InputDaily']['tahun'],
                'quarter' => Yii::$app->request->post()['InputDaily']['quarter'],
            ]);
        }elseif (isset(Yii::$app->request->get()['tahun'])){
            /*echo "<pre>";
            print_r(Yii::$app->request->get());
            echo "</pre>";*/
            return $this->render('retailers_quarter_rank', [
                'tahun' => Yii::$app->request->get()['tahun'],
                'quarter' => Yii::$app->request->get()['quarter'],
            ]);

        }else{
            return $this->render('_form_rank', [
                'model' => $model,
            ]);
        }

    }

    public function actionRetailerQuarterRankDetil($retailer_id, $tahun, $quarter)
    {
        $model = new InputDaily();

        return $this->render('retailer_quarter_rank_detil', [
            'retailer_id' => $retailer_id,
            'tahun' => $tahun,
            'quarter' => $quarter,
            'model' => $model
        ]);
    }

    public function actionTeritoriesQuarterReport($date)
    {
        return $this->render('teritories_quarter_reports', [
            'date' => $date,
        ]);
    }

    public function actionRetailersQuarterReport($teritory_id, $date)
    {
        return $this->render('retailers_quarter_reports', [
            'date' => $date,
            'teritory_id' => $teritory_id
        ]);
    }

    public function actionSitesQuarterReport($retailer_id, $date)
    {
        return $this->render('sites_quarter_reports', [
            'date' => $date,
            'retailer_id' => $retailer_id
        ]);
    }

    public function actionFormYearlyReports()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->user->identity->role == User::ROLE_DM
                or Yii::$app->user->identity->role == User::ROLE_OST) {
                return $this->render('distributor_yearly_reports', [
                    'model' => $model,
                ]);
            } elseif (Yii::$app->user->identity->role == User::ROLE_TM) {
                return $this->render('teritory_yearly_reports', [
                    'model' => $model,
                ]);
            } elseif (Yii::$app->user->identity->role == User::ROLE_RT
                or Yii::$app->user->identity->role == User::ROLE_CM
                or Yii::$app->user->identity->role == User::ROLE_MN
            ) {
                return $this->render('retailer_yearly_reports', [
                    'model' => $model,
                ]);
            } elseif (Yii::$app->user->identity->role == User::ROLE_BT) {
                return $this->render('site_yearly_reports', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('_form_yearly_reports', [
                'model' => $model,
            ]);
        }
    }

    public function actionTeritoriesYearlyReport($date)
    {
        return $this->render('teritories_yearly_reports', [
            'date' => $date,
        ]);
    }

    public function actionRetailersYearlyReport($teritory_id, $date)
    {
        return $this->render('retailers_yearly_reports', [
            'date' => $date,
            'teritory_id' => $teritory_id
        ]);
    }

    public function actionSitesYearlyReport($retailer_id, $date)
    {
        return $this->render('sites_yearly_reports', [
            'date' => $date,
            'retailer_id' => $retailer_id
        ]);
    }

/////
    public function actionKalenderSites()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            $tahun = Yii::$app->request->post()['InputDaily']['tahun'];
            $site = Yii::$app->request->post()['InputDaily']['site_id'];
            $site_name = Site::find()->where(['id' => $site])->one();
            //print_r($site=Yii::$app->request->post()['InputDaily']);

            $jumlah = \app\models\Kpi::find()
                ->where(['periode_input' => 'Harian'])
                ->count();

            $connection = \Yii::$app->getDb();

            $q_done = $connection->createCommand('
            select tanggal as tgl,count(tanggal) as jml from input_daily 
            where tanggal LIKE "' . $tahun . '%" AND realisasi!="" AND site_id="' . $site . '" 
            AND kpi_id IN (select id from kpi WHERE periode_input="Harian")
            group by tanggal;');
            $done = $q_done->queryAll();

            $status = array();
            foreach ($done as $item_d) {
                $status[$item_d['tgl']]['done'] = '0';
            }

            foreach ($done as $item_d) {
                $status[$item_d['tgl']]['done'] = $item_d['jml'];
            }

            $a_done = array();
            $a_tgl = array();
            $i = 0;
            foreach ($done as $item_d) {
                $i++;
                $a_done[$i] = $status[$item_d['tgl']]['done'];
                $a_tgl[$i] = $item_d['tgl'];
            }

            return $this->render('kalendersites', [
                'model' => $model,
                'done' => $a_done,
                'tgl' => $a_tgl,
                'jumlah' => $jumlah,
                'site' => $site_name->nama,
            ]);
        } else {
            return $this->render('_formkalendersites', [
                'model' => $model,
            ]);
        }
    }

    public function actionKalender()
    {
        $model = new InputDaily();
        $idbt = Yii::$app->user->identity->id;
        $site = Blueteam::find()->where(['user_id' => $idbt])->one();

        $jumlah = \app\models\Kpi::find()
            ->where(['periode_input' => 'Harian'])
            ->count();

        if ($model->load(Yii::$app->request->post())) {
            $tahun = Yii::$app->request->post()['InputDaily']['tahun'];

            $connection = \Yii::$app->getDb();

            $q_done = $connection->createCommand('
            select tanggal as tgl,count(tanggal) as jml from input_daily 
            where tanggal LIKE "' . $tahun . '%" AND realisasi!="" AND site_id="' . $site->site_id . '" 
            AND kpi_id IN (select id from kpi WHERE periode_input="Harian")
            group by tanggal;');
            $done = $q_done->queryAll();

            $status = array();
            foreach ($done as $item_d) {
                $status[$item_d['tgl']]['done'] = '0';
            }

            foreach ($done as $item_d) {
                $status[$item_d['tgl']]['done'] = $item_d['jml'];
            }

            $a_done = array();
            $a_tgl = array();
            $i = 0;
            foreach ($done as $item_d) {
                $i++;
                $a_done[$i] = $status[$item_d['tgl']]['done'];
                $a_tgl[$i] = $item_d['tgl'];
            }

            return $this->render('kalender', [
                'model' => $model,
                'done' => $a_done,
                'tgl' => $a_tgl,
                'jumlah' => $jumlah,
            ]);
        } else {
            $tahun = date("Y");

            $connection = \Yii::$app->getDb();

            $q_done = $connection->createCommand('
            select tanggal as tgl,count(tanggal) as jml from input_daily 
            where tanggal LIKE "' . $tahun . '%" AND realisasi!="" AND site_id="' . $site->site_id . '" 
            AND kpi_id IN (select id from kpi WHERE periode_input="Harian")
            group by tanggal;');
            $done = $q_done->queryAll();

            /*$q_tgl = $connection->createCommand('
            select tanggal as tgl from input_daily 
            where  tanggal LIKE "'.$tahun.'%" AND site_id="'.$site->site_id.'" 
            AND kpi_id IN (select id from kpi WHERE periode_input="Harian")
            group by tanggal ;');
            $tgl = $q_tgl->queryAll();*/

            $status = array();
            foreach ($done as $item_d) {
                $status[$item_d['tgl']]['done'] = '0';
            }

            foreach ($done as $item_d) {
                $status[$item_d['tgl']]['done'] = $item_d['jml'];
            }

            $a_done = array();
            $a_tgl = array();
            $i = 0;
            foreach ($done as $item_d) {
                $i++;
                $a_done[$i] = $status[$item_d['tgl']]['done'];
                $a_tgl[$i] = $item_d['tgl'];
            }

            return $this->render('_formkalender', [
                'model' => $model,
                'done' => $a_done,
                'tgl' => $a_tgl,
                'jumlah' => $jumlah,
            ]);
        }
    }

    public function actionDistributorReportTahun()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->render('progress_distributor_tahun', [
                'model' => $model,
            ]);
            //return $this->redirect(['report', 'tanggal' => $model->tanggal]);
        } else {
            return $this->render('laporan_distributor_tahun', [
                'model' => $model,
            ]);
        }
    }

    public function actionDistributorReport()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->render('progress_distributor', [
                'model' => $model,
            ]);
            //return $this->redirect(['report', 'tanggal' => $model->tanggal]);
        } else {
            return $this->render('laporan_distributor', [
                'model' => $model,
            ]);
        }
    }

    public function actionRetailerReportTahun()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->render('progress_retailers_tahun', [
                'model' => $model,
            ]);
        } else {
            return $this->render('laporan_retailers_tahun', [
                'model' => $model,
            ]);
        }
    }

    public function actionRetailerReportQuarter()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->render('progress_retailers_quarter', [
                'model' => $model,
            ]);
        } else {
            return $this->render('laporan_retailers_quarter', [
                'model' => $model,
            ]);
        }
    }

    public function actionTeritoryReportTahun()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->render('progress_teritories_tahun', [
                'model' => $model,
            ]);
            //return $this->redirect(['report', 'tanggal' => $model->tanggal]);
        } else {
            return $this->render('laporan_teritories_tahun', [
                'model' => $model,
            ]);
        }
    }

    public function actionReportTahun()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->render('progress_tahun', [
                'model' => $model,
            ]);
            //return $this->redirect(['report', 'tanggal' => $model->tanggal]);
        } else {
            return $this->render('laporan_tahun', [
                'model' => $model,
            ]);
        }
    }

    public function actionReportQuarter()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->render('progress_quarter', [
                'model' => $model,
            ]);
            //return $this->redirect(['report', 'tanggal' => $model->tanggal]);
        } else {
            return $this->render('laporan_quarter', [
                'model' => $model,
            ]);
        }
    }

    public function actionDetailReportTahun()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->render('progress_sites_tahun', [
                'model' => $model,
            ]);
        } else {
            return $this->render('laporan_tahun_sites', [
                'model' => $model,
            ]);
        }
    }

    public function actionDetailReportQuarter()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->render('progress_sites_quarter', [
                'model' => $model,
            ]);
        } else {
            return $this->render('laporan_quarter_sites', [
                'model' => $model,
            ]);
        }
    }

    public function actionRetailerReport()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->render('progress_retailers', [
                'model' => $model,
            ]);
            //return $this->redirect(['report', 'tanggal' => $model->tanggal]);
        } else {
            return $this->render('laporan_retailers', [
                'model' => $model,
            ]);
        }
    }

    public function actionReport()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->render('progress', [
                'model' => $model,
            ]);
            //return $this->redirect(['report', 'tanggal' => $model->tanggal]);
        } else {
            return $this->render('laporan_cluster', [
                'model' => $model,
            ]);
        }
    }

    public function actionTeritoryReport()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->render('progress_teritories', [
                'model' => $model,
            ]);
            //return $this->redirect(['report', 'tanggal' => $model->tanggal]);
        } else {
            return $this->render('laporan_teritories', [
                'model' => $model,
            ]);
        }
    }

    public function actionDetailReport()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->render('progress_sites', [
                'model' => $model,
            ]);
            //return $this->redirect(['report', 'tanggal' => $model->tanggal]);
        } else {
            return $this->render('laporan', [
                'model' => $model,
            ]);
        }
    }

    public function actionSiteReport()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->render('progress_site', [
                'model' => $model,
            ]);
            //return $this->redirect(['report', 'tanggal' => $model->tanggal]);
        } else {
            return $this->render('laporan', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Lists all InputDaily models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InputDailySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InputDaily model.
     * @param integer $site_id
     * @param integer $kpi_id
     * @param string $tanggal
     * @param integer $grade_id
     * @return mixed
     */
    public function actionView($site_id, $kpi_id, $tanggal, $grade_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($site_id, $kpi_id, $tanggal, $grade_id),
        ]);
    }

    /**
     * Creates a new InputDaily model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InputDaily();
        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['input', 'tanggal' => $model->tanggal]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing InputDaily model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $site_id
     * @param integer $kpi_id
     * @param string $tanggal
     * @param integer $grade_id
     * @return mixed
     */
    public function actionInput($tanggal)
    {
        $idbt = Yii::$app->user->identity->id;
        $bt = Blueteam::find()->where(['user_id' => $idbt])->one();

        $model = new InputDaily();
        $kpis = InputDaily::find()
            ->where(['tanggal' => $tanggal])
            ->andWhere(['site_id' => $bt->site_id])
            ->select(['kpi_id', 'grade_id'])
            ->asArray()
            ->all();

        if ($model->load(Yii::$app->request->post())) {

            $input = Yii::$app->request->post()['InputDaily'];
            $n = count($input);

            for ($i = 1; $i <= $n; $i++) {
                $kpi = explode('-', $input['i' . $i]);
                $model = $this->findModel($bt->site_id, $kpi[0], $tanggal, $kpi[1]);
                $i++;
                $model->realisasi = $input['i' . $i];
                /*echo "<pre>";
                print_r($model);
                echo "</pre>";*/
                $model->save();
            }
            //return $this->redirect(['view', 'site_id' => $model->site_id, 'kpi_id' => $model->kpi_id, 'tanggal' => $model->tanggal, 'grade_id' => $model->grade_id]);
            return $this->redirect(['index']);
        } else {
            return $this->render('input', [
                'kpis' => $kpis,
                'model' => $model,
                'tanggal' => $tanggal,
            ]);
        }
    }

    public function actionUpdate($site_id, $kpi_id, $tanggal, $grade_id)
    {
        $model = $this->findModel($site_id, $kpi_id, $tanggal, $grade_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'site_id' => $model->site_id, 'kpi_id' => $model->kpi_id, 'tanggal' => $model->tanggal, 'grade_id' => $model->grade_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing InputDaily model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $site_id
     * @param integer $kpi_id
     * @param string $tanggal
     * @param integer $grade_id
     * @return mixed
     */
    /*public function actionDelete($site_id, $kpi_id, $tanggal, $grade_id)
    {
        $this->findModel($site_id, $kpi_id, $tanggal, $grade_id)->delete();

        return $this->redirect(['index']);
    }*/

    /**
     * Finds the InputDaily model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $site_id
     * @param integer $kpi_id
     * @param string $tanggal
     * @param integer $grade_id
     * @return InputDaily the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($site_id, $kpi_id, $tanggal, $grade_id)
    {
        if (($model = InputDaily::findOne(['site_id' => $site_id, 'kpi_id' => $kpi_id, 'tanggal' => $tanggal, 'grade_id' => $grade_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
