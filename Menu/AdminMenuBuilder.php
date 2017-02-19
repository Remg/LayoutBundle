<?php

namespace Remg\LayoutBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Remg\LayoutBundle\Event\ConfigureMenuEvent;

class AdminMenuBuilder
{
    protected $factory;
    protected $request;
    protected $eventDispatcher;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory, RequestStack $requestStack, $eventDispatcher)
    {
        $this->factory = $factory;
        $this->request = $requestStack->getCurrentRequest();
        $this->eventDispatcher = $eventDispatcher;
    }

    private function createMenu($nodeName = 'root')
    {
        return $this->factory->createItem($nodeName);
    }

    public function buildAdmin()
    {
        $menu = $this->createMenu();

        $this->eventDispatcher->dispatch(
            ConfigureMenuEvent::ADMIN_CONFIGURE,
            new ConfigureMenuEvent($menu, $this->request)
        );

        $this->configureMenu($menu);

        return $menu;
    }

    protected function configureMenu(ItemInterface $menu)
    {
        $menu->setChildrenAttribute('class', 'nav side-menu');

        $this->configureChildren($menu);
    }

    /**
     * Recursively configure child nodes.
     */
    public function configureChildren(ItemInterface $node)
    {
        foreach ($node->getChildren() as $child) {
            $child->setExtra('translation_domain', 'admin');

            if ($child->hasChildren()) {
                $child
                    ->setChildrenAttribute('class', 'nav child_menu')
                    ->setAttribute('dropdown', true);

                $this->configureChildren($child);
            }
        }
    }
}