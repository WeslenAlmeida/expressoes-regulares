<?php

namespace App\Alura;

class Usuario extends ValidaCPF
{
    private $nome;
    private $sobrenome;
    private $senha;
    private $tratamento;

    public function __construct(string $nome, string $senha, string $genero, string $cpf)
    {
        $nomeSobrenome = explode(" ", $nome, 2);

        if($nomeSobrenome[0] === ''){
            $this->nome = 'Nome inválido';
            return;
        }
        $this->nome = $nomeSobrenome[0];


        if($nomeSobrenome[1] === null){
            $this->sobrenome = 'Sobrenome inválido';
            return;
        }
        $this->sobrenome = $nomeSobrenome[1];

        parent::__construct($cpf);

        $this->validaSenha($senha);
        $this->adicionaTratamentoAoNome($nome, $genero);

    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    private function validaSenha(string $senha): void
    {
        $tamanhoSenha = strlen(trim($senha));
        if ($tamanhoSenha > 6){
            $this->senha = $senha;
            return;
        }
        $this->senha = "Senha inválida!";

    }

    private function adicionaTratamentoAoNome(string $nome, string $genero)
    {
        if ($genero === 'M'){
            $this->tratamento = preg_replace('/^(\w+)\b/', 'Sr', $nome, 1);
        }

        if ($genero === 'F'){
            $this->tratamento = preg_replace('/^(\w+)\b/', 'Srª', $nome, 1);
        }
    }

    public function getTratamento(): string
    {
        return $this->tratamento;
    }
}
