<?php
// src/Entity/MyObject.php
namespace App\Entity;

class MyObject
{
    private $prop1;
    private $prop2;
    private $prop3;

    // Puedes agregar anotaciones o atributos para Doctrine si planeas usarlo,
    // pero para propósitos de serialización/deserialización básica, esto es suficiente.

    public function getProp1(): ?string
    {
        return $this->prop1;
    }

    public function setProp1(string $prop1): self
    {
        $this->prop1 = $prop1;
        return $this;
    }

    public function getProp2(): ?string
    {
        return $this->prop2;
    }

    public function setProp2(string $prop2): self
    {
        $this->prop2 = $prop2;
        return $this;
    }

    public function getProp3(): ?string
    {
        return $this->prop3;
    }

    public function setProp3(string $prop3): self
    {
        $this->prop3 = $prop3;
        return $this;
    }
}
