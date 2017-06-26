<?php

namespace Xorth\Xpression\Collections;

use Countable;

class Stack implements Countable
{
    /**
     * Items inside the collection.
     *
     * @var array
     */
    protected $items;

    /**
     * Create a new Stack instance.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * Verify if the Stack is empty.
     *
     * @return boolean
     */
    public function empty()
    {
        return empty($this->items);
    }

    /**
     * Return the top item in stack without
     * removing it.
     *
     * @return mixed
     */
    public function peek()
    {
        return end($this->items);
    }

    /**
     * Return the top item in the stack and
     * remove it, decreasing the size of the stack
     * by one.
     *
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->items);
    }

    /**
     * Add a new item in the stack, increasing
     * the size of the stack by one.
     *
     * @param  mixed $item
     * @return $this
     */
    public function push($item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Return all the items in the stack
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
     * the stack.
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
