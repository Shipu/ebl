<?php

namespace Shipu\Ebl\Response;

use Apiz\Http\Response;
use Nahid\QArray\Exceptions\ConditionNotAllowedException;
use Nahid\QArray\QueryEngine;

class EblResponse extends Response
{

    /**
     * @param null $code
     * @param null $data
     *
     * @return QueryEngine
     * @throws ConditionNotAllowedException;
     */
    public function response( $code = null, $data = null )
    {
        return $this->query()->collect([
            'code' => $code ?: $this->getStatusCode(),
            'data' => $data ?: $this->data()->toArray()
        ])->toJson();
    }

    public function data()
    {
        return $this->query()->setTraveler('->');
    }
}
