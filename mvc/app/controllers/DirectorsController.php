<?php

namespace app\controllers;

use app\models\Directors;
use vender\core\base\Controller;

class DirectorsController extends Controller
{
    public function index()
    {
        $model = new Directors();
        if (isset($_POST['delet']) && !empty($_POST['delet']) && is_numeric($_POST['delet'])) {
            $model->DeletId($_POST['delet'], "directors");
            header('Location: /mvc/directors/index?del=' . $_POST['delet']);
            exit();
        }
        if (isset($_GET['add'])):
            $alert = "Режисера '{$_GET['add']}'  додано!!!";
        elseif (isset($_GET['del']) && !empty($_GET['del'])):
            $alert = "Режисера №={$_GET['del']}  Видалено!!!";
        else:
            $alert = "";
        endif;

        $directors = $model->Display_Directors();
        $this->setVars(compact("directors", "alert"));
        $this->getView();
    }

    public function add()
    {
        $S_nameErr = $L_nameErr = $y_deathErr = $y_birthErr = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['l_name'])) {
                $L_nameErr = "Помилка в полі Ім'я";
            } elseif (empty($_POST['s_name'])) {
                $S_nameErr = "Помилка в полі Прізвища";
            } elseif (empty($_POST['y_birth']) || !is_numeric($_POST['y_birth']) || $_POST['y_birth'] < 1400 || $_POST['y_birth'] >= date('Y')) {
                $y_birthErr = "Помилка в полі Рік народження";
            } else {
                $directors = new Directors();
                $directors->setSName($_POST['s_name']);
                $directors->setLName($_POST['l_name']);
                $directors->setYBirth($_POST['y_birth']);
                $directors->setIdContries($_POST['countries']);
                if (!empty($_POST['y_death'])) {
                    if (!is_numeric($_POST['y_death']) || $_POST['y_death'] < 1400 || $_POST['y_death'] >= date('Y')):
                        $y_deathErr = "Помилка в полі Рік смерті";
                    else:
                        $directors->setYDeath($_POST['y_death']);
                        $directors->Add();
                        header('Location: /mvc/directors/index?add=' . $directors->getSName());
                        exit();
                    endif;
                } else {
                    $directors->Add();
                    header('Location: /mvc/directors/index?add=' . $directors->getSName());
                    exit();
                }
            }
        }

        $model = new Directors();
        $countries = $model->Select("id,countries", "countries");
        $this->setVars(compact("countries", "S_nameErr", "L_nameErr", "y_deathErr", "y_birthErr"));
        $this->getView();
    }
}

?>
    