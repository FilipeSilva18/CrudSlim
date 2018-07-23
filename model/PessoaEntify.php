<?php
class PessoaEntity
{
    public $id;
    public $nome;
    public $data;
    
    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        // no id if we're creating
        if(isset($data['id'])) {
            $this->id = $data['id'];
        }
        $this->nome = $data['nome'];
        $this->data = $data['data'];    
    }
    public function getId() {
        return $this->id;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getData() {
        return $this->data;
    }
}