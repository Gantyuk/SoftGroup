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
        if(	isset($_POST['delet']) && !empty($_POST['delet']) && is_numeric($_POST['delet'])){
            $model->DeletId($_POST['delet'],"studio");
            header ('Location: /mvc/studios/index?del='. $_POST['delet']);
            exit();
        }
        if (isset($_GET['add'])):
            $alert = "Студію '{$_GET['add']}'  додано!!!";
        elseif (isset($_GET['del']) && !empty($_GET['del'])):
            $alert = "Студію №={$_GET['del']}  Видалено!!!";
        else:
            $alert ="";
        endif;

        $studio = $model->Display_Studio();
        $this->setVars(compact("studio","alert"));
    }
    public function add()
    {
        if(
		isset($_POST['name']) && !empty($_POST['name']) &&
		isset($_POST['contact']) && !empty($_POST['contact']) &&
		isset($_POST['town']) && !empty($_POST['town']) &&
		isset($_POST['street']) && !empty($_POST['street']) &&
		isset($_POST['_index']) && !empty($_POST['_index']) && is_numeric($_POST['_index']) &&
		isset($_POST['countries']) && !empty($_POST['countries'])

	){
		$address = new Address();
		$address->setIdTown($_POST['town']);
		$address->setStreet($_POST['street']);
		$address->setIndex($_POST['_index']);
		$address->setIdCountries($_POST['countries']);
		$studio = new Studio();
		$studio->setNameStudio($_POST['name']);
		$studio->setContact($_POST['contact']);
		if ($address->getIndex() > 0) {
            $studio->setIdAddress($address->Add());
			$studio->Add();
            header ('Location: /mvc/studios/index?add=' . $studio->getNameStudio());
            exit();
        }else { ?>
            <h3>Не коректні дані</h3>
        <?php	}
		}
        $model = new Studio();
        $countries = $model->Select("id,countries" ,"countries");
        $town = $model->Select("id,town" , "town");
        $this->setVars(compact("countries", "town"));
    }


}
    