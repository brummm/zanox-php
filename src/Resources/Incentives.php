<?php

namespace Zanox\Resources;


class Incentives extends AbstractResource{
    public function getIncentives( array $query = null )
    {
        return $this->request('GET','incentives/', $query);
    }
    public function getIncentiveById( $id, array $query = null)
    {
        return $this->request('GET','incentives/incentive/'. $id, $query);
    }
    public function getExclusiveIncentives( array $query = null )
    {
        return $this->request('GET','incentives/exclusive/', $query);
    }
    public function getExclusiveIncentiveById( $id, array $query = null)
    {
        return $this->request('GET','incentives/exclusive/incentive/'. $id, $query);
    }
}