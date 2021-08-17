<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Mail\EmailTest;
use Illuminate\Support\Facades\Mail;

class MailerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testSending()
    {
        Mail::fake();
 
        Mail::send(new EmailTest());
 
        Mail::assertSent(EmailTest::class);
 
        Mail::assertSent(EmailTest::class, function ($mail) {
            $mail->build();
            $this->assertTrue($mail->hasFrom('salguerojulio34@gmail.com'));
            $this->assertTrue($mail->hasCc('salguerojulio34@gmail.com'));
            $this->assertTrue($mail->hasTo('jsalguero94@gmail.com'));
 
            return true;
        });
    }
}
