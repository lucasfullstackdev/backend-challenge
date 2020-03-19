@include('templates.form.input', ['label' => 'Nome', 'input' => 'name', 'attributes'=> ['placeholder' => 'Nome Completo']])
@include('templates.form.input', ['label' => 'Celular', 'input' => 'msisdn', 'attributes'=> ['placeholder' => 'ex: +55999999999']])
@include('templates.form.select', ['label' => 'Nível de Acesso', 'input' => 'access_level' ])
@include('templates.form.password', ['label' => 'Senha', 'input' => 'password', 'attributes'=> ['required' => true ]])