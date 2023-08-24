@extends("templates.app")

@section("body")

<div class="container-fluid" style="width: 70%; background: #FBFBFB; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 10px 40px 30px 40px; margin-top:2rem;">
    <div class="container-fluid">
        <div style="margin-bottom: 10px;  gap: 20px; margin-top: 20px">
            <h1 style="color:#2D3875;"><strong>Meu Perfil</strong></h1>
        </div>
        {{--  editar perfil - botão  --}}
        <div style="display:flex; justify-content:center; margin-bottom: 10px;  gap: 20px; margin-top: 20px">
            <a href="{{url("/servidores/".$servidor->id."/editarmeuperfil")}}" class="btn btn-primary"
                style="background: #34A853; border-radius: 10px; border: none; width: auto; height: 40px; font-weight: 700; font-size: 18px;
                line-height: 22px;"> <img src="{{asset("images/edit-outline.png")}}" style="width: 25px; margin-bottom: 5px" alt="Editar servidor"> Editar Perfil</a>
        </div>
    </div>

    @auth
    <div class="container-fluid" style="padding-top: 10px;">

            @if ($servidor->user->image)
            <img src="/images/fotos-perfil/{{ $servidor->user->image }}"  class="img-fluid" style="border-radius: 50%; width:150px; height:150px;" alt="Foto de perfil">
            @else
            <img src="/images/sem-foto-perfil.png"  class="img-fluid" style="border-radius: 50%; width:150px; height:150px;" alt="Foto de perfil">
            @endif

            <label class="tituloinfomodal form-label mt-3" for="nome_edit">Nome</label>
            <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$servidor->user->name}} </div>

            @if ( $servidor->name_social != null )
            <label class="tituloinfomodal form-label mt-3" for="nome_edit">Nome Social</label>
            <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$servidor->name_social}} </div>
            @endif

            <label class="tituloinfomodal form-label mt-3" for="nome_edit">E-mail</label>
            <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$servidor->user->email}} </div>

            <label class="tituloinfomodal form-label mt-3" for="nome_edit">CPF</label>
            <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$servidor->cpf}} </div>
        </div>
        <br>
        <br>
    @endauth
</div>
<br>
<br>
@endsection
