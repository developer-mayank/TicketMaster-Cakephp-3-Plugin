<?php

namespace Ticketmaster\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Http\Client;
use Cake\Core\Configure;
use Ticketmaster\Model\Entity\Factory;
use Cake\Utility\Inflector;

/**
 * TicketmasterApi component
 */
class TicketmasterApiComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $apikey;
    private $apiUrl = "https://app.ticketmaster.com/discovery/v2/";

    public function __call($name, array $parameters = []) {
        $parameters = array_merge(
                isset($parameters[0]) ? $parameters[0] : [], [
            'apikey' => Configure::read('ticketmaster_api_key'),
            'format' => 'json',
                ]
        );

        $command = $this->getCommand($name, $parameters);
        $operation = $this->getOperation($name);
        $response = $this->executeCommand($command);
        $response = !empty($response) ? json_decode($response,true) : $response;
        //$response = isset($response['_embedded']) ? $response['_embedded'] : $response;
        return $response;
    }

    protected function getOperation($name) {
        return Inflector::classify($name);
    }

    protected function getCommand($name, $parameters) {
        $name = Inflector::dasherize($name);
        $name = explode("-",$name);
        if(isset($parameters['id']))
        {
            $command = $name[0]."/".$parameters['id'];
            unset($parameters['id']);
            if(isset($name[1]))
            {
                $command = $command."/".$name[1];
            }
            $command = $command.".".$parameters['format'];
        }
        else
        {
            $command = $name[0] . "." . $parameters['format'];
        }
        unset($parameters['format']);
        $query = http_build_query($parameters);
        return $this->apiUrl . $command . '?' . $query;
    }

    public function executeCommand($command) {
        $http = new Client();
        return $http->get($command)->body;
    }

}
