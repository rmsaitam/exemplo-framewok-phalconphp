<?php
use Phalcon\Mvc\Controller;

  class SignupController extends Controller
  {
      public function indexAction()
      {

      }
      public function registerAction()
      {
          $user = new Users();
          $success = $user->save($this->request->getPost(), array("name","email"));
          if($success) {
              echo "Thanks for registering!";
          }
          else {
             echo "Sorry, the follwing problems were generated: ";
             foreach($user->getMessages() as $message) {
                echo $message->getMessage(), "<br/>";
             }
          }  
         $this->view->disable();        
      }

  }
 
?>
