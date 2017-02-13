<?php

    namespace app\controllers;
    use app\models\Directors;
    use vender\core\base\Controller;

class DirectorsController extends Controller
{
    public function index()
    {
        $model = new Directors();
        if(	isset($_POST['delet']) && !empty($_POST['delet']) && is_numeric($_POST['delet'])){
            $model->DeletId($_POST['delet'],"directors");
            header ('Location: /mvc/directors/index?del='. $_POST['delet']);
            exit();
        }
        if (isset($_GET['add'])):
            $alert = "Режисера '{$_GET['add']}'  додано!!!";
        elseif (isset($_GET['del']) && !empty($_GET['del'])):
            $alert = "Режисера №={$_GET['del']}  Видалено!!!";
        else:
            $alert ="";
        endif;

        $directors = $model->Display_Directors();
        $this->setVars(compact("directors","alert"));
    }
    public function add()
    {
        if(
            isset($_POST['s_name']) && !empty($_POST['s_name']) &&
            isset($_POST['l_name']) && !empty($_POST['l_name']) &&
            isset($_POST['y_birth']) && !empty($_POST['y_birth']) && is_numeric($_POST['y_birth']) &&
            isset($_POST['countries']) && !empty($_POST['countries'])
        ){
            $directors = new Directors();
            $directors->setSName($_POST['s_name']);
            $directors->setLName($_POST['l_name']);
            $directors->setYBirth($_POST['y_birth']);
            $directors->setYDeath($_POST['y_death']);
            $directors->setIdContries($_POST['countries']);
            if ($directors->getYBirth() >= 1400 && $directors->getYBirth() <= date('Y')){
                $directors->Add();
                header ('Location: /mvc/directors/index?add=' . $directors->getSName());
                exit();
            }
        }
        $model = new Directors();
        $countries = $model->Select("id,countries" ,"countries");
        $this->setVars(compact("countries"));
    }


}
    