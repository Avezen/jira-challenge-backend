<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-03
 * Time: 13:33
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function default()
    {
        return $this->json(['Hello!']);
    }
}