<?php
    
    namespace app\controllers;

use app\models\Main;
use vender\core\base\Controller;

class MainController extends Controller
{
    public function index()
    {
        $model = new Main();
        if(	isset($_POST['delet']) && !empty($_POST['delet']) && is_numeric($_POST['delet'])){
            $model->DeletId($_POST['delet'],"movies");
            header ('Location: /mvc/main/index?del='. $_POST['delet']);
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
                $alert ="";
        endif;
        $this->setVars(compact("movi", "alert"));

    }

    public function autor(){ }
    
    public function add(){
        $model = new Main();
        if(
            isset($_POST['directors']) && !empty($_POST['directors']) &&
            isset($_POST['name']) && !empty($_POST['name']) &&
            isset($_POST['duration']) && !empty($_POST['duration']) && is_numeric($_POST['duration']) &&
            isset($_POST['year']) && !empty($_POST['year']) && is_numeric($_POST['year']) &&
            isset($_POST['budjet']) && !empty($_POST['budjet']) && is_numeric($_POST['budjet']) &&
            isset($_POST['genres']) && !empty($_POST['genres']) &&
            isset($_POST['date']) && !empty($_POST['date']) &&
            isset($_POST['studion']) && !empty($_POST['studion'])
        ){
            $movi = new Main();
            $movi->setIdDirectors( $_POST['directors']);
            $movi->setName($_POST['name']);
            $movi->setDuration($_POST['duration']);
            $movi->setYear($_POST['year']);
            $movi->setBiudjet($_POST['budjet']);
            $movi->setIdGenres($_POST['genres']);
            $movi->setDate($_POST['date']);
            $movi->getDate();
            $movi->setIdStudio($_POST['studion']);
            if ($movi->getYear() >= 1400 && $movi->getYear() <= date('Y') && $movi->getDuration() > 0 && $movi->getBiudjet() > 0){
                $movi->Add();
                header ('Location: /mvc/main/index?add=' . $movi->getName());
                exit();
            }
            else { ?>
                <h3>Не коректні дані</h3>
            <?php	}
        }
        $directors = $model->Select("id,L_Name" ,"directors");
        $genres = $model->Select("id,genres" , "genres");
        $studio = $model->Select("id,Name_studio" , "studio");
        $this->setVars(compact("directors", "genres", "studio"));
    }

    public function search()
    {
        $model = new Main();
        $movi = [];

        if(isset($_POST['studion']) && !empty($_POST['studion'])) {
            $movi = $model->Search("s.id", $_POST['studion']);
        }

        if(isset($_POST['directors']) && !empty($_POST['directors'])) {
            $movi = $model->Search("d.id", $_POST['directors']);
        }

        if(isset($_POST['search']) && !empty($_POST['search']) && isset($_POST['search_str']) && !empty($_POST['search_str'])) {
            $movi = $model->SearchLike($_POST['search'], $_POST['search_str']);
        }

        $directors = $model->Select("id,L_Name" ,"directors");
        $studio = $model->Select("id,Name_studio" , "studio");

        $this->setVars(compact("directors", "studio", "movi"));
        
    }
}
?>
