@extends('layouts.main')

@section('headsup')

<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Atenção</h4>
            <p>Esse horário é preliminar. Ele foi decidido e homologado pelo Colegiado do Curso, então há baixas chances que ele seja alterado. Entretanto, ele pode sofrer alterações conforme demandas da Coordenação Acadêmica em virtude de alocações fora do controle da Coordenação do Curso.</p>
            <hr>
            <p class="mb-0">Dúvidas? Escreva para <a href="mailto:computacao.ch@uffs.edu.br">computacao.ch@uffs.edu.br</a></p>
        </div>
    </div>
</div>

@endsection

@section('content')

<div class="row section">
    <div class="col-lg-12">
        <div class="card text-white bg-dark border-secondary">
            <div class="card-header">
                Informações
            </div>
            <div class="card-body">
                <p class="text-muted">Esse é o sistema de gerência de TCCs do curso de <a href="https://cc.uffs.edu.br" target="_blank">Ciência da Computação</a>. Utilize a lista abaixo para acompanhar os trabalhos nos quais você tem algum envolvimento. Se você for estudante, fale primeiramente com seu orientador(a) para tratar de questões do seu TCC. </p>

                <p class="text-muted">
                    - Responsável pelo TCC I: <a href="mailo:fernando.bevilacqua@uffs.edu.br">fernando.bevilacqua@uffs.edu.br</a>
                </p>
                <p class="text-muted">
                    - Responsável pelo TCC II: <a href="mailo:raquel.pegoraro@uffs.edu.br">raquel.pegoraro@uffs.edu.br</a>
                </p>
            </div>
        </div>
    </div>
</div>

@if (count($projects) != 0)
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Autoria</th>
        <th scope="col">Orientação</th>
        <th scope="col">Tipo</th>
        <th scope="col">Período</th>
        <th scope="col">Situação</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">1</th>
        <td>Fernando Bevilacqua</td>
        <td>Fernando Bevilacqua</td>
        <td>Projeto (TCC I)</td>
        <td>Período</td>
        <td>Situação</td>
        </tr>
    </tbody>
    </table>
@else
    <div class="alert alert-dark" role="alert">
        <div class="row align-items-center">
            <div class="col-9">
                <p><strong>Vamos começar?</strong></p>
                <p class="text-muted">Você ainda não iniciou o acompanhamento do seu TCC. Clique no botão ao lado para iniciar o processo. Você não precisa ter um orientador ou um tema agora, isso pode ser definido depois. Se você já tem essas informações, pode informá-las a seguir.</p>
            </div>
            <div class="col-3 text-center">
                <a href="{{ route('project-start') }}"><button type="button" class="btn btn-outline-success btn-lg" href="google.com">Iniciar TCC</button></a>
            </div>
        </div>
    </div>
@endif

@endsection