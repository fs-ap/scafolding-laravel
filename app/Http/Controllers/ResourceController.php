<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\RacaRepository;
use App\Validators\RacaValidator;
use JsValidator;

abstract class ResourceController extends BaseController
{

    /**
     * @var string
     */
    public static $pluralName;

    /**
     * @var string
     */
    public static $singleName;

    /**
     * 
     */
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @var Validator
     */
    protected $validator;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repository->orderBy('id', 'asc')->paginate(10);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $models,
            ]);
        }
        return view(static::$pluralName.'.index', ['models' => $models]);
    }

    /**
     * Display a create form 
     */
    public function create()
    {
        $validacao = JsValidator::make($this->validator->getRules(ValidatorInterface::RULE_CREATE));

        return view(static::$pluralName.'.create', [
            'validacaoJS' => $validacao->render()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $model = $this->repository->create($request->all());

            $response = [
                'message' => static::$singleName.' Criado com Sucesso.',
                'data'    => $model,
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            

            $sucesso = app()->make('metadata')->nomeController() . '@index';

            if($request->has('cadastrarNovo')) {
                $sucesso = app()->make('metadata')->nomeController() . '@create';
            }

            return redirect()
                ->action($sucesso)
                ->with('message', ['message'=> static::$singleName.' criada com sucesso.']);

        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $model,
            ]);
        }

        return view(static::$pluralName.'.show', ['model' => $model]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $model = $this->repository->find($id);

        $validacao = JsValidator::make($this->validator->getRules(ValidatorInterface::RULE_UPDATE));

        return view(static::$pluralName.'.edit', [
            'model' => $model,
            'validacaoJS' => $validacao->render()
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $model = $this->repository->update($request->all(), $id);

            $response = [
                'message' => static::$singleName.' alterado com sucesso.',
                'data'    => $model,
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            $sucesso = app()->make('metadata')->nomeController() . '@index';

            return redirect()->action($sucesso)->with('message', $response);

        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => static::$singleName.' deletado com sucesso.',
                'deleted' => $deleted,
            ]);
        }
        return redirect()->back()->with('message', ['message'=> static::$singleName . ' deletado com sucesso.']);
    }
}
