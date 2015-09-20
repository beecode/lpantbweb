<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use View;
use Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\Form;
use App\Models\TindakLanjut;
use App\Models\JenisKasus;
use App\Models\Agama;
use App\Models\Anak;
use Illuminate\Support\Facades\Session;
use App\DAO\FormDAO,
    App\DAO\JenisKasusDAO,
    App\DAO\AnakDAO;
use Illuminate\Support\Facades\Auth;
use App\Helpers\FormKA7DisposisiHelper;

/**
 * Description of Testerform1Controller
 *
 * @author nunenuh
 */
class FormKA7Controller extends BaseController {

  private $basic = [
    'page_title' => 'Kasus Anak 7 (KA7)',
  ];

  public function view() {
    $year = date('Y');
    $data = [
      'panel_title' => 'Table View',
      'location' => 'view',
      'table'=> Form::where('nama', '=', 'ka7')
                    ->whereRaw('YEAR(`tanggal`) = ?',array($year))
                    ->orderBy('no_lka', 'desc')->get(),
      'selectedYear' => $year,
      'disposisiCount'=>FormKA7DisposisiHelper::count($year),
    ];
    $data = array_merge($data, $this->basic);
    return View::make('formka7.view', $data);
  }

  public function viewMe() {
    $year = date('Y');
    $username = Auth::user()->username;
    $form = Form::where('nama', '=', 'ka7')
                  ->whereRaw('YEAR(`tanggal`) = ?',array($year))
                  ->orderBy('no_lka', 'desc');
    $form->whereHas('user', function ($qa) use ($username) {
      $qa->where('user.username', 'LIKE', '%' . $username . '%');
    });

    $data = [
      'title' => '',
      'panel_title' => 'Table View',
      'location' => 'view',
      'table' => $form->get(),
      'selectedYear' => $year,
      'disposisiCount'=>FormKA7DisposisiHelper::count($year),
    ];
    $data = array_merge($data, $this->basic);
    return View::make('formka7.view', $data);
  }

  public function viewYear() {
    $year = Input::get('year');
    $data = [
      'title' => '',
      'panel_title' => 'Table View',
      'location' => 'view',
      'table'=> Form::where('nama', '=', 'ka7')
                      ->whereRaw('YEAR(`tanggal`) = ?',array($year))
                      ->orderBy('no_lka', 'desc')->get(),
      'selectedYear'=>$year,
      'disposisiCount'=>FormKA7DisposisiHelper::count($year),
    ];
    $data = array_merge($data, $this->basic);
    return View::make('formka7.view', $data);
  }

  public function disposisi(){
    $year = date('Y');
    $dis = FormKA7DisposisiHelper::getDisposisiForm($year);
    $data = [
      'panel_title' => 'Table View',
      'location' => 'disposisi',
      'table'=> $dis,
      'selectedYear' => $year,
      'disposisiCount'=>FormKA7DisposisiHelper::count($year),
    ];
    $data = array_merge($data, $this->basic);
    return View::make('formka7.view', $data);
  }

  public function disposisiYear(){
    $year = Input::get('year');
    $dis = FormKA7DisposisiHelper::getDisposisiForm($year);
    $data = [
      'panel_title' => 'Table View',
      'location' => 'disposisi',
      'table'=> $dis,
      'selectedYear' => $year,
      'disposisiCount'=>FormKA7DisposisiHelper::count($year),
    ];
    $data = array_merge($data, $this->basic);
    return View::make('formka7.view', $data);

  }

    public function preAddView() {
        $data = [
            'page_title' => 'Kasus Anak 7 (KA7)',
            'panel_title' => 'Form Pre Add',
            'form_url' => '/dash/formka7/preadd',
            'form_status' => 'add',
            'jenis_kasus' => JenisKasus::all(),
            'tindak_lanjut' => TindakLanjut::all(),
            'agama_lists' => Agama::lists('nama', 'nama'),
        ];
        return View::make('formka7.preadd', $data);
    }

    public function detailView($id) {
        $data = [
            'page_title' => 'Kasus Anak 7 (KA7)',
            'panel_title' => 'Detail View',
            'location' => 'view',
            'data' => Form::where('nama', '=', 'ka7')->where('id', '=', $id)->first(),
        ];
        return View::make('formka7.detail', $data);
    }

    public function addView($anak_id) {
        $data = [
            'page_title' => 'Kasus Anak 7 (KA7)',
            'panel_title' => 'Form Add',
            'form_url' => '/dash/formka7/add',
            'form_status' => 'add',
            'jenis_kasus' => JenisKasus::all(),
            'tindak_lanjut' => TindakLanjut::all(),
            'agama_lists' => Agama::lists('nama', 'nama'),
            'anak' => Anak::find($anak_id),
            'form'=>Anak::find($anak_id)->form->first(),
        ];
        return View::make('formka7.form', $data);
    }

