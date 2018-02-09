<?php
/**
 * Created by PhpStorm.
 * User: Hi Yen Wong
 * Date: 08/02/2018
 * Time: 10:55 AM
 */

class CacheClass
{
    public $redis;

    public function __construct()
    {
        $this->redis = new Redis();
        $this->redis->connect(REDIS_SERVER, REDIS_SRV_PORT);
        $this->redis->select(REDIS_DB);
        return $this->redis;
    }

    public function __destruct()
    {
        return $this->redis->close();
    }

}