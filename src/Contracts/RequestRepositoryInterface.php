<?php

namespace Craftisan\ApiTester\Contracts;

use Craftisan\ApiTester\Entities\RequestEntity;

interface RequestRepositoryInterface
{

    /**
     * @param $id
     *
     * @return \Craftisan\ApiTester\Entities\RequestEntity
     */
    public function find($id);

    /**
     * @param \Craftisan\ApiTester\Entities\RequestEntity $request
     *
     * @return void
     */
    public function persist(RequestEntity $request);

    /**
     * @param $id
     *
     * @return bool
     */
    public function exists($id);

    /**
     * @return \Craftisan\ApiTester\Collections\RequestCollection|\Craftisan\ApiTester\Entities\RequestEntity[]
     */
    public function all();

    /**
     * @return void
     */
    public function flush();

    /**
     * @param string $request
     */
    public function remove($request);

}
