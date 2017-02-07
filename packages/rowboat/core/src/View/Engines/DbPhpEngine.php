<?php

namespace Rowboat\Core\View\Engines;

use Illuminate\View\Engines\PhpEngine;
use Exception;
use Throwable;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class DbPhpEngine extends PhpEngine
{
    /**
     * Get the evaluated phps of the view.
     *
     * @param  string  $php
     * @param  array   $data
     * @return string
     */
    public function get($php, array $data = [])
    {
        return $this->evaluateCode($php, $data);
    }

    /**
     * Get the evaluated phps of the view at the given path.
     *
     * @param  string  $__path
     * @param  array   $__data
     * @return string
     */
    protected function evaluateCode($__php, $__data)
    {
        $obLevel = ob_get_level();

        ob_start();

        extract($__data, EXTR_SKIP);

        // We'll evaluate the phps of the view inside a try/catch block so we can
        // flush out any stray output that might get out before an error occurs or
        // an exception is thrown. This prevents any partial views from leaking.
        try {
            eval('?' . '>' . $__php);
        } catch (Exception $e) {
            $this->handleViewException($e, $obLevel);
        } catch (Throwable $e) {
            $this->handleViewException(new FatalThrowableError($e), $obLevel);
        }

        return ltrim(ob_get_clean());
    }

    /**
     * Handle a view exception.
     *
     * @param  \Exception  $e
     * @param  int  $obLevel
     * @return void
     *
     * @throws $e
     */
    protected function handleViewException(Exception $e, $obLevel)
    {
        while (ob_get_level() > $obLevel) {
            ob_end_clean();
        }

        throw $e;
    }
}
