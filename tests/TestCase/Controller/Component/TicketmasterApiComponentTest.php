<?php
namespace Ticketmaster\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use Ticketmaster\Controller\Component\TicketmasterApiComponent;

/**
 * Ticketmaster\Controller\Component\TicketmasterApiComponent Test Case
 */
class TicketmasterApiComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Ticketmaster\Controller\Component\TicketmasterApiComponent
     */
    public $TicketmasterApi;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->TicketmasterApi = new TicketmasterApiComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TicketmasterApi);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
