<?php

namespace Remg\LayoutBundle\Pagination;

use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator as KnpPaginator;
use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderUpdater;

class Paginator
{
	protected $request;
	protected $paginator;
	protected $queryBuilderUpdater;
	protected $filterableReader;
	protected $templates;

	public function __construct(RequestStack $requestStack, EntityManager $entityManager, KnpPaginator $paginator, FilterBuilderUpdater $queryBuilderUpdater)
	{
		$this->request = $requestStack->getCurrentRequest();
		$this->entityManager = $entityManager;
		$this->paginator = $paginator;
		$this->queryBuilderUpdater = $queryBuilderUpdater;
	}

	public function paginate($entityClass, $filterForm = null)
	{
        $queryBuilder = $this->createQueryBuilder($entityClass);

        if (null !== $filterForm) {
        	$filterForm->handleRequest($this->request);

            if ($filterForm->isValid()) {
                $this->queryBuilderUpdater->addFilterConditions($filterForm, $queryBuilder);
            }
        }

        $pagination = $this->paginator->paginate(
            $queryBuilder->getQuery(),
            $this->request->query->getInt('page', 1),
            $this->request->query->getInt('max_per_page', 5)
        );

        if (null !== $this->templates) {
			$pagination->setTemplate($this->getPaginationTemplate());
			$pagination->setSortableTemplate($this->getSortableTemplate());
		}

     	return $pagination;
	}

	protected function createQueryBuilder($entityClass)
	{
        $parts = explode('\\', $entityClass);
        $entityName = array_pop($parts);
        $alias = strtolower($entityName[0]);

        return $this
        		->entityManager
                ->getRepository($entityClass)
                ->createQueryBuilder($alias)
        ;
	}

	public function setTemplates(array $templates)
	{
		$this->templates = $templates;
	}

	public function getPaginationTemplate()
	{
		return $this->templates['pagination'];
	}

	public function getSortableTemplate()
	{
		return $this->templates['sortable'];
	}
}