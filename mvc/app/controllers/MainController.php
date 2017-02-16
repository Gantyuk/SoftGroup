<?php

namespace app\controllers;

use app\models\Main;
use vender\core\base\Controller;

class MainController extends Controller
{
    public function index()
    {
        $model = new Main();
        if (isset($_POST['delet']) && !empty($_POST['delet']) && is_numeric($_POST['delet'])) {
            $model->DeletId($_POST['delet'], "movies");
            header('Location: /mvc/main/index?del=' . $_POST['delet']);
            exit();
        }
        if (isset($_POST['sort'])):
            $movi = $model->order($_POST['sort']);
        else: $movi = $model->Display_Muvies();
        endif;

        if (isset($_GET['add'])):
            $alert = "Фільм {$_GET['add']}  додано!!!";
        elseif (isset($_GET['del']) && !empty($_GET['del'])):
            $alert = "Фільм №={$_GET['del']}  Видалено!!!";
        else:
            $alert = "";
        endif;
        $this->setVars(compact("movi", "alert"));
        $this->getView();
    }

    public function autor()
    {
        $this->getView();
    }

    public function add()
    {
        $model = new Main();
        $nameErr = $durationErr = $yearErr = $budjetErr = $dateErr = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['name'])) {
                $nameErr = "Помилка в полі Назва";
            } elseif (empty($_POST['duration']) || !is_numeric($_POST['duration']) || $_POST['duration'] < 0) {
                $durationErr = "Помилка в полі Тривальсть";
            } elseif (empty($_POST['year']) || !is_numeric($_POST['year']) || $_POST['year'] < 1400 || $_POST['year'] > date('Y')) {
                $yearErr = "Помилка в полі Рік";
            } elseif (empty($_POST['budjet']) || !is_numeric($_POST['budjet']) || $_POST['budjet'] < 0) {
                $budjetErr = "Помилка в полі Бюджет";
            } elseif (empty($_POST['date'])) {
                $dateErr = "Помилка в полі Дата";
            } else {
                $movi = new Main();
                $movi->setIdDirectors($_POST['directors']);
                $movi->setName($_POST['name']);
                $movi->setDuration($_POST['duration']);
                $movi->setYear($_POST['year']);
                $movi->setBiudjet($_POST['budjet']);
                $movi->setIdGenres($_POST['genres']);
                $movi->setDate($_POST['date']);
                $movi->setIdStudio($_POST['studion']);
                $movi->Add();
                header('Location: /mvc/main/index?add=' . $movi->getName());
                exit();
            }
        }
        $directors = $model->Select("id,L_Name", "directors");
        $genres = $model->Select("id,genres", "genres");
        $studio = $model->Select("id,Name_studio", "studio");
        $this->setVars(compact("directors", "genres", "studio", "nameErr", "durationErr", "yearErr", "budjetErr", "dateErr"));
        $this->getView();
    }

    public function search()
    {
        $model = new Main();
        $movi = [];

        if (isset($_POST['studion']) && !empty($_POST['studion'])) {
            $movi = $model->Search("s.id", $_POST['studion']);
        }

        if (isset($_POST['directors']) && !empty($_POST['directors'])) {
            $movi = $model->Search("d.id", $_POST['directors']);
        }

        if (isset($_POST['search']) && !empty($_POST['search']) && isset($_POST['search_str']) && !empty($_POST['search_str'])) {
            $movi = $model->SearchLike($_POST['search'], $_POST['search_str']);
        }

        $directors = $model->Select("id,L_Name", "directors");
        $studio = $model->Select("id,Name_studio", "studio");

        $this->setVars(compact("directors", "studio", "movi"));
        $this->getView();
    }
}

?>
