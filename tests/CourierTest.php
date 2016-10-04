<?php
namespace Courier;

/**
 * @author <nathanmarcos@nathanmarcos.com>
 */

class CourierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array()
     */
    private $message;

    /**
     * @var Courier
     */
    private $courier;

    /**
     * @before
     */
    public function configureTests()
    {
        $this->message = array();

        $this->courier = new Courier();
    }

    /**
     * @test
     *
     * @covers Courier::__construct
     */
    public function constructorShouldInitializeMessage()
    {
        $this->assertAttributeEquals($this->message, 'message', $this->courier);
    }

    /**
     * @test
     *
     * @covers Courier::__construct
     * @covers Courier::setBody
     */
    public function messageShouldHaveBody()
    {
        $expect = 'Body';

        $this->courier->setBody($expect);

        $class = new \ReflectionClass(Courier::class);
        $property = $class->getProperty('message');
        $property->setAccessible(true);

        $this->assertEquals($expect, $property->getValue($this->courier)['body']);
    }

    /**
     * @test
     *
     * @covers Courier::__construct
     * @covers Courier::setRecipient
     */
    public function messageShouldHaveRecipient()
    {
        $expect = 'Recipient';

        $this->courier->setRecipient($expect);

        $class = new \ReflectionClass(Courier::class);
        $property = $class->getProperty('message');
        $property->setAccessible(true);

        $this->assertEquals($expect, $property->getValue($this->courier)['recipient']);
    }

    /**
     * @test
     *
     * @covers Courier::__construct
     * @covers Courier::setSender
     */
    public function messageShouldHaveSender()
    {
        $expect = 'Recipient';

        $this->courier->setSender($expect);

        $class = new \ReflectionClass(Courier::class);
        $property = $class->getProperty('message');
        $property->setAccessible(true);

        $this->assertEquals($expect, $property->getValue($this->courier)['sender']);
    }
}