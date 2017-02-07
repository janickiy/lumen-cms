<?php

namespace Illuminate\View;

use Closure;
use Countable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Contracts\View\Factory as FactoryContract;
use Illuminate\View\Factory as ViewFactory;

class Factory extends ViewFactory implements FactoryContract
{

    /**
     * The extension to engine bindings.
     *
     * @var array
     */
//    protected $extensions = ['blade.php' => 'blade', 'php' => 'php'];


    /**
     * Create a new view factory instance.
     *
     * @param  \Illuminate\View\Engines\EngineResolver  $engines
     * @param  \Illuminate\View\ViewFinderInterface  $finder
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
 //   public function __construct(EngineResolver $engines, ViewFinderInterface $finder, Dispatcher $events)
 //   {
 //       $this->finder = $finder;
 //       $this->events = $events;
 //       $this->engines = $engines;

  //      $this->share('__env', $this);
  //  }

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $path
     * @param  array   $data
     * @param  array   $mergeData
     * @return \Illuminate\Contracts\View\View
     */
    public function file($path, $data = [], $mergeData = [])
    {
        $data = array_merge($mergeData, $this->parseData($data));

        $this->callCreator($view = new View($this, $this->getEngineFromPath($path), $path, $path, $data));

        return $view;
    }

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @return \Illuminate\Contracts\View\View
     */
    public function make($view, $data = [], $mergeData = [])
    {
        if (isset($this->aliases[$view])) {
            $view = $this->aliases[$view];
        }

        $view = $this->normalizeName($view);

        $path = $this->finder->find($view);

        $data = array_merge($mergeData, $this->parseData($data));

        $this->callCreator($view = new View($this, $this->getEngineFromPath($path), $view, $path, $data));
        //echo 'dbfactory.php 179';
        //dd($view);
        return $view;
    }


    /**
     * Get the appropriate view engine for the given path.
     *
     * @param  string  $path
     * @return \Illuminate\View\Engines\EngineInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getEngineFromPath($path)
    {
        if (! $extension = $this->getExtension($path)) {
            throw new InvalidArgumentException("Unrecognized extension in file: $path");
        }

        $engine = $this->extensions[$extension];

        return $this->engines->resolve($engine);
    }

    /**
     * Get the extension used by the view file.
     *
     * @param  string  $path
     * @return string
     */
    protected function getExtension($path)
    {
        $extensions = array_keys($this->extensions);

        return Arr::first($extensions, function ($value) use ($path) {
            return Str::endsWith($path, '.'.$value);
        });
    }

        
}
