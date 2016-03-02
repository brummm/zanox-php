<?php

namespace Zanox\Tests\Resources;

use Zanox\Client;
use Zanox\Resources\Reports;

class ReportsTest extends ResourceTestCase{

    public function setUp()
    {
        $this->setResource( new Reports( $this->getZanoxClient() ) );
    }

    public function testGetLeadsByDate()
    {
        $response = $this->resource->getLeadsByDate(new \DateTime('-1 day'));
        $this->assertFalse( $response->hasError() );
    }

    public function testGetLeadsById()
    {
        $response = $this->resource->getLeadsById('fakeId');
        $this->assertTrue( $response->hasError() );
    }

    public function testGetSalesByDate()
    {
        $response = $this->resource->getSalesByDate(new \DateTime('-1 day'));
        $this->assertFalse( $response->hasError() );
    }

    public function testGetSalesById()
    {
        $response = $this->resource->getSalesById('fakeId');
        $this->assertTrue( $response->hasError() );
    }

    public function testGetBasic()
    {
        $response = $this->resource->getBasic(new \DateTime('-1 month'), new \DateTime());

        $this->assertFalse( $response->hasError() );
    }
}