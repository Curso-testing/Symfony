<?php

namespace App\Tests\Unit;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeserializeTest extends WebTestCase
{
    const TEST_DATA = '[{"prop1":"foo","prop2":"bar","prop3":"baz"},{"prop1":"foo","prop2":"bar","prop3":"baz"},{"prop1":"foo","prop2":"bar","prop3":"baz"}]';
    public function testDeserialize()
    {
        self::bootKernel();
        $serializer = self::getContainer()->get('serializer');
        $data = $serializer->deserialize(self::TEST_DATA, 'App\Entity\MyObject[]', 'json');
        $this->assertEquals(3, count($data));
    }

    public function testDeserializeWithInvalidData()
    {
        self::bootKernel();
        $serializer = self::getContainer()->get('serializer');
        $this->assertTrue($serializer->supportsDenormalization('{"prop1":"foo","prop2":"bar","prop3":"baz"}', 'App\Entity\MyObject[]', 'json'));
    }


    public function testDeserializeWithEmptyData()
    {
        self::bootKernel();
        $serializer = self::getContainer()->get('serializer');
        $this->assertEquals([], $serializer->deserialize('[]', 'App\Entity\MyObject[]', 'json'));
    }

    public function testDeserializeWithNullData()
    {
        $serializer = self::getContainer()->get('serializer');
        $this->expectException(\TypeError::class);
        @$serializer->deserialize(null, 'App\Entity\MyObject[]', 'json');
    }

    public function testDeserializeWithEmptyArray()
    {
        self::bootKernel();
        $serializer = self::getContainer()->get('serializer');
        $data = $serializer->deserialize('[]', 'App\Entity\MyObject[]', 'json');
        $this->assertEquals(0, count($data));
    }

    // TEST serializer create a valid object from json
    public function testDeserializeWithValidData()
    {
        self::bootKernel();
        $serializer = self::getContainer()->get('serializer');
        $data = $serializer->deserialize('{"prop1":"foo","prop2":"bar","prop3":"baz"}', 'App\Entity\MyObject', 'json');
        $this->assertEquals('foo', $data->getProp1());
        $this->assertEquals('bar', $data->getProp2());
        $this->assertEquals('baz', $data->getProp3());
    }
}
