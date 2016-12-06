<?php

namespace Zanox\Resources;


class Programs extends AbstractResource{
    public function getPrograms( array $query = null )
    {
        return $this->request('GET','programs/', $query);
    }
    public function getProgramById( $id, array $query = null)
    {
        return $this->request('GET','programs/program/'. $id, $query);
    }
}