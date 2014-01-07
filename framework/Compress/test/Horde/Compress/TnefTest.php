<?php
/**
 * @category   Horde
 * @package    Compress
 * @subpackage UnitTests
 */

/**
 * @category   Horde
 * @package    Compress
 * @subpackage UnitTests
 */
class Horde_Compress_TnefTest extends Horde_Test_Case
{
    public $testdata;

   public function testMeetingInvitation()
   {
        $tnef = Horde_Compress::factory('Tnef');
        $data = base64_decode(file_get_contents(__DIR__ . '/fixtures/TnefMeetingRequest.txt'));
        $tnef_data = $tnef->decompress($data);
        $this->assertEquals($tnef_data[0]['type'], 'text');
        $this->assertEquals($tnef_data[0]['subtype'], 'calendar');
        $this->assertEquals($tnef_data[0]['name'], 'Meeting');
   }

   public function testAttachments()
   {
        $data = base64_decode(file_get_contents(__DIR__ . '/fixtures/TnefAttachments.txt'));
        $tnef = Horde_Compress::factory('Tnef');
        $tnef_data = $tnef->decompress($data);
        $this->assertEquals($tnef_data[0]['type'], 'application');
        $this->assertEquals($tnef_data[0]['subtype'], 'octet-stream');
        $this->assertEquals($tnef_data[0]['name'], 'hasselhoff_birthday.jpg');
        $this->assertEquals($tnef_data[0]['size'], 80051);
   }

   public function testMultipleAttachments()
   {
        $data = base64_decode(file_get_contents(__DIR__ . '/fixtures/TnefAttachmentsMultiple.txt'));
        $tnef = Horde_Compress::factory('Tnef');
        $tnef_data = $tnef->decompress($data);
        $this->assertEquals($tnef_data[0]['type'], 'application');
        $this->assertEquals($tnef_data[0]['subtype'], 'octet-stream');
        $this->assertEquals($tnef_data[0]['name'], 'Lighthouse.jpg');
        $this->assertEquals($tnef_data[1]['type'], 'application');
        $this->assertEquals($tnef_data[1]['subtype'], 'octet-stream');
        $this->assertEquals($tnef_data[1]['name'], 'Penguins.jpg');
   }

}
