<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use View;
use Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\Form;
use App\Models\Agama;
use Illuminate\Support\Facades\Session;
use App\Helpers\FormHelper;
use App\Helpers\LocationHelper;
use App\DAO\FormDAO;
use App\DAO\PelaporDAO;
use App\DAO\AnakDAO;
use App\DAO\ContactPersonDAO;
use App\Models\Anak;

/**
 * Description of AnakController
 *
 * @author nunenuh
 */
class AnakController extends BaseController {

    public function view() {
        $data = [
            'title' => '',
            'page_title' => 'Anak',
            'panel_title' => 'Table View',
            'location' => 'view',
            'table' => Anak::orderBy('created_at','desc')->get(),
        ];
        return View::make('anak.view', $data);
    }

    public function detailView($id) {
        $data = [
            'page_title' => 'Anak',
            'panel_title' => 'Detail View',
            'location' => 'view',
            'data' => Anak::where('id', '=', $id)->first(),
        ];
        return View::make('anak.detail', $data);
    }

    public function updateView($id) {
        $anak = Anak::find($id);
        $data = [
            'page_title' => 'Anak',
            'panel_title' => 'Form Edit',
            'form_url' => '/dash/anak/update',
            'form_status' => 'edit',
            'location_anak' => LocationHelper::location($anak->desa->id),
            'agama_lists' => Agama::lists('nama', 'nama'),
            'record' => Form::find($id),
        ];
        return View::make('anak.form', $data);
    }

    public function update() {
        $an = Input::get('anak');
        $anak = AnakDAO::saveOrUpdate($an);
        Session::flash('message', "Anak with Nama $anak->nama has been updated!");
        return Redirect::to('/dash/anak');
    }

    public function delete($id) {
        $anak = Anak::find($id);

        $form = $anak->form;
        foreach ($form as $fm) {
            FormDAO::delete($fm->id);
        }

        $pendampingan = $anak->pendampingan;
        if ($pendampingan){
          foreach($pendampingan as $pen){
            PendampinganDAO::delete($pen->id);
          }
        }

        $files = $anak->files;
        if ($files){
          foreach($files as $fl){
            FilesDAO::delete($fl->id);
          }
        }

        $pelapor = $anak->pelapor->first();
        if ($pelapor) $pelapor->delete();

        $sumber = $anak->sumber_informasi->first();
        if ($sumber) $sumber->delete();

        $keluarga = $anak->keluarga;
        if ($keluarga) $keluarga->delete();

        $fisik = $anak->gambaran_fisik;
        if ($fisik) $fisik->delete();

        $identifikasi = $anak->identifikasi_masalah;
        if ($identifikasi) $identifikasi->delete();

        $psiko = $anak->kondisi_psikososial;
        if ($psiko) $psiko->delete();

        $contact = $anak->contact_person;
        if ($contact) $contact->delete();

        $nama_anak = $anak->nama;
        $anak->delete();
        if ($anak) {
            Session::flash('message', "Anak dengan Nama $nama_anak been deleted!");
        } else {
            Session::flash('message', "Error, Anak dengan Nama $nama_anak tidak ditemukan!");
        }
        return Redirect::to('/dash/anak');
    }

    public function search() {
        $keyword = Input::get('keyword');
        $filter = Input::get('filter');

        $result = Anak::orderBy('created_at', 'desc');

        if ($keyword != NULL) {
            if ($filter == "kode" || $filter == NULL) {
                $result = $result->where('id', '=', $keyword);
            } else if ($filter == "anak") {
                $result = $result->where('nama', 'LIKE', '%' . $keyword . '%');
            } else if ($filter == "gender") {
                $result = $result->where('gender', 'LIKE', '%' . $keyword . '%');
            } else if ($filter == "jenis") {
                $result = $result->whereHas('jeniskasus', function($qp) use ($keyword) {
                    $qp->where('jenis_kasus.jenis', 'LIKE', '%' . $keyword . '%');
                });
            }
        }

        $data = [
            'title' => '',
            'page_title' => 'Anak',
            'panel_title' => 'Search View',
            'location' => 'search',
            'table' => $result->paginate(10),
        ];
        return View::make('anak.view', $data);
    }

}
