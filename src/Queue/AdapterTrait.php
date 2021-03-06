<?php
namespace Phwoolcon\Queue;

use Phalcon\Di;

trait AdapterTrait
{
    /**
     * @var Di
     */
    protected $di;
    protected $connection;
    protected $defaultQueue;
    protected $options;
    protected $connectionName;

    public function __construct(Di $di, array $options, $connectionName)
    {
        $this->di = $di;
        $this->options = $options;
        $this->defaultQueue = $options['default'];
        $this->connectionName = $connectionName;
        $this->connect($options);
    }

    abstract protected function connect(array $options);

    /**
     * Create a payload string from the given worker and data.
     *
     * @param  string $worker
     * @param  mixed  $data
     * @return string
     */
    protected function createPayload($worker, $data = '')
    {
        return json_encode(['job' => $worker, 'data' => $data]);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return string
     * @codeCoverageIgnore
     */
    public function getConnectionName()
    {
        return $this->connectionName;
    }

    public function getDi()
    {
        return $this->di;
    }

    /**
     * Get the queue or return the default.
     *
     * @param  string|null $queue
     * @return string
     */
    public function getQueue($queue)
    {
        return $queue ?: $this->defaultQueue;
    }

    abstract public function pop($queue = null);

    public function push($worker, $data = '', $queue = null, array $options = [])
    {
        return $this->pushRaw($this->createPayload($worker, $data), $queue, $options);
    }

    abstract public function pushRaw($payload, $queue = null, array $options = []);
}
