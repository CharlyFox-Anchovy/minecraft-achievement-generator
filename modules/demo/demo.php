<?php defined('CS__BASEPATH') OR exit('No direct script access allowed');
/**
 *
 *    CubSystem Minimal
 *      -> http://github.com/Anchovys/cubsystem/minimal
 *    copy, © 2020, Anchovy
 * /
 */

class module_demo extends CsModule
{
    /**
     * Действия при загрузке модуля.
     * @return bool
     */
    public function onLoad()
    {
        /*
            Здесь может быть любой код,
            выполняющийся при загрузке
            этого модуля.

            Если нужно отменить загрузку
            модуля, можно вернуть FALSE.
        */

        // Возвращаем это, чтобы показать системе,
        // что модуль успешно загружен
        return parent::onLoad();
    }

    public function onUnload()
    {

        /*
            Напишите здесь любой код,
            который должен выполняться
            при выгрузке этого модуля
            (системой).

            Если вы хотите показать системе,
            что выгрузка была некорректна,
            верните FALSE.
        */

        // Возвращаем это, чтобы показать системе,
        // что модуль успешно выгружен
        return parent::onUnload();
    }

    public function onEnable()
    {
        /*
            Этот код будет выполнен
            при включении этого модуля.
            Например, через админ-панель.

            Можно вернуть FALSE.
        */

        // Возвращаем это, чтобы показать системе,
        // что модуль успешно включен
        return parent::onEnable();
    }

    public function onDisable()
    {
        /*
            Этот код будет выполнен
            при выключении этого модуля.
            Например, через админ-панель.

            Можно вернуть FALSE.
        */

        // Возвращаем это, чтобы показать системе,
        // что модуль успешно отключен
        return parent::onDisable();
    }

    public function onPurge()
    {
        /*
            Этот код будет выполнен
            при очистке данных этого
            модуля.

            Другими словами, при
            деинсталляции модуля.

            Можно вернуть FALSE.
        */

        // Возвращаем это, чтобы показать системе,
        // что данные модуля очищены
        return parent::onPurge();
    }
}