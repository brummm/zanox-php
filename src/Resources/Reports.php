<?php

namespace Zanox\Resources;

use DateTime;

class Reports extends AbstractResource{
    public function getLeadsByDate( DateTime $date, array $query = null)
    {
        return $this->request('GET','reports/leads/date/'.$this->getFormattedDate($date),$query);
    }

    public function getLeadsById( $id, array $query = null )
    {
        return $this->request('GET','reports/leads/lead/'.$id,$query);
    }

    public function getSalesByDate( DateTime $date, array $query = null )
    {
        return $this->request('GET','reports/sales/date/'.$this->getFormattedDate($date),$query);
    }

    public function getSalesById( $id, array $query = null )
    {
        return $this->request('GET','reports/sales/sale/'.$id,$query);
    }

    public function getBasic( DateTime $fromDate, DateTime $toDate, array $query = null)
    {
        if(!$query)
        {
            $query = array();
        }
        
        $query['fromdate']  = $this->getFormattedDate($fromDate);
        $query['todate']    = $this->getFormattedDate($toDate);

        return $this->request('GET','reports/basic',$query);
    }
}