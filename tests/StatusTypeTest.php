<?php

use PHPUnit\Framework\TestCase;
use Tests\StatusType;
use Doctrine\DBAL\Platforms\MySqlPlatform;
use Doctrine\DBAL\Types\Type;

class StatusTypeTest extends TestCase
{
    /**
     * @var
     */
    private $type;

    /**
     * @var MySqlPlatform
     */
    private $platform;

    public static function setUpBeforeClass()
    {
        Type::addType('status', 'Tests\\StatusType');
    }

    protected function setUp()
    {
        $this->platform = new MySqlPlatform();
        $this->type = Type::getType('status');
    }

    public function testGetName()
    {
        $this->assertSame('status', $this->type->getName());
    }

    public function testGetDefault()
    {
        $this->assertSame('unverifed', $this->type->getDefault());
    }

    public function testHasValue()
    {
        $this->assertInternalType('bool', $this->type->hasValue('enabled'));
    }

    public function testGetSqlDeclaration()
    {
        $value = $this->type->getSqlDeclaration([], $this->platform);
        $this->assertInternalType('string', $value);
    }

    public function testGetValues()
    {
        $this->assertInternalType('array', $this->type->getValues());
    }

    /**
     * @dataProvider databaseConvertProvider
     */
    public function testDatabaseValueConvertsToPHPValue($databaseValue, $phpValue)
    {
        $converted = $this->type->convertToPHPValue($databaseValue, $this->platform);
        $this->assertInternalType('string', $converted);
        $this->assertEquals($phpValue, $converted);
    }

    /**
     * @dataProvider databaseConvertProvider
     */
    public function testPHPConvertsToDatabaseValue($databaseValue, $phpValue)
    {
        $converted = $this->type->convertToDatabaseValue($phpValue, $this->platform);

        $this->assertInternalType('string', $converted);
        $this->assertEquals($databaseValue, $converted);
    }

    /**
     * @return array
     */
    public static function databaseConvertProvider()
    {
        return [
            ['enabled', StatusType::getEnabled()],
            ['disabled', StatusType::getDisabled()],
            ['deleted', StatusType::getDeleted()],
            ['unverifed', StatusType::getUnverifed()]
        ];
    }
}