<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\StoreUpdatePacienteFormRequest;
use App\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProductFormRequest;
use Illuminate\Support\Facades\Storage;

class PacienteController extends Controller
{
    private $pacienteModel, $totalPage = 10;
    private $path = 'paciente';

    public function __construct(Paciente $pacienteModel)
    {
        $this->pacienteModel = $pacienteModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pacientes = $this->pacienteModel->getResults($request->all(), $this->totalPage);
        return response()->json($pacientes);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePacienteFormRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $name = $request->name;
            $extension = $request->image->extension();

            $nameFile = "{$name}.{$extension}";
            $data['imagem'] = $nameFile;

            $upload = $request->image->storeAs($this->path, $nameFile);

            if (!$upload)
                return response()->json(['error' => 'Fail_Upload'], 500);
        }

        $paciente = $this->pacienteModel->create($data);

        return response()->json($paciente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$paciente = $this->pacienteModel->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        return response()->json($paciente);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePacienteFormRequest $request, $id)
    {
        if (!$paciente = $this->pacienteModel->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        $data = $request->all();

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            if ($paciente->imagem) {
                if (Storage::exists("{$this->path}/{$paciente->imagem}"))
                    Storage::delete("{$this->path}/{$paciente->imagem}");
            }

            $name = $request->name;
            $extension = $request->image->extension();

            $nameFile = "{$name}.{$extension}";
            $data['imagem'] = $nameFile;

            $upload = $request->image->storeAs($this->path, $nameFile);

            if (!$upload)
                return response()->json(['error' => 'Fail_Upload'], 500);
        }

        $paciente->update($data);

        return response()->json($paciente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$paciente = $this->pacienteModel->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        /*if ($paciente->imagem) {
            if (Storage::exists("{$this->path}/{$paciente->imagem}"))
                Storage::delete("{$this->path}/{$paciente->imagem}");
        }*/

        $paciente->delete();

        return response()->json(['success' => true], 204);
    }
}
