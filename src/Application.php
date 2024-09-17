<?php

namespace Mali;

use Mali\Database\DB;
use Mali\Database\Managers\MySQLManager;
use Mali\Http\Request;
use Mali\Http\Response;
use Mali\Http\Route;
use Mali\Support\Config;
use Mali\Support\Session;

class Application
{
    protected Route $route;
    protected Request $request;
    protected Response $response;
    protected Config $config;
    protected DB $db;
    protected Session $session;

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        $this->session = new Session();
        $this->route = new Route($this->request, $this->response);
        $this->config = new Config($this->loadConfigurations());
        $this->db = new DB($this->getDatabaseDriver());
    }

    protected function getDatabaseDriver()
    {
        return match(env('DB_DRIVER')){
            'mysql' => new MySQLManager,
            default => new MySQLManager
        };
    }

    protected function loadConfigurations()
    {
        foreach(scandir(config_path()) as $file)
        {
            if($file == '.' || $file == '..')
            {
                continue;
            }

            $filename = explode('.', $file)[0];
            yield $filename => require config_path() . $file;
        }
    }

    public function run()
    {
        $this->db->init();
        $this->route->resolve();
    }

    public function __get($name)
    {
        if(property_exists($this, $name))
        {
            return $this->$name;
        }
    }
}
