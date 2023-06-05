<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlunoUpdateFormRequest;
use App\Http\Requests\AlunoStoreFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Exception;


class AlunoController extends Controller
    {

    public function getCpfs(Request $request){
        $searchTerm = $request->input('term'); // Obtém o termo de pesquisa enviado pelo Autocomplete

        $cpfs = Aluno::with("users")->select('cpf', 'nome_aluno')
            ->where('cpf', 'LIKE', '%'.$searchTerm.'%')
            ->get();

        $data = $cpfs->map(function ($item) {
            return [
                'cpf' => $item->cpf,
                'nome' => $item->nome_aluno,
            ];
    });

    return response()->json($data);
    }

        public function store(AlunoStoreFormRequest $request){
            DB::beginTransaction();
            try {
                $aluno = new Aluno();
                $aluno->nome_aluno = $request->nome;
                $aluno->cpf = $request->cpf;
                $aluno->curso_id = $request->curso;
                $aluno->semestre_entrada = $request->semestre_entrada;
                if ($aluno->save()) {
                    $user = $aluno->user()->create([
                        'name' => $request->nome,
                        'name_social' => $request->name_social == null ? "-" : $request->name_social,
                        'email' => $request->email,
                        'cpf' => $request->cpf,
                        'password' => Hash::make($request->senha)
                    ]);
                    $user->givePermissionTo('aluno');
                    $user->save();
                    DB::commit();

                    return redirect('/alunos')->with('sucesso', 'Aluno cadastrado com sucesso.');
                } else {
                    return redirect()->back()->withErrors("Falha ao cadastrar aluno. Tente novamente mais tarde.");
                }
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors("Falha ao cadastrar aluno. Tente novamente mais tarde.");
            }
    }


    public function update(AlunoUpdateFormRequest $request, $id)
    {
        try{
            #dd($request);
            $aluno = Aluno::find($id);
            #dd($request);
            $aluno->cpf = $request->cpf == $aluno->cpf ? $aluno->cpf : $request->cpf;
            $aluno->semestre_entrada = $request->semestre_entrada;
            $aluno->curso_id = $request->curso;
            $aluno->nome_aluno = $request->nome;

            $aluno->user->name = $request->nome;
            $aluno->user->email = $request->email;
            $aluno->user->name_social = $request->nome_social;
            if ($request->senha && $request->senha != null){
                if (strlen($request->senha) > 3 && strlen($request->senha) < 30){
                    $aluno->user->password = Hash::make($request->password);
                } else {
                    return redirect()->back()->withErrors( "Senha deve ter entre 4 e 30 dígitos" );
                }
            }

            if ($aluno->save()){

                if ($aluno->user->update()){
                    return redirect('/alunos')->with('sucesso', 'Aluno atualizado com sucesso.');
                } else {
                    return redirect()->back()->withErrors( "Falha ao editar Aluno. tente novamente mais tarde." );
                }

            }

        } catch(exception $e){
            return redirect()->back()->withErrors( "Falha ao editar aluno. tente novamente mais tarde." );

        }
    }

    public function delete($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.delete', ['aluno' => $aluno]);
    }

    public function destroy(Request $request)
    {
        try{
            $id = $request->only(['id']);
            $aluno = Aluno::findOrFail($id)->first();

            if ($aluno->user->delete() && $aluno->delete()) {
                return redirect(route("alunos.index"))->with('sucesso', 'Aluno deletado com sucesso.');
            }

        } catch(exception $e){
            return redirect()->back()->withErrors( "Falha ao deletar aluno. tente novamente mais tarde." );
        }
    }

    public function index(Request $request)
    {
        $alunos = Aluno::with('user')->get();
        //dd($alunos);
        return view("Alunos.index", compact("alunos"));

        /*if (sizeof($request-> query()) > 0){
            $campo = $request->query('campo');
            $valor = $request->query('valor');

            if ($valor == null){
                return redirect()->back()->withErrors( "Deve ser informado algum valor para o filtro." );
            }

            $alunos = Aluno::join("users", "users.typage_id", "=", "alunos.id")->join("cursos", "cursos.id", "=", "alunos.curso_id");
            $alunos = $alunos->where(function ($query) use ($valor) {
                if ($valor) {
                    $query->orWhere("users.name", "LIKE", "%{$valor}%");
                    $query->orWhere("users.name_social", "LIKE", "%{$valor}%");
                    $query->orWhere("users.email", "LIKE", "%{$valor}%");
                    $query->orWhere("alunos.cpf", "LIKE", "%{$valor}%");
                    $query->orWhere("cursos.nome", "LIKE", "%{$valor}%");
                }
            })->orderBy('alunos.created_at', 'desc')->select("alunos.*")->get();


            return view("Alunos.index", compact("alunos"));
        } else {
            $alunos = Aluno::join("users", "users.typage_id", "=", "alunos.id")->join("cursos", "cursos.id", "=", "alunos.curso_id");
            $alunos = $alunos->get();
            return view("Alunos.index", compact("alunos"));
        }*/

    }

    public function edit($id){
        $aluno = Aluno::find($id);
        $cursos = Curso::all();
        return view("Alunos.editar-aluno", compact('aluno', 'cursos'));
    }

    public function create(){
        $cursos = Curso::all();
        return view("Alunos.cadastro-aluno", compact('cursos'));
    }

    public function profile(Request $request)
    {
        $id = $request->user()->typage_id; // Obtém o ID do usuário autenticado
        // $user = $request->user(); // Obtém o usuário autenticado

        //dd($user);

        $aluno = Aluno::find($id);


        return view('Perfil.meu-perfil-aluno', ['aluno' => $aluno]);
    }

}
