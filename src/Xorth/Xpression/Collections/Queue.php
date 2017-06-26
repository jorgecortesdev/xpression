<?php

namespace Xorth\Xpression\Collections;

use Countable;

class Queue implements Countable
{
    /**
     * Items inside the collection.
     *
     * @var array
     */
    protected $items;

    /**
     * Create a new Queue instance.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * Verify if the Queue is empty.
     *
     * @return boolean
     */
    public function empty()
    {
        return empty($this->items);
    }

    /**
     * Return the first item in queue without
     * removing it.
     *
     * @return mixed
     */
    public function getFront()
    {
        return current(reset($this->items));
    }

    /**
     * Return the first item in the queue and
     * remove it, decreasing the size of the queue
     * by one.
     *
     * @return mixed
     */
    public function dequeue()
    {
        return array_shift($this->items);
    }

    /**
     * Add a new item in the queue, increasing
     * the size of the queue by one.
     *
     * @param  mixed $item
     * @return $this
     */
    public function enqueue($item)
    {
        array_push($this->items, $item);

        return $this;
    }

    /**
     * Return all the items in the queue
     * as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->items;
    }

    /**
     * Return the number of items inside
     * the queue.
     *
     * @return integer
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Return a string representation of the Stack.
     *
     * @return string
     */
    public function toString()
    {
        return implode(' ', $this->items);
    }

    /**
     * Return a string representation of the Stack.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }
}
