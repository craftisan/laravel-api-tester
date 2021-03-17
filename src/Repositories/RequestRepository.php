<?php

namespace Craftisan\ApiTester\Repositories;

use Craftisan\ApiTester\Collections\RequestCollection;
use Craftisan\ApiTester\Contracts\RequestRepositoryInterface;
use Craftisan\ApiTester\Contracts\StorageInterface;
use Craftisan\ApiTester\Entities\RequestEntity;
use Illuminate\Support\Str;

/**
 * Class DefaultRequestRepository
 *
 * @package \Craftisan\ApiTester
 */
class RequestRepository implements RequestRepositoryInterface
{

    /**
     * @type RequestCollection
     */
    protected $requests;

    /**
     * @type StorageInterface
     */
    protected $storage;

    /**
     * RequestRepository constructor.
     *
     * @param StorageInterface $storage
     *
     * @internal param RequestCollection $requests
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
        $this->load();
    }

    /**
     * Get data from storage and load it into collection.
     * @return void
     */
    protected function load()
    {
        $this->requests = $this->storage->get();
    }

    /**
     * Replace existing collection with data loaded from storage.
     */
    protected function reload()
    {
        $this->requests = $this->requests->make($this->getDataFromStorage());
    }

    /**
     * Get all stored data storage.
     *
     * @return mixed
     */
    protected function getDataFromStorage()
    {
        return $this->storage->get();
    }

    /**
     * @param int $id
     *
     * @return RequestEntity
     */
    public function find($id)
    {
        return $this->requests->find($id);
    }

    /**
     * @param RequestEntity $request
     */
    public function persist(RequestEntity $request)
    {
        $request->setId(Str::random());
        $this->requests->insert($request);
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function exists($id)
    {
        return $this->requests->has($id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->requests->values();
    }

    /**
     * @param string $id
     */
    public function remove($id)
    {
        $this->find($id)->markToDelete();
    }

    /**
     * @return void
     */
    public function flush()
    {
        $this->storage->put($this->requests);
    }
}
