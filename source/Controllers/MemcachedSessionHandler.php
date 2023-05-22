<?php

namespace Source\Controllers;

class MemcachedSessionHandler implements SessionHandlerInterface {

    private $memcached;

    public function __construct($memcached) {
        $this->memcached = $memcached;
    }

    public function open($savePath, $sessionName) {
        return true;
    }

    public function close() {
        return true;
    }

    public function read($sessionId) {
        return $this->memcached->get($sessionId);
    }

    public function write($sessionId, $sessionData) {
        $this->memcached->set($sessionId, $sessionData, time() + ini_get('session.gc_maxlifetime'));
        return true;
    }

    public function destroy($sessionId) {
        $this->memcached->delete($sessionId);
        return true;
    }

    public function gc($maxlifetime) {
        return true;
    }
}
