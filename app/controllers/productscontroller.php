<?php

namespace CAFETERIA\CONTROLLERS;

use CAFETERIA\LIB\FrontController;
use CAFETERIA\MODELS\CategoryModel;
use CAFETERIA\MODELS\ProductModel;

class ProductsController extends AbstractController
{
    private $_validationRoles=[
        'name' =>'req|min(3)',
        'price' =>'req|int',
        'catId' =>'req|int'
    ];

    public function defaultAction()
    {
        $this->data['categories']=CategoryModel::getAll();
        $this->data['products']=ProductModel::getAll();
        $this->_view();
    }
    public function addAction()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $errors=$this->isValid($this->_validationRoles,$_POST);
            if(!empty($_FILES['imgUrl']['tmp_name']))
            {
                $imgName=$_FILES['imgUrl']['name'];
                $imgTmp=$_FILES['imgUrl']['tmp_name'];
                $imgExt=explode('.',$imgName);
                $imgExt=strtolower($imgExt[1]);
                $extensions= array("jpeg","jpg","png");

                if(in_array($imgExt,$extensions))
                {
                    $imgUrl=file_get_contents($imgTmp);
                }
                else
                {
                    $this->data['image']='Please select valid image';
                    $imgUrl='field';
                }
            }else
            {
                $this->data['image']='Please select image';
                $imgUrl=false;
            }
            if(($imgUrl && $imgUrl!=='field')&&!$errors)
            {
                $product=new ProductModel();
                $product->name=$_POST['name'];
                $product->price=$_POST['price'];
                $product->catId=$_POST['catId'];
                $product->imgUrl=$imgUrl;
                if($product->save())
                {
                    header('location:/products');
                }
            }

            $this->data['old']=$_POST;
            $this->data['errors']=$errors;
        }
        $this->data['categories']=CategoryModel::getAll();
        $this->_view();
    }
    public function editAction()
    {
        $id=$this->filterInt($this->params[0]);
        $product=ProductModel::getByKey($id);
        if($product)
        {
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $errors=$this->isValid($this->_validationRoles,$_POST);

                if(!$errors)
                {
                    $product->name=$_POST['name'];
                    $product->price=$_POST['price'];
                    $product->catId=$_POST['catId'];
                    if($product->save())
                    {
                        header('location:/products');
                    }
                }
                $this->data['old']=$_POST;
                $this->data['errors']=$errors;
            }
            $this->data['categories']=CategoryModel::getAll();
            $this->data['product']=$product;
            $this->_view();
        }else
        {
            header('location:/notfound');
        }

    }
    public function deleteAction()
    {
        $id=$this->filterInt($this->params[0]);
        if($id)
        {
            $product=ProductModel::getByKey($id);
            if($product)
            {
                $product->delete();
                header('location:/products');
            }
            else
            {
                $this->setController(FrontController::NOT_FOUND_CONTROLLER);
                $this->_view();
            }
        }
    }

}