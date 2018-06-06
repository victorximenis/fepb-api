<?php

namespace App\Http\Controllers;

use App\Socio;
use App\Pessoa;
use Illuminate\Http\Request;

class SocioController extends Controller
{

    public function get($id)
    {
        $socio = Socio::find($id)->with("pessoa")->first();
        return $socio;
    }
    
    public function list()
    {
        $socios = Socio::with("pessoa")->get();
        return $socios;
    }

    public function delete($id)
    {
        try {
            $socio = Socio::findOrFail($id);
            
            $pessoa = $socio->pessoa;

            $socio->delete();
        } catch (Exception $e) {
            // Do not found exceptions
        }

    }

    public function save(Request $req)
    {


        $socioObj = $req->input("socio");
        // Dados da Pessoa
        
        $nome = $socioObj['pessoa']['nome'];
        $comoChamar = $socioObj['pessoa']['comoChamar'];
        $sexo = $socioObj['pessoa']['sexo'];
        $cpf = $socioObj['pessoa']['cpf'];
        $email = $socioObj['pessoa']['email'];
        $dataNascimento = $socioObj['pessoa']['dataNascimento'];

        // Dados do Socio
        $dataAdesao = $socioObj['dataAdesao'];
        $valorContribuicao = $socioObj['valorContribuicao'];
        $vencimentoContribuicao = $socioObj['vencimentoContribuicao'];
        $metodoContribuicao = $socioObj['metodoContribuicao'];

        $pessoa = new Pessoa();
        
        $pessoa->nome = $nome;
        $pessoa->como_chamar = $comoChamar;
        $pessoa->sexo = $sexo;
        $pessoa->cpf = $cpf;
        $pessoa->email = $email;
        $pessoa->data_nasc = $dataNascimento;

        $pessoa->save();

        $socio = new Socio();
        $socio->data_adesao = $dataAdesao;
        $socio->valor_contrib = $valorContribuicao;
        $socio->venc_contrib = $vencimentoContribuicao;
        $socio->metodo_contrib = $metodoContribuicao;
        $socio->id_pessoa = $pessoa->id;

        $socio->save();

    }

    public function update(Request $req, $id)
    {

        $socio = Socio::find($id);

        if ($socio != null)
        {
            $pessoa = Pessoa::find($socio->pessoa->id);

            if ($pessoa != null)
            {
                $socioObj = $req->input("socio");
                // Dados da Pessoa
                
                $nome = $socioObj['pessoa']['nome'];
                $comoChamar = $socioObj['pessoa']['comoChamar'];
                $sexo = $socioObj['pessoa']['sexo'];
                $raca = $socioObj['pessoa']['raca'];
                $cpf = $socioObj['pessoa']['cpf'];
                $email = $socioObj['pessoa']['email'];
                $dataNascimento = $socioObj['pessoa']['dataNascimento'];

                // Dados do Socio
                $dataAdesao = $socioObj['dataAdesao'];
                $valorContribuicao = $socioObj['valorContribuicao'];
                $vencimentoContribuicao = $socioObj['vencimentoContribuicao'];
                $metodoContribuicao = $socioObj['metodoContribuicao'];
                
                $pessoa->nome = $nome;
                $pessoa->como_chamar = $comoChamar;
                $pessoa->sexo = $sexo;
                $pessoa->raca = $raca;
                $pessoa->cpf = $cpf;
                $pessoa->email = $email;
                $pessoa->data_nasc = $dataNascimento;

                $pessoa->save();

                $socio->data_adesao = $dataAdesao;
                $socio->valor_contrib = $valorContribuicao;
                $socio->venc_contrib = $vencimentoContribuicao;
                $socio->metodo_contrib = $metodoContribuicao;
                $socio->id_pessoa = $pessoa->id;

                $socio->save();

            }

        }
        
    }

}