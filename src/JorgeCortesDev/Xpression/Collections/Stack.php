<?php

namespace JorgeCortesDev\Xpression\Collections;

use Countable;

class Stack implements Countable
{
    /**
     * Items inside the collection.
     *
     * @var array
     */
    protected array $items;

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
     * @return bool
     */
    public function empty(): bool
    {
        return empty($this->items);
    }

    /**
     * Return the top item in stack without
     * removing it.
     *
     * @return mixed
     */
    public function peek(): mixed
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
    public function pop(): mixed
    {
        return array_pop($this->items);
    }

    /**
     * Add a new item in the stack, increasing
     * the size of the stack by one.
     *
     * @param mixed $item
     * @return $this
     */
    public function push(mixed $item): static
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
    public function toArray(): array
    {
        return $this->items;
    }

    /**
     * Return the number of items inside
     * the stack.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
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

    /**
     * Return a string representation of the Stack.
     *
     * @return string
     */
    public function toString(): string
    {
        return implode(' ', $this->items);
    }
}
