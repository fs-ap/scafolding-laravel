<?php namespace App;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

/**
* 
*/
class MetaAplicacao
{
	protected $router;
	protected $request;

	public function __construct(Router $router, Request $request)
	{
		$this->router = $router;
		$this->request = $request;
	}

	/**
	 * Retorna o nome do controller que está atendendo a request;
	 * EX: \App\Http\Controller\RacasController
	 */
	public function nomeController()
	{
		$action = $this->getActionRouter();

		return '\\'. explode('@', $action['controller'])[0];
	}

	/**
	 * Retorna o nome da action que atendeu a requisição
	 * Ex: index|show
	 */
	public function nomeAction()
	{
		$action = $this->getActionRouter();

		return explode('@', $action['controller'])[1];
	}

	/**
	 * Retorna o nome do {resource}
	 * Ex: Pessoas|Racas|Estados
	 */
	public function nomeRecurso()
	{
		$controller = explode('\\', $this->nomeController());

		return str_replace('Controller', '', end($controller));
	}

	/**
	 * Retorna o DSL da rota atual
	 * EX: App\Http\Controller\PessoasController@index
	 */
	public function dslRotaCorrente()
	{
		$action = $this->getActionRouter();

		return '\\'.$action['uses'];
	}
	/**
	 * Atalho para buscar os detalhes da rota
	 */
	protected function getActionRouter()
	{
		return $this->router->getCurrentRoute()->getAction();
	}

}