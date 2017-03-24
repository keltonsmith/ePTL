<?php

namespace App\Http\Controllers\Internal\BUT;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Project;
use App\Models\Application;
use View;
use App\Helpers\Helper;
use PhpOffice\PhpWord;
use App\Models\Payment;

class BaseController extends Controller
{
    /**
     * Navbar
     * @var array
     */
    public $navbar;

    /**
     * InboxController constructor.
     */
    public function __construct()
    {
        $this->navbar = [
            [
                'title' => trans('but.application.title'),
                'href' => route('internal.but.application.index'),
                'count' => Notification::BUT()->count(),
                'icon' => 'zmdi-layers'
            ],
            [
                'title' => trans('but.project.title'),
                'href' => route('internal.but.project.index'),
                'count' => Project::BUT()->count(),
                'icon' => 'zmdi-layers'
            ]
        ];
        View::share('navbar', $this->navbar);
    }

    /**
     * @param Project $project
     * @param Application $application
     * @return array
     */
    public static function getDocuments(Project $project, Application $application)
    {
        $documents = collect($application->documents);
        $documents = $documents->merge($project->documents);
        return $documents;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function documentUpload(Request $request)
    {
        if ($request->hasFile('document')) {
            $project = Project::findOrFail($request->project_id);
            $storagePath = storage_path(
                'app\application\\'.$project->application->id);
            $title = str_slug($request->title) . '.' . $request->document->extension();
            $request->file('document')->move(
                $storagePath,
                $title
            );

            $document = [
                $request->title => $title
            ];

            $project->documents = $project->documents->merge($document)->toArray();
            $project->save();
            return redirect()->back();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function downloadAsDocFile(Request $request, $project_id)
    {
        $project = Project::findorFail($project_id);

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection();

        $section->addText('                                                                                                     BIL. KERTAS	:', array('name' => 'Arial', 'size' => 12,
            'bold' => true));
        $section->addText('                                                                                                     AGENDA          :', array('name' => 'Arial', 'size' => 12,
            'bold' => true));
        $section->addText(
            'PERKARA        :   '.$project->project_title, array('name' => 'Arial', 'size' => 12)
        );

        $section->addText(
            'SEKSYEN        :   '.$project->application->highway->name, array('name' => 'Arial', 'size' => 12)
        );

        $section->addText(
            'PEMOHON       :   '.$project->application->user->details->name, array('name' => 'Arial', 'size' => 12)
        );

        $section->addText(
            'TARIKH            :   '.$project->created_at->format('jS F Y'), array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            'PERMOHONAN', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            'NO.RUJUKAN   :   '.$project->application->app_id, array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            'PERMOHONAN', array('name' => 'Arial', 'size' => 12)
        );

        $section->addText(
            '__________________________________________________________', array('name' => 'Arial', 'size' => 12, 'alignment' => 'center')
        );
        $section->addText(
            'A)	ULASAN PENGARAH WILAYAH TENGAH	        	    DITERIMA : 01/01/2017', array('name' => 'Arial', 'size' => 12, 'bold' => true)
        );
        $section->addText(
            'PWT telah mengemukakan ulasan dan pandangan teknikal. ', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            'B)	ULASAN SYARIKAT KONSESI                                        DITERIMA : 01/01/2017    ', array('name' => 'Arial', 'size' => 12, 'bold' => true)
        );
        $section->addText(
            'Syarikat konsesi lebuhraya telah mengemukakan ulasan dan pandangan teknikal.', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            'C)	CADANGAN URUSETIA BERKAITAN CAJ PEMPROSESAN DAN BAYARAN PERKHIDMATAN', array('name' => 'Arial', 'size' => 12, 'bold' =>true)
        );
        $section->addText(
            'i.	Caj pemprosesan            : RM 3,000.00', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            'ii.	Bayaran Perkhidmatan   : RM 3,000.00', array('name' => 'Arial', 'size' => 12)
        );

        $section->addText(
            'D)	ULASAN / RUMUSAN 	', array('name' => 'Arial', 'size' => 12, 'bold' => true)
        );
        $section->addText(
            'Permohonan dicadangkan untuk pertimbangan dan keputusan Jawatankuasa.', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            'E)	KEPUTUSAN MESYUARAT', array('name' => 'Arial', 'size' => 12, 'bold' => true)
        );

        /*
         * Note: it's possible to customize font style of the Text element you add in three ways:
         * - inline;
         * - using named font style (new font style object will be implicitly created);
         * - using explicitly created font style object.
         */

// Adding Text element with font customized inline...
//        $section->addText(
//            '"Great achievement is usually born of great sacrifice, '
//            . 'and is never the result of selfishness." '
//            . '(Napoleon Hill)',
//            array('name' => 'Tahoma', 'size' => 10)
//        );

// Adding Text element with font customized using named font style...
//        $fontStyleName = 'oneUserDefinedStyle';
//        $phpWord->addFontStyle(
//            $fontStyleName,
//            array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
//        );
//        $section->addText(
//            '"The greatest accomplishment is not in never falling, '
//            . 'but in rising again after you fall." '
//            . '(Vince Lombardi)',
//            $fontStyleName
//        );
//
//// Adding Text element with font customized using explicitly created font style object...
//        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
//        $fontStyle->setBold(true);
//        $fontStyle->setName('Tahoma');
//        $fontStyle->setSize(13);
//        $myTextElement = $section->addText('"Believe you can and you\'re halfway there." (Theodor Roosevelt)');
//        $myTextElement->setFontStyle($fontStyle);

// Saving the document as OOXML file...
//        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $phpWord->save($project->application->app_id.'.docx', 'Word2007', true);
    }

    public function kkrDownloadAsDocFile(Request $request, $project_id)
    {
        $project = Project::findorFail($project_id);

        $payment = Payment::where('application_id', $project->application_id)->first();

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection();

        $section->addText(
            'PERMOHONAN PEMBANGUNAN DI TEPI LEBUHRAYA', array('name' => 'Arial', 'size' => 12, 'bold' => true), array('alignment' => 'center')
        );
        $section->addText(
            'OLEH PIHAK KETIGA', array('name' => 'Arial', 'size' => 12, 'bold' => true), array('alignment' => 'center')
        );
        $section->addText(
            $project->application->highway->name.$project->application->highway->code, array('name' => 'Arial', 'size' => 12, 'bold' => true), array('alignment' => 'center')
        );
        $section->addText(
            '1.0      Tujuan  :     ', array('name' => 'Arial', 'size' => 12, 'bold' => true)
        );
        $section->addText(
            $project->project_title.' ~  '.$payment->development_detail->name, array('name' => 'Arial', 'size' => 12)
        );

        $section->addText(
            '2.0    Kuasa  :    ', array('name' => 'Arial', 'size' => 12, 'bold' => true)
        );
        $section->addText(
            'Kuasa Mengawal Pembangunan Yang Melibatkan Rezab lebuhraya.
-	Bidangkuasa ini adalah diperuntukan kepada YB Menteri Kerja Raya Malaysia didalam Road Transport Act 1987 (Act 333) Seksyen 84, 85, dan 85A.  Ini bermakna Y.B Menteri Kerjaraya Malaysia mempunyai kuasa untuk meluluskan atau menolak segala permohonan di tepi lebuhraya dan pemasangan paparan iklan yang melibatkan Jalanraya Persekutuan.
', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            '3.0	Latarbelakang	', array('name' => 'Arial', 'size' => 12, 'bold' => true)
        );
        $section->addText(
            '       Pemohon	:   '.$project->application->user->details->name, array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            '       Lokasi		:   '.'KM '.$project->application->location, array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            '       No. Rujukan  : '.$project->application->app_id, array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            '3.1	Permohonan ini adalah cadangan jalan sambung keluar/masuk dari jalan susur ke Plaza Tol Ampang Lebuhraya Lembah Kelang Timur (EKVE) ', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            '4.0	Ulasan East Kelang Valley Expressway.', array('name' => 'Arial', 'size' => 12, 'bold' => true)
        );
        $section->addText(
            '4.1	Pihak East Kelang Valley Expressway  telah mengemukakan ulasan melalui surat ruj: EKVE/2/2.2/LLM/397/16 bertarikh 06/09/2016.', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            '5.0	Ulasan Lembaga Lebuhraya Malaysia', array('name' => 'Arial', 'size' => 12, 'bold' => true)
        );
        $section->addText(
            '5.1	Pihak Lembaga Lebuhraya Malaysia telah menimbang permohonan ini dan tiada halangan dengan cadangan tersebut. Walaubagamanapun, ianya tertakluk kepada syarat-syarat berikut:-', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            '       i.	Pemohon akan dikenakan bayaran pemprosesan dan bayaran perkhidmatan.', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            '       ii.	Pemohon/Juruperunding adalah diminta mengemukakan ‘Road Safety Audit Report’ stage 2 and 3 dan juga memberi pengesahan kepada LLM bahawa rekabentuk jalan keluar/masuk ke tapak pembangunan tersebut adalah selamat dan tidak menjejaskan keselamatan dan keselesaan pengguna-pengguna lebuhraya.', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            '       iii.	Pemohon adalah dipertanggungjawabkan sepenuhnya ke atas apa jua perkara- perkara yang berlaku yang melibatkan tuntutan oleh pengguna-pengguna/orang awam di kawasan jalan keluar/masuk tersebut. Pihak LLM tidak bertanggungjawab ataupun dipertanggungjawabkan dari sebarang tuntutan/dakwaan ke atas masalah yang timbul disebabkan jalan keluar/masuk tersebut semasa pembinaan dan selepas siap pembinaan. ', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            '       iv.	Lain-lain syarat teknikal berkaitan cadangan ini akan ditentukan kelak.', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            '6.0	Syor', array('name' => 'Arial', 'size' => 12, 'bold' => true)
        );
        $section->addText(
            '6.1	Jawatankuasa Pembangunan Di Tepi Lebuhraya, Lembaga Lebuhraya Malaysia telah membincangkan dan Menyokong / Tidak Menyokong permohonan ini diberikan kelulusan.', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            'Sekian, untuk keputusan Y. Bhg. Dato’, terima kasih.', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            '(DATO’ IR. HAJI ISMAL BIN MD SALLEH)', array('name' => 'Arial', 'size' => 12, 'bold' => true)
        );
        $section->addText(
            'Ketua Pengarah', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            'Lembaga Lebuhraya Malaysia       ', array('name' => 'Arial', 'size' => 12)
        );
        $section->addText(
            'Tarikh :          /12/2016', array('name' => 'Arial', 'size' => 12)
        );

//        $document = $phpWord->loadTemplate('templates.docx');
//
//        $document->saveAs('temp.docx'); // Save to temp file
//        $phpWord = \PhpOffice\PhpWord\IOFactory::load('temp.docx');
//        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
//        $objWriter->save('helloWorld.docx');

        $phpWord->save($project->application->app_id.'.docx', 'Word2007', true);
    }

    public function postReview(Request $request)
    {
        $project = Project::findOrFail($request->project_id);
        $files = $request->file('files');
        if ($request->hasFile('files')) {

            $document = [
                'meeting' => 'meeting'
            ];

            $project->documents = $project->documents->merge($document)->toArray();
            $project->save();
        }
        $path = Helper::generatePath($project->application->id);
        $tpfileLists = [];

        foreach($files as $file) {
            if ($file != null) {
                $save_file = $file->getClientOriginalName();
                $file->move($path, time() . $save_file);
                $tpfileLists []= time() . $save_file;
            }
        }
//        $jsonFileList = json_encode($tpfileLists);
        $meeting = [
            'no'        => $request->input('no'),
            'review'    => $request->input('review'),
            'status'    => $request->input('status'),
            'document'  => $tpfileLists,
        ];
        $project->meeting = $meeting;
        $project->save();
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postKKR(Request $request)
    {
        $project = Project::findOrFail($request->project_id);
        $files = $request->file('files');
        if ($request->hasFile('files')) {


            $document = [
                'kkr' => 'kkr'
            ];

            $project->documents = $project->documents->merge($document)->toArray();
            $project->save();
        }

        $path = Helper::generatePath($project->application->id);
        $tpfileLists = [];

        foreach($files as $file) {
            if ($file != null) {
                $save_file = $file->getClientOriginalName();
                $file->move($path, time() . $save_file);
                $tpfileLists []= time() . $save_file;
            }
        }

        $kkr = [
            'status'    => $request->input('kkr-status'),
            'feedback'    => $request->input('feedback'),
            'document'  => $tpfileLists
        ];
        $project->kkr = $kkr;
        $project->save();
        return redirect()->back();
    }
}