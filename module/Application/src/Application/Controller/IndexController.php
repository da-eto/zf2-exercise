<?php

namespace Application\Controller;

use Application\src\Application\Form\FilterForm;
use Doctrine\ORM\EntityManager;
use Zend\Form\FormElementManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 *
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        /** @var EntityManager $em */
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        /** @var FormElementManager $formManager */
        $formManager = $this->getServiceLocator()->get('FormElementManager');
        /** @var FilterForm $filterForm */
        $filterForm = $formManager->get('Application\Form\FilterForm');

        $vacancies = $em
            ->getRepository('Application\Entity\Vacancy')
            ->findAll();

        return new ViewModel(
            [
                'vacancies' => $vacancies,
                'filterForm' => $filterForm,
            ]
        );
    }
}