    public function add() {
        $fm = Input::get('form');
        $an = Input::get('anak');
        $jk = Input::get('jenis_kasus');

        $user = Auth::user();

        // inject lka if not set
        if (!isset($fm['no_lka'])){
          $form = Anak::find($an['id'])->form->first();
          $fm['no_lka']= $form->no_lka;
        }

        // inject tanggal if not set
        if (!isset($fm['tanggal'])){
          $fm['tanggal']=date('Y-m-d');
        }

        $form = FormDAO::saveOrUpdate($fm);
        $anak = Anak::find($an['id']);
        JenisKasusDAO::saveOrUpdate($jk, $anak);
//
//        //save many to many
        $form = Form::find($form->id);
        $form->Anak()->attach($an['id']);
        $form->user()->attach($user->id);

        JenisKasusDAO::attachAll($jk, $anak);

        //notifikasi
        FormKA7DisposisiHelper::addNotif($form->id);

        Session::flash('message', "Form with No LKA $form->no_lka has been added!");
        return Redirect::to('/dash/formka7');
    }

    public function updateView($id) {
        $rec = Form::find($id);
        $anak = $rec->anak->first();
        $data = [
            'page_title' => 'Kasus Anak 7 (KA7)',
            'panel_title' => 'Form Edit',
            'form_url' => '/dash/formka7/update',
            'form_status' => 'edit',
            'record' => Form::find($id),
            'anak' => $anak,
            'jenis_kasus' => JenisKasus::all(),
            'tindak_lanjut' => TindakLanjut::all(),
        ];
        return View::make('formka7.form', $data);
    }

    public function update() {
        $fm = Input::get('form');
        $an = Input::get('anak');
        $jk = Input::get('jenis_kasus');

        // inject lka if not set
        if (!isset($fm['no_lka'])){
          $form = Anak::find($an['id'])->form->first();
          $fm['no_lka']= $form->no_lka;
        }

        // inject tanggal if not set
        if (!isset($fm['tanggal'])){
          $fm['tanggal']=date('Y-m-d');
        }


        $form = FormDAO::saveOrUpdate($fm);
        $anak = Anak::find($an['id']);

//        //save many to many
        $form = Form::find($form->id);
        JenisKasusDAO::attachAll($jk, $anak);
        JenisKasusDAO::saveOrUpdate($jk, $anak);

        //notifikasi
        FormKA7DisposisiHelper::updateNotif($id);

        Session::flash('message', "Form with No LKA $form->no_lka has been updated!");
        return Redirect::to('/dash/formka7');
    }

    public function delete($id) {
      //notifikasi
      FormKA7DisposisiHelper::deleteNotif($id);

      $fm = Form::find($id);
      $anak = $fm->anak->first();
      $forms = $anak->form;

      //delete semua form yang berkaitan
      foreach ($forms as $form) {
        if ($form->nama=="ka7"){
            FormDAO::delete($form->id);
        }
      }

      if ($fm) {
        Session::flash('message', "Form with $id has been deleted!");
      } else {
        Session::flash('message', "Error, Form with $id not found!");
      }
      return Redirect::to('/dash/formka7');
    }

    public function search() {
        $keyword = Input::get('keyword');
        $filter = Input::get('filter');

        $result = Form::where('nama', '=', 'ka7')->orderBy('tanggal', 'asc');

        if ($keyword != NULL) {
            if ($filter == "kode" || $filter == NULL) {
                $result = $result->where('id', '=', $keyword);
            } else if ($filter == "lka") {
                $result = $result->where('no_lka', 'LIKE', '%' . $keyword . '%');
            } else if ($filter == "anak") {
                $result = $result->whereHas('anak', function ($qa) use ($keyword) {
                    $qa->where('anak.nama', 'LIKE', '%' . $keyword . '%');
                });
            } else if ($filter == "jenis") {
                $result = $result->whereHas('anak', function ($qa) use ($keyword) {
                    $qa->whereHas('jeniskasus', function($qp) use ($keyword) {
                        $qp->where('jenis_kasus.jenis', 'LIKE', '%' . $keyword . '%');
                    });
                });
            }
        }

        $data = [
            'title' => '',
            'page_title' => 'Kasus Anak 7 (KA7)',
            'panel_title' => 'Search View',
            'location' => 'search',
            'table' => $result->orderBy('created_at','desc')->get(),
        ];
        return View::make('formka7.view', $data);
    }

}
