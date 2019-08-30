<?php

namespace Fabz29\PaginationBundle\Service;

use Twig_Environment as TwigEnvironment;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * This service is called by /Twig/PaginationExtension to render and handle the pagination from the template
 *
 * Class Pagination
 * @package App\Service
 */
class Pagination
{
    public const NUMBER_PER_PAGE = 20;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var RequestStack
     */
    private $request;

    /**
     * Pagination constructor.
     * @param TwigEnvironment $twig
     * @param RequestStack $requestStack
     */
    public function __construct(\Twig_Environment $twig, RequestStack $requestStack)
    {
        $this->twig = $twig;
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @param Paginator $items
     * @param string|null $target
     * @param array|null $route
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function display(Paginator $items,?string $target,?array $route): string
    {
        $nbPages = ceil(count($items) / Pagination::NUMBER_PER_PAGE);
        if(!isset($route) OR !isset($route['name'])OR !isset($route['params']) OR !isset($route['params_json'])){
            $route = [
                'name'=>$this->request->get('_route'),
                'params' => $this->request->get('_route_params'),
                'params_json' => $this->request->query->all()
            ];
        }
        $route['params_json'] = json_encode($route['params_json']);

        return $this->twig->render('_default/_pagination.html.twig', [
            'items' => $items,
            'num_page' => $this->request->get('page'),
            'nb_pages' => $nbPages,
            'target' => $target,
            'route' =>$route,
        ]);
    }

}
