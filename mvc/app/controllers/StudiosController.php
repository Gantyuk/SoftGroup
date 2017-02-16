<?php

namespace app\controllers;

use app\models\Studio;
use app\models\Address;
use vender\core\base\Controller;

class StudiosController extends Controller
{
    public function index()
    {
        $model = new Studio();
        if (isset($_POST['delet']) && !empty($_POST['delet']) && is_numeric($_POST['delet'])) {
            $model->DeletId($_POST['delet'], "studio");
            header('Location: /mvc/studios/index?del=' . $_POST['delet']);
            exit();
        }
        if (isset($_GET['add'])):
            $alert = "Студію '{$_GET['add']}'  додано!!!";
        elseif (isset($_GET['del']) && !empty($_GET['del'])):
            $alert = "Студію №={$_GET['del']}  Видалено!!!";
        else:
            $alert = "";
        endif;

        $studio = $model->Display_Studio();
        $this->setVars(compact("studio", "alert"));
        $this->getView();
    }

    public function add()
    {
        $nameErr = $contactErr = $stretErr = $_indexErr = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['name'])) {
                $nameErr = "Помилка в полі Назва";
            } elseif (empty($_POST['contact'])) {
                $contactErr = "Помилка в полі Контакт";
            } elseif (empty($_POST['street'])) {
                $stretErr = "Помилка в полі Вулиця";
            } elseif (empty($_POST['_index']) || !is_numeric($_POST['_index']) || $_POST['_index'] < 0) {
                $_indexErr = "Помилка в полі  Індех";
            } else {
                $address = new Address();
                $address->setIdTown($_POST['town']);
                $address->setStreet($_POST['street']);
                $address->setIndex($_POST['_index']);
                $address->setIdCountries($_POST['countries']);
                $studio = new Studio();
                $studio->setNameStudio($_POST['name']);
                $studio->setContact($_POST['contact']);
                $studio->setIdAddress($address->Add());
                $studio->Add();
                header('Location: /mvc/studios/index?add=' . $studio->getNameStudio());
                exit();
            }
        }
        $model = new Studio();
        $countries = $model->Select("id,countries", "countries");
        $town = $model->Select("id,town", "town");
        $this->setVars(compact("countries", "town", "nameErr", "contactErr", "stretErr", "_indexErr"));
        $this->getView();
    }


}

?>