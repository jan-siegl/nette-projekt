<?php


namespace App\Presenters;

use Nette;
use Nette\Application\UI;


final class UserPresenter extends Nette\Application\UI\Presenter
{
    //registrace
    protected function createComponentRegistrationForm(): UI\Form
    {
        $form = new UI\Form;
        $form->addText('name', 'Jméno:');
        $form->addPassword('password', 'Heslo:');
        $form->addSubmit('login', 'Registrovat');
        $form->onSuccess[] = [$this, 'registrationFormSucceeded'];
        return $form;
    }

    // po odeslani
    public function registrationFormSucceeded(UI\Form $form, \stdClass $values): void
    {
        // ...
        $this->flashMessage('Byl jste úspěšně registrován.');
        $this->redirect('Homepage:');
    }

    //login
    protected function createComponentLoginForm(): UI\Form
    {
        $form = new UI\Form;
        $form->addText('name', 'Jméno:');
        $form->addPassword('password', 'Heslo:');
        $form->addSubmit('login', 'Prihlasit');
        $form->onSuccess[] = [$this, 'loginFormSucceeded'];
        return $form;
    }

    // po odeslani
    public function loginFormSucceeded(UI\Form $form, \stdClass $values): void
    {
        // ...
        $this->flashMessage('Byl jste úspěšně prihlasen.');
        $this->redirect('Homepage:');
    }
}