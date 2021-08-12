<?php
loadModel('User');

class Login extends Model {

  public function validate() {
    $errors = [];
    
    if(!$this->email) {
      $errors['email'] = 'Email is a required field.';
    }

    if(!$this->password) {
      $errors['password'] = 'Please type the password.';
    }

    if(count($errors) > 0) {
      throw new ValidationException($errors);
    }
  }

  public function checkLogin() {
    $this->validate();
    $user = User::getOne(['email' => $this->email]);
    if($user) {
      if($user->end_date) {
        throw new AppException('The user no longer works here.');
      }
      if(password_verify($this->password, $user->password)) {
        return $user;
      }
    }
    throw new AppException('Invalid user and/or password.');
  }
}