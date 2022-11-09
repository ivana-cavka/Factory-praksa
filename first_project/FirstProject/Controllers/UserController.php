<?php
namespace FirstProject\Router\Controllers;
use FirstProject\Model\User\User;

/* jos jedan sloj izmedju rutera i viewa, tj controller. 
Onda umjesto require user.php bi imala controller koji instanciras i pozivas neku metodu iz controllera.
Recimi da imas UserController sa crud metodama(unutar svake metode se samo poziva operacija nad modelom 
sa odgovarajucim podacima). Trebaš napraviti da možeš odabrati koji controller i koju metodu pozvati kad si na odredjenoj ruti. 
Nebi vise imala router->add(ruta, imeFilea) vec router->add(ruta, controller, akcija).  */
class UserController {
    private User $user;

    public static function getUsers() {
        return self::$user->getAll();
    }

    public function getUserById($id) {
        return self::$user->getById($id);
    }

    public function deleteUser() {
        return self::$user->delete();
    }
}