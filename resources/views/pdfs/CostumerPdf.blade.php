<html>

<head>
    <title>Costumer PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    <h1>{{ $costumer->name }}</h1>

    <div>
        <h3>Dados básicos</h3>
        <div>
            Telefone: {{ $costumer->phone }}
        </div>
        <div style="width: 49%; display:inline-block">
            Data de nascimento: {{ date('d/m/Y', strtotime($costumer->birth_date)) }}
        </div>
        <div style="width: 49%; display:inline-block">
            Estado civil: {{ $costumer->marital_status }}
        </div>
        <div style="width: 49%; display:inline-block">
            RG: {{ $costumer->rg }}
        </div>
        <div style="width: 49%; display:inline-block">
            CPF: {{ $costumer->cpf }}
        </div>
        <div style="width: 49%; display:inline-block">
            Escolaridade: {{ $costumer->schooling }}
        </div>
        <div style="width: 49%; display:inline-block">
            Profissão: {{ $costumer->occupation }}
        </div>
        <div style="width: 49%; display:inline-block">
            Salário: R$ {{ $costumer->salary }}
        </div>
        <div style="width: 49%; display:inline-block">
            Renda familiar: R$ {{ $costumer->family_income }}
        </div>
    </div>

    @if (!empty($address))
        <div class="mt-3">
            <h3>Endereço</h3>
            <div>
                Endereço: {{ $address->street }}, {{ $address->number }}. {{ $address->neighborhood }} -
                {{ $address->city }}/{{ $address->state }}
            </div>
            <div>
                Referência: {{ $address->reference }}
            </div>
            <div>
                CEP: {{ $address->cep }}
            </div>
        </div>
    @endif

    <div class="mt-3">
        <h3>Grupo Familiar</h3>
        <table style="width: 100%">
            <tr>
                <th>Nome</th>
                <th>Parentesco</th>
                <th>Idade</th>
                <th>Profissão</th>
                <th>Salário</th>
            </tr>
            @foreach ($familyGroup as $familyMember)
                <tr>
                    <td>{{ $familyMember->name }}</td>
                    <td>{{ $familyMember->relationship }}</td>
                    <td>{{ $familyMember->age }}</td>
                    <td>{{ $familyMember->occupation }}</td>
                    <td>R$ {{ $familyMember->salary }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="mt-3">
        <h3>Benedícios de transferência de renda</h3>
        <div>
            Cadastro único: {{ $costumer->cadastro_unico ? 'Sim' : 'Não' }}
        </div>
        <div>
            Bolsa Família: {{ $costumer->bolsa_familia ? 'Sim' : 'Não' }}
        </div>
        <div>
            Prestação Continuada: {{ $costumer->prestacao_continuada ? 'Sim' : 'Não' }}
        </div>
        <div>
            Renda cidadã: {{ $costumer->renda_cidada ? 'Sim' : 'Não' }}
        </div>
        <div>
            Cesta básica: {{ $costumer->cesta_basica ? 'Sim' : 'Não' }}
        </div>
    </div>

    @if (!empty($healthSituation))
        <div class="mt-3">
            <h3>Situação de saúde</h3>
            <div>
                Doenças crônicas: {{ $healthSituation->chronic_diseases }}
            </div>
            <div>
                Vícios: {{ $healthSituation->vices }}
            </div>
        </div>
    @endif

    @if (!empty($habitation))
        <div class="mt-3">
            <h3>Habitação</h3>
            <div>
                Moradia:
                {{ !empty($habitation->ownership)
                    ? ($habitation->ownership == 'rented'
                        ? 'Alugada'
                        : ($habitation->ownership == 'owned'
                            ? 'Própria'
                            : 'Cedida'))
                    : '' }}

            </div>
            @if ($habitation->ownership == 'rented')
                <div>
                    Valor do aluguel: R$ {{ $habitation->value }}
                </div>
            @endif
            <div>
                Condição: {{ $habitation->condition }}
            </div>
        </div>
    @endif

    @if (!empty($observations))
        <div class="mt-3">
            <h3>Observações Adicionais</h3>
            <div>
                {{ $observations->observation }}
            </div>
        </div>
    @endif
</body>

</html>
