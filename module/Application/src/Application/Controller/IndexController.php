<?php

namespace Application\Controller;

use Doctrine\ORM\EntityManager;
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

        $vacancies = $em
            ->getRepository('Application\Entity\Vacancy')
            ->findAll();

        return new ViewModel(
            [
                'vacancies' => $vacancies,
            ]
        );
    }
}
