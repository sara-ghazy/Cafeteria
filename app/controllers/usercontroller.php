<?php

namespace CAFETERIA\CONTROLLERS;
use CAFETERIA\LIB\FrontController;
use CAFETERIA\MODELS\UserModel;

class UserController extends AbstractController
{
    private $_validationRoles=
        [
        'name'          => 'req|alpha|min(3)',
        'password'      => 'req|min(6)|eq_field(confirm_password)',
        'confirm_password'     => 'req|min(6)',
        'email'         => 'req|email',
        'room'          => 'req|int',
        'ext'           => 'req|int'
    ];
    private $_editRoles=
        [
            'name'          => 'req|alpha|min(3)',
            'email'         => 'req|email',
            'room'          => 'req|int',
            'ext'           => 'req|int'
        ];

    //all users
    function defaultAction()
    {
       $this->data['users']=UserModel::getAll();
        $this->_view();

    }



    function addAction()
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
                    $emailExists=UserModel::isEmailExists($_POST['email']);
                    if(!$emailExists)
                    {
                        $user=new UserModel();
                        $user->name=$_POST['name'];
                        $user->password=$_POST['password'];
                        $user->email=$_POST['email'];
                        $user->room=$_POST['room'];
                        $user->ext=$_POST['ext'];
                        $user->imgUrl=$imgUrl;
                        if($user->save())
                        {
                            header("location: /user");
                            exit;
                        }
                    }
                    $this->data['error_email'] = "* Email is already exist.";
                }
            $this->data['errors']=$errors;
            $this->data['old']=$_POST;
            }
        $this->_view();
    }



    ///////////////////////edit//////////


    public function editAction()
    {
        $id=$this->filterInt($this->params[0]);
        $user=UserModel::getByKey($id);
        if($user)
        {
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $errors=$this->isValid($this->_editRoles,$_POST);
                if(!$errors)
                {
                    $emailExists=UserModel::isEmailExists($_POST['email']);
                    var_dump($emailExists,$user->email);
                    if($emailExists['email']===$user->email||!$emailExists)
                    {
                        $user->name=$_POST['name'];
                        $user->email=$_POST['email'];
                        $user->room=$_POST['room'];
                        $user->ext=$_POST['ext'];
                        if($user->save())
                        {
                            header('location:/user');
                        }
                    }
                    $this->data['error_email'] = "* Email is already exist.";
                }
                $this->data['old']=$_POST;
                $this->data['errors']=$errors;
            }
            $this->data['user']=$user;
            $this->_view();
        }else
        {
            header('location:/notfound');
        }

    }


    ////////////delete//////////////////////////


    function deleteAction()
    {
        $id=filter_var($this->params[0],FILTER_SANITIZE_NUMBER_INT);

       $data=UserModel::getByKey($id);
       if($data)
       {
           if($data->delete())
           {
            header("location: /user");
            exit;

           }
         
       }


    }
    


}



?>