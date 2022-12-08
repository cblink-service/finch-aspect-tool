<?php

namespace Cblink\Service\FinchAspect\Kernel;

use Closure;
use Cblink\Dto\Dto;
use Hyperf\Utils\Str;

abstract class BaseAspectDto extends Dto
{
    /**
     * @var \Exception|null
     */
    protected $exception;

    protected $instance = [];

    /**
     * @param $hash
     * @param Closure $closure
     * @return mixed
     */
    final protected function getFromCache($hash, Closure $closure)
    {
        if (!$this->hasInstance($hash)) {
            $this->bindInstance($hash, call_user_func($closure));
        }

        return $this->instance[$hash];
    }

    /**
     * @param $hash
     * @return bool
     */
    final protected function hasInstance($hash)
    {
        return array_key_exists($hash, $this->instance);
    }

    /**
     * @param $hash
     * @param $data
     * @return void
     */
    protected function bindInstance($hash, $data)
    {
        $this->instance[$hash] = $data;
    }

    /**
     * @param $hash
     * @return void
     */
    protected function unbindInstance($hash)
    {
        if ($this->hasInstance($hash)) {
            unset($this->instance[$hash]);
        }
    }

    /**
     * @param $key
     * @param string $trans
     * @return mixed
     */
    final protected function getFromTranslateCache($key, string $trans)
    {
        return $this->getFromCache($key, function () use ($key, $trans){
            return array_map(function ($item) use ($trans){
                if ($item instanceof $trans) {
                    return $item;
                }

                return new $trans($item);
            }, $this->getItem($key, []));
        });
    }

    /**
     * @param $key
     * @param \Closure $closure
     * @return void
     */
    public function mapAttribute($key, Closure $closure)
    {
        $this->payload[$key] = array_map($closure, $this->getAttribute($key, []), array_keys($this->getAttribute($key, [])));

        $this->unbindInstance($key);
    }

    /**
     * @param $key
     * @param $val
     * @return $this
     */
    public function setAttribute($key, $val)
    {
        $this->payload[$key] = $val;

        return $this;
    }

    /**
     * @param $key
     * @param null $default
     * @return array|\ArrayAccess|mixed
     */
    protected function getAttribute($key, $default = null)
    {
        if ($this->hasInstance($key)) {
            return $this->instance[$key];
        }

        return $this->getItem($key, $default);
    }

    /**
     * @param $key
     * @param array $data
     * @return $this
     */
    public function appendData($key, array $data)
    {
        if (!is_array($this->getItem($key))) {
            throw new \InvalidArgumentException(sprintf('%s type not array', $key));
        }

        // 未初始化的情况
        if (is_null($this->payload[$key])) {
            $this->payload[$key] = [];
        }

        $this->payload[$key][] = $data;

        if ($this->hasInstance($key)) {
            $this->unbindInstance($key);
        }

        return $this;
    }

    /**
     * @param $key
     * @param $line
     * @return $this
     */
    public function removedData($key, $line)
    {
        if (!is_array($this->getItem($key))) {
            throw new \InvalidArgumentException(sprintf('%s type not array', $key));
        }

        if (is_array($this->payload[$key])) {
            unset($this->payload[$key][$line]);

            if ($this->hasInstance($key)) {
                $this->unbindInstance($key);
            }
        }

        return $this;
    }

    /**
     * @param $name
     * @return string
     */
    final protected function getMethod($name)
    {
        return sprintf('get%sData', ucfirst(Str::camel($name)));
    }

    /**
     * 设置异常类
     *
     * @param \Throwable $throwable
     * @return $this
     */
    public function setException(\Throwable $throwable)
    {
        $this->exception = $throwable;
        return $this;
    }

    /**
     * @return \Exception|null
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @param $name
     * @return array|\ArrayAccess|mixed|null
     * @throws \Throwable
     */
    public function __get($name)
    {
        if (method_exists($this, $method = $this->getMethod($name))) {
            return call_user_func([$this, $method]);
        }

        return parent::__get($name);
    }
}