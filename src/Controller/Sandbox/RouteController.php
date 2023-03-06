<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/sandbox/route', name: 'sandbox_route')]
class RouteController extends AbstractController
{
    #[Route(
        '/redirect1',
        
        name: '_redirect1',
    )]
    public function redirect1Action(): Response
    {

        return $this->redirectToRoute('sandbox_route_redirect2');
    }

    #[Route(
        '/redirect3',
        
        name: '_redirect3',
    )]
    public function redirect3Action(): Response
    {
        dump('toto');
        return $this->redirectToRoute('sandbox_route_redirect2');
    }


    #[Route(
        '/redirect2',
        
        name: '_redirect2',
    )]
    public function redirect2Action(): Response
    {

        return $this->redirectToRoute('sandbox_route_test3', array('year'=>18 , 'month'=>11 , 'filename'=>'toto'));
    }

    #[Route(
        '/permis/{age}',
        requirements: ['age' => '0|[1-9]\d*'],
        name: '_permis',
    )]
    public function permisAction(int $age): Response
    {
        if($age < 18)
            throw new NotFoundHttpException('Vous n\' êtes pas assez agé ! ;) ');

        return new Response('<body>Route::withVariable : age = ' . $age . '</body>');
    }

    #[Route(
        '/with-variable/{age}',
        name: '_with_variable'
    )]
    public function withVariableAction($age): Response
    {
        return new Response('<body>Route::withVariable : age = ' . $age . '</body>');
    }

    #[Route(
        '/with-default/{age}',
        name: '_with_default',
        defaults: ['age' => 18],
    )]
    public function withDefaultAction($age): Response
    {
        dump($age);
        return new Response('<body>Route::withDefault : age = ' . $age . ' (' . gettype($age) . ')</body>');
    }


    #[Route(
        '/with-constraint/{age}', 
        name: '_with_constraint',
        requirements: ['age' => '0|[1-9]\d*'], //theorie des language 
        defaults: ['age' => 18],
        )]
    public function withConstraintAction(int $age): Response
    {
        dump($age);
        return new Response('<body>Route::witConstraint : age = ' . $age . '('.gettype($age).')'.'</body>');
    }

    #[Route(
        '/test1/{year}/{month}/{filename}.{ext}', 
        name: '_test1',
        
        )]
    public function test1($year , $month , $filename ,$ext): Response
    {
        $args = array(
            'title' => 'test1',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );
        return $this->render('Sandbox/Route/test1.html.twig', $args);

    }

    #[Route(
        '/test2/{year}/{month}/{filename}.{ext}', 
        name: '_test2',
        requirements: ['years' => '[1-9]\d{0,3}' ,
        'month' => '(0?[1-9])|(1[0-2])',
        'filename' => '[-a-zA-Z]+',
        'ext' => 'jpg|jpeg|png|ppm',
        ],
    )]
    public function test2(int $year , int $month , string $filename ,string $ext): Response
    {
        $args = array(
            'title' => 'test2',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );
        return $this->render('Sandbox/Route/test2.html.twig', $args);

    }

    #[Route(
        '/test3/{year}/{month}/{filename}.{ext}', 
        name: '_test3',
        requirements: ['years' => '[1-9]\d{0,3}' ,
        'month' => '(0?[1-9])|(1[0-2])',
        'filename' => '[-a-zA-Z]+',
        'ext' => 'jpg|jpeg|png|ppm',
        ],
        defaults: ['ext' => 'gif'],
    )]
    public function test3(int $year , int $month , string $filename ,string $ext): Response
    {
        $args = array(
            'title' => 'test3',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );
        return $this->render('Sandbox/Route/test2.html.twig', $args);

    }

   

    #[Route(
        '/test4/{year}/{month}/{filename}.{ext}', 
        name: '_test4',
        requirements: ['year' => '[1-9]\d{0,3}' ,
        'month' => '(0?[1-9])|(1[0-2])',
        'filename' => '[-a-zA-Z]+',
        'ext' => 'jpg|jpeg|png|ppm',
        ],
        defaults: ['ext' => 'gif' ,
        'filename' => 'toto' ,
        'month' => 1],

    )]
    public function test4(int $year , int $month , string $filename ,string $ext): Response
    {
        $args = array(
            'title' => 'test2',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );
        return $this->render('Sandbox/Route/test2.html.twig', $args);

    }

    

}
