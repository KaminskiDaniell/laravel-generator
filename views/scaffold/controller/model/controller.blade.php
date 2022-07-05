@php
    echo "<?php".PHP_EOL;
@endphp

namespace {{ $config->namespaces->controller }};

use {{ $config->namespaces->request }}\Create{{ $config->modelNames->name }}Request;
use {{ $config->namespaces->request }}\Update{{ $config->modelNames->name }}Request;
use {{ $config->namespaces->app }}\Http\Controllers\AppBaseController;
use {{ $config->namespaces->model }}\{{ $config->modelNames->name }};
use Illuminate\Http\Request;
use Flash;

class {{ $config->modelNames->name }}Controller extends AppBaseController
{
    /**
     * Display a listing of the {{ $config->modelNames->name }}.
     */
    public function index(Request $request)
    {
        /** @var {{ $config->modelNames->name }} ${{ $config->modelNames->camelPlural }} */
        ${{ $config->modelNames->camelPlural }} = {{ $config->modelNames->name }}::{!! $renderType !!};

        return view('{{ $config->modelNames->snakePlural }}.index')
            ->with('{{ $config->modelNames->camelPlural }}', ${{ $config->modelNames->camelPlural }});
    }

    /**
     * Show the form for creating a new {{ $config->modelNames->name }}.
     */
    public function create()
    {
        return view('{{ $config->modelNames->snakePlural }}.create');
    }

    /**
     * Store a newly created {{ $config->modelNames->name }} in storage.
     */
    public function store(Create{{ $config->modelNames->name }}Request $request)
    {
        $input = $request->all();

        /** @var {{ $config->modelNames->name }} ${{ $config->modelNames->camel }} */
        ${{ $config->modelNames->camel }} = {{ $config->modelNames->name }}::create($input);

@if($config->options->localized)
        Flash::success(__('messages.saved', ['model' => __('models/{{ $config->modelNames->camelPlural }}.singular')]));
@else
        Flash::success('{{ $config->modelNames->human }} saved successfully.');
@endif

        return redirect(route('{{ $config->modelNames->camelPlural }}.index'));
    }

    /**
     * Display the specified {{ $config->modelNames->name }}.
     */
    public function show($id)
    {
        /** @var {{ $config->modelNames->name }} ${{ $config->modelNames->camel }} */
        ${{ $config->modelNames->camel }} = {{ $config->modelNames->name }}::find($id);

        if (empty(${{ $config->modelNames->camel }})) {
@if($config->options->localized)
            Flash::error(__('models/{{ $config->modelNames->camelPlural }}.singular').' '.__('messages.not_found'));
@else
            Flash::error('{{ $config->modelNames->human }} not found');
@endif

            return redirect(route('{{ $config->modelNames->camelPlural }}.index'));
        }

        return view('{{ $config->modelNames->snakePlural }}.show')->with('{{ $config->modelNames->camel }}', ${{ $config->modelNames->camel }});
    }

    /**
     * Show the form for editing the specified {{ $config->modelNames->name }}.
     */
    public function edit($id)
    {
        /** @var {{ $config->modelNames->name }} ${{ $config->modelNames->camel }} */
        ${{ $config->modelNames->camel }} = {{ $config->modelNames->name }}::find($id);

        if (empty(${{ $config->modelNames->camel }})) {
@if($config->options->localized)
            Flash::error(__('messages.not_found', ['model' => __('models/{{ $config->modelNames->camelPlural }}.singular')]));
@else
            Flash::error('{{ $config->modelNames->human }} not found');
@endif

            return redirect(route('{{ $config->modelNames->camelPlural }}.index'));
        }

        return view('{{ $config->modelNames->snakePlural }}.edit')->with('{{ $config->modelNames->camel }}', ${{ $config->modelNames->camel }});
    }

    /**
     * Update the specified {{ $config->modelNames->name }} in storage.
     */
    public function update($id, Update{{ $config->modelNames->name }}Request $request)
    {
        /** @var {{ $config->modelNames->name }} ${{ $config->modelNames->camel }} */
        ${{ $config->modelNames->camel }} = {{ $config->modelNames->name }}::find($id);

        if (empty(${{ $config->modelNames->camel }})) {
@if($config->options->localized)
            Flash::error(__('messages.not_found', ['model' => __('models/{{ $config->modelNames->camelPlural }}.singular')]));
@else
            Flash::error('{{ $config->modelNames->human }} not found');
@endif

            return redirect(route('{{ $config->modelNames->camelPlural }}.index'));
        }

        ${{ $config->modelNames->camel }}->fill($request->all());
        ${{ $config->modelNames->camel }}->save();

@if($config->options->localized)
        Flash::success(__('messages.updated', ['model' => __('models/{{ $config->modelNames->camelPlural }}.singular')]));
@else
        Flash::success('{{ $config->modelNames->human }} updated successfully.');
@endif

        return redirect(route('{{ $config->modelNames->camelPlural }}.index'));
    }

    /**
     * Remove the specified {{ $config->modelNames->name }} from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var {{ $config->modelNames->name }} ${{ $config->modelNames->camel }} */
        ${{ $config->modelNames->camel }} = {{ $config->modelNames->name }}::find($id);

        if (empty(${{ $config->modelNames->camel }})) {
@if($config->options->localized)
            Flash::error(__('messages.not_found', ['model' => __('models/{{ $config->modelNames->camelPlural }}.singular')]));
@else
            Flash::error('{{ $config->modelNames->human }} not found');
@endif

            return redirect(route('{{ $config->modelNames->camelPlural }}.index'));
        }

        ${{ $config->modelNames->camel }}->delete();

@if($config->options->localized)
        Flash::success(__('messages.deleted', ['model' => __('models/{{ $config->modelNames->camelPlural }}.singular')]));
@else
        Flash::success('{{ $config->modelNames->human }} deleted successfully.');
@endif

        return redirect(route('{{ $config->modelNames->camelPlural }}.index'));
    }
}
