<?php


namespace App\Presenters;

use Nette;
use Tracy\Debugger;
use Nette\Security\User;
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
        Debugger::barDump($values);

        try {
            $this->getUser()->login($values->username, $values->password);

            $this->redirect('Homepage:default');
            $this->flashMessage('Byl jste úspěšně prihlasen. ' . $values->username);

        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError('Špatný jméno nebo heslo.');
        }
    }
}