<?php

namespace App\Helpers;

trait PromiseActionsTrait
{
    /**
     * @var \Closure[]
     */
    private $promiseActions = [];

    /**
     * @param \Closure $actionCallback
     * @return $this
     */
    private function recordPromiseAction(\Closure $actionCallback) : self {
        $this->promiseActions[] = $actionCallback;
        return $this;
    }

    /**
     * @return $this
     */
    private function releasePromiseActions() {
        foreach($this->promiseActions as $action) {
            $action();
        }

        $this->promiseActions = [];
        return $this;
    }
}
