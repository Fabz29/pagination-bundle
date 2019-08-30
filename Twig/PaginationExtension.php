<?php

namespace Fabz29\PaginationBundle\Twig;

use Fabz29\PaginationBundle\Service\Pagination;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Provides an extension for Twig to output pagination
 *
 * Class PaginationExtension
 * @package App\Twig
 */
class PaginationExtension extends \Twig_Extension
{
    /**
     * @var Pagination
     */
    private $pagination;

    /**
     * PaginationExtension constructor.
     * @param Pagination $pagination
     */
    public function __construct(Pagination $pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction("pagination_render", array($this, "renderPagination"),  array("is_safe" => array("html"))),
        ];
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
    public function renderPagination(Paginator $items,string $target = null,?array $route = null): string
    {
        return $this->pagination->display($items,$target,$route);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "pagination";
    }
}
