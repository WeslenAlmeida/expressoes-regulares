<?php

namespace App\Alura;

class Contato
{
    private $email;
    private $endereco;
    private $cep;
    private $telefone;

    public function __construct(string $email, string $endereco, string $cep, string $telefone)
    {
        $this->endereco = $endereco;
        $this->cep = $cep;

        if ($this->validaEmail($email) !== false){
            $this->setEmail($email);
        } else {
            $this->setEmail('Email inválido');
        }

        if ($this->validaTelefone($telefone)){
            $this->setTelefone($telefone);
        } else {
            $this->setTelefone('Telefone inválido!');
        }
    }

    private function validaTelefone(string $telefone): int
    {
        return preg_match('/^[0-9]{4}-[0-9]{4}$/',  $telefone, $encontrados);
    }

    public function getUsuario()
    {
        $posArroba = strpos($this->email, "@");
        if($posArroba === false){
            return "Usuário inválido!";
        }
        return substr($this->email, 0, $posArroba );
    }

    private function validaEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    private function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEnderecoCep(): string
    {
        $enderecoCep =[$this->endereco, $this->cep];
        return implode(" - CEP
         : ", $enderecoCep);

    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    private function setTelefone($telefone): void
    {
        $this->telefone = $telefone;
    }

}