<?php

namespace CAFETERIA\CONTROLLERS;

use CAFETERIA\MODELS\CategoryModel;
use CAFETERIA\LIB\FrontController;

class CategoriesController extends AbstractController
{
    private $_validationRoles=[
        'catName' =>'req|min(3)'
    ];

    public function defaultAction()
    {

        $this->data['categories']=CategoryModel::getAll();
        $this->_view();
    }
    public function addAction()
    {

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $errors=$this->isValid($this->_validationRoles,$_POST);

            if(!$errors)
            {
                $cat=new CategoryModel();
                $cat->name=$_POST['catName'];
                if($cat->save())
                {
                    header('location:/categories');
                }
            }
            $this->data['old']=$_POST;
           $this->data['errors']=$errors;
        }
        $this->_view();
    }
    public function editAction()
    {
        $id=$this->filterInt($this->params[0]);
        $cat=CategoryModel::getByKey($id);
        if($cat) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $errors = $this->isValid($this->_validationRoles, $_POST);
                if (!$errors) {
                    $cat->name = $_POST['catName'];
                    if ($cat->save()) {
                        header("location:/categories");
                        exit();
                    }
                }
                $this->data['old'] = $_POST;
                $this->data['errors'] = $errors;
            }
            $this->data['cat'] = $cat;
            $this->_view();
        }
        else {

            header('location:/notfound');

        }

    }
    public function deleteAction()
    {
        $id=$this->filterInt($this->params[0]);
        if($id)
        {
            $cat=CategoryModel::getByKey($id);
            if($cat)
            {
                $cat->delete();
                header('location:/categories');
            }
            else
            {
                $this->setController(FrontController::NOT_FOUND_CONTROLLER);
                $this->_view();
            }
        }
    }

}