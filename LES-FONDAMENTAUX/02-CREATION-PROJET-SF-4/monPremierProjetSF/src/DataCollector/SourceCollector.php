<?php
/**
 * Created by PhpStorm.
 * User: Hugo LIEGEARD
 * Date: 09/03/2018
 * Time: 01:08
 */

namespace App\DataCollector;


use App\Mediator\Article\ArticleMediator;
use App\Mediator\Article\DoctrineColleague;
use App\Mediator\Article\YamlColleague;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

/**
 * @method  reset()
 */
class SourceCollector extends DataCollector
{

    private $mediator, $yamlColleague, $doctrineColleague;

    /**
     * SourceCollector constructor.
     * @param $mediator
     * @param $yamlColleague
     * @param $doctrineColleague
     */
    public function __construct(ArticleMediator $mediator, YamlColleague $yamlColleague, DoctrineColleague $doctrineColleague)
    {
        $this->mediator = $mediator;
        $this->yamlColleague = $yamlColleague;
        $this->doctrineColleague = $doctrineColleague;
    }


    /**
     * Collects data for the given Request and Response.
     * @param Request $request
     * @param Response $response
     * @param \Exception|null $exception
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {

        $this->data = [
            'mediator'  => $this->mediator->count(),
            'yaml'      => $this->yamlColleague->count(),
            'doctrine'  => $this->doctrineColleague->count(),
        ];
    }

    /**
     * Returns the name of the collector.
     *
     * @return string The collector name
     */
    public function getName()
    {
        return 'app.source_collector';
    }

    public function getMediator()
    {
        return $this->data['mediator'];
    }

    public function getYaml()
    {
        return $this->data['yaml'];
    }

    public function getDoctrine()
    {
        return $this->data['doctrine'];
    }

    public function getChartData()
    {
        return json_encode(array(
            array("y" => $this->getYaml(), "label" => "YAML" ),
            array("y" => $this->getDoctrine(), "label" => "DOCTRINE" ),
        ), JSON_NUMERIC_CHECK);
    }

}