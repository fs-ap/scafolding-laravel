<?php namespace App;


use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
* 
*/
class MetaRecurso
{
	protected $json;
	protected $meta_aplicacao;

	public function __construct($json)
	{
		if($json === false) {
			throw new Exception("Json Inválido " . __CLASS__, 1);
		}

		$this->json = new Collection($json);
		$this->meta_aplicacao = app()->make('metadata');
	}

	public function lerMetaAPartirModel(Model $model)
	{
		$modelName = get_class($model);
		$segments = explode('\\', $modelName);

		$path = Str::plural(Str::camel(end($segments)));

		$path = sprintf('%s/%s', resource_path('views'), "{$path}/meta.json");
		return new static(json_decode(file_get_contents($path)));
	}

	public function camposAcao($acao = null)
	{
		if(!$acao) {
			$acao = $this->meta_aplicacao->nomeAction();
		}

		if(! $this->json->has($acao)) {
			$acao = 'todos';
		}

		return array_pluck($this->json[$acao], 'nome');
	}

	public function getValorCampo($campo, $model)
	{
		$tipo = $this->getTipoCampoPara($campo);

		switch ($tipo) {
			case 'foreign':
				$detalhes = $this->getDetalhesCampoSelect($campo);
				$relacionamento = $detalhes['relacionamento'];
				$label = $detalhes['label'];
				if(!isset($model[$relacionamento])) {
					throw new \Exception("Chave {$relacionamento} não existe no Transformer em: " . json_encode($model));
					
				}
				return $this->formataValorCampoForeign($model[$relacionamento], $detalhes['campos'], $label);
				break;
			
			default:
				return $model[$campo];
				break;
		}
	}

	public function formataValorCampoForeign($model, $campos, $template)
	{
		preg_match_all('~:\w+~', $template, $substituicoes);

		$valores = array_map(function($campo) use ($model) {
			if(isset($model[$campo])) {
				return $model[$campo];
			}
		}, $campos);

		return strtr($template, array_combine($substituicoes[0], $valores));
	}

	public function getDetalhesCampoSelect($campo)
	{
		$campos = $this->json->get('campos');

		foreach($campos as $index =>  $campoAtual) {
			if($campoAtual['nome'] === $campo) {
				return $campos[$index]['detalhes'];
			}
		}

		throw new \Exception("Campo foreign não encontrado");
		
	}

	public function getRotuloPara($campo)
	{
		$campos = $this->json->get('campos');

		/**
		 * Se for um campo de busca, remove o prefixo 
		 */
		$campo = preg_replace('/search\[(.*)\]/', '$1', $campo);

		foreach ($campos as $campoMeta) {
			if($campoMeta['nome'] === $campo) {
				return $campoMeta['descricao'];
			}
		}
		
		throw new \Exception("Rótulo não encontrado para Campo $campo no meta.json" , 1);
	}

	public function getMascaraPara($campo)
	{
		$campos = $this->json->get('campos');

		/**
		 * Se for um campo de busca, remove o prefixo 
		 */
		$campo = preg_replace('/search\[(.*)\]/', '$1', $campo);
		
		foreach ($campos as $campoMeta) {
			if($campoMeta['nome'] === $campo) {
				return $campoMeta['mascara'];
			}
		}

	}

	public function getTipoCampoPara($campo)
	{
		$campos = $this->json->get('campos');

		foreach ($campos as $campoMeta) {
			if($campoMeta['nome'] === $campo) {
				return $campoMeta['tipo'];
			}
		}
	}
	public function searchFields($busca = 'simples', $acao = null)
	{
		if(is_null($acao)) {
			$acao = $this->meta_aplicacao->nomeAction();
		}

		if(! $this->json->has($acao)) {
			$acao = 'todos';
		}

		$campos = $this->json->get($acao);

		$campos = array_map(function($campo) use ($busca){

			if($campo['pesquisavel']) {
				if($this->getTipoCampoPara($campo['nome']) == 'foreign') {
					$detalhes = $this->getDetalhesCampoSelect($campo['nome']);

					if($busca == 'simples') {
				return sprintf('%s.%s:%s',
						$detalhes['relacionamento'],
						$detalhes['camposPesquisa'],
						$campo['operador']);
					} else {
						return sprintf('%s:%s',
							$campo['nome'],
							$campo['operador']);
						
					}
				}
				
				return sprintf('%s:%s', $campo['nome'], $campo['operador']);
			}
			
		}, $campos);
		// dd($campos);
		return implode(';', array_filter($campos));
	}

	public function getOptionsParaForeign($campo)
	{
		$campos = $this->json->get('campos');

		$detalhes = $this->getDetalhesCampoSelect($campo);


		$repository = app()->make($detalhes['repository']);

		if(isset($detalhes['where'])) {
			$where = array_combine($detalhes['where']['campos'], $detalhes['where']['valores']);
			$resultado = $repository->skipCriteria()->findWhere($where)['data'];

		} else {
			$resultado = $repository->skipCriteria()->all(array_merge([$detalhes['chavePrimaria']], $detalhes['campos']))['data'];

		}
		
		$valores = [];

		foreach($resultado as $model) {
			$valores[$model['id']] = $this->formataValorCampoForeign($model, $detalhes['campos'], $detalhes['label']);
		}

		return $valores;
	}

	public function camposBuscaSimples()
	{
		$campos = $this->camposAcao();
		
		$campos = array_map(function($campo){
			return $this->isVirtual($campo) ? null : $campo;
		}, $campos);

		return array_filter($campos);
	}

	public function isVirtual($campo)
	{
		$campos = $this->json->get("campos");

		foreach ($campos as $campoCorrente) {
			if($campo == $campoCorrente['nome']) {
				return isset($campoCorrente['virtual']) && $campoCorrente['virtual'];
			}
		}
		
			throw new \Exception("Campo $campo não existe", 1);
	}
	
	public function getOptionsParaSelect($campo)
	{
		$detalhes = $this->getDetalhesCampoSelect($campo);

		$valores = $detalhes['opcoes'];

		return $valores;
	}
}