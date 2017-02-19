<?php

namespace Remg\LayoutBundle\Event;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\Event;

class ConfigureMenuEvent extends Event
{
	const FRONTEND_CONFIGURE = 'remg_layout.frontend_menu_configure';
    const ADMIN_CONFIGURE = 'remg_layout.admin_menu_configure';

    private $menu;
    private $request;

    /**
     * @param \Knp\Menu\ItemInterface $menu
     */
    public function __construct(ItemInterface $menu, $request)
    {
        $this->menu = $menu;
        $this->request = $request;
    }

    /**
     * @return \Knp\Menu\ItemInterface
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     */
    public function getRequest()
    {
        return $this->request;
    }

}