<?php
class ControllerPessoa extends Controller
{
    public function getPessoas() {
        $sql = "SELECT *
            from teste";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            
           $results[] = new PessoaEntity($row);
        }
        return $results;
    }
    /**
     * Get one ticket by its ID
     *
     * @param int $ticket_id The ID of the ticket
     * @return PessoaEntity  The ticket
     */
    public function getPessoaById($id_pessoa) {
        $sql = "SELECT *
            from teste
            where teste.id = :id_pessoa";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id_pessoa" => $id_pessoa]);
        if($result) {
            return new PessoaEntity($stmt->fetch());
        }
    }
    public function save(PessoaEntity $pessoa) {              
        $sql = "INSERT INTO teste (id, nome, data) VALUES(:id, :nome, :data)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $pessoa->getId(),
            "nome" => $pessoa->getNome(),
            "data" => $pessoa->getData(),
        ]);        
    }
    public function update(PessoaEntity $pessoa, $id_pessoa) {
        $sql = "UPDATE teste SET nome= :nome, data = :data WHERE id= :id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "id" => $id_pessoa,
            "nome" => $pessoa->getNome(),
            "data" => $pessoa->getData(),
        ]);        
    }

    public function deleteById($id_pessoa) {
        $sql = "DELETE FROM teste
            where teste.id = :id_pessoa";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id_pessoa" => $id_pessoa]);
    }
    
}