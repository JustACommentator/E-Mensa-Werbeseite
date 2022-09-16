<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php'); #was this supposed to be missing?

class ExampleController
{
    public function m4_6a_queryparameter() {
        $vals = [
            'name' => 'Lambert Kehrblech'
        ];
        return view('examples.m4_6a_queryparameter' , $vals);
    }

    public function m4_6b_kategorie() {
        $data = db_kategorie_select_all();

        return view('examples.m4_6b_kategorie', ['kategorie' => $data]);
    }

    public function m4_6c_gerichte() {
        $data = db_gericht_select_all();
        //$data = [];
        $data = array_reverse($data);
        return view('examples.m4_6c_gerichte', ['gericht' => $data]);
    }

    public function m4_6d_layout() {
        $page = ($_GET['no'] ?? 1);
        $gericht = db_gericht_select_all();
        $kategorie = db_kategorie_select_all();
        return view("examples.pages.m4_6d_page_$page", ['page' => $page, 'gericht' => $gericht, 'kategorie' => $kategorie]);
    }
}