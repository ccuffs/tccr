@extends('layouts.main')

@section('content')

<div class="row section">
    <div class="col-lg-12">

            <input type="text" id="autocomplete" class="autocomplete">
            <input type="text" id="userinput" placeholder="Search by movie title ...">

            <div class="ac-suggestions"></div>

        <div class="card text-white bg-dark border-secondary">
            <div class="card-header">
                Informações
            </div>
            <div class="card-body">
                <p class="text-muted">Boas-vindas ao centro de gerência de TCCs do curso de <a href="https://cc.uffs.edu.br" target="_blank">Ciência da Computação</a>. Utilize a lista abaixo para acompanhar os trabalhos nos quais você tem algum envolvimento. Se você for estudante, fale primeiramente com seu orientador(a) para tratar de questões do seu TCC. </p>

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

@endsection